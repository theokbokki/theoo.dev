export default class Posts {
    constructor() {
        this.init();

        if (!this.form) return;

        this.getEls();
        this.setEvents();
        this.registerExistingPreviews();
    }

    init() {
        this.settings = {
            selectors: {
                form: ".posts__form--draft, .posts__form--edit",
                attachmentsInput: "#attachments",
                previews: ".posts__previews",
                content: "#content",
                csrfToken: "[name=_token]",
                previewItem: ".posts__preview",
                deleteButton: "[data-action^='delete-preview-']",
                altField: "textarea[name^='preview-'][name$='-alt']",
                openDialog: "dialog[open]",
                error: "[data-error-field]",
            },
            uploadUrl: "/feed/attachments/upload",
            deleteActionPrefix: "delete-preview-",
            altNamePrefix: "preview-",
            altNameSuffix: "-alt",
            errorClass: "posts__error",
            heicExtension: /\.hei[cf]$/i,
            indexedFieldExpr: /\.(\d+)$/,
        };

        this.attachments = new Map();
        this.form = document.querySelector(this.settings.selectors.form);
    }

    getEls() {
        this.attachmentsInput = this.form.querySelector(this.settings.selectors.attachmentsInput);
        this.previews = this.form.querySelector(this.settings.selectors.previews);
        this.contentField = this.form.querySelector(this.settings.selectors.content);
        this.csrfToken = this.form.querySelector(this.settings.selectors.csrfToken)?.value;
    }

    setEvents() {
        this.attachmentsInput.addEventListener("change", this.handleFilesSelected.bind(this));
        this.previews.addEventListener("input", this.handleAltEdited.bind(this));
        this.previews.addEventListener("click", this.handleDeleteClicked.bind(this));
        this.form.addEventListener("submit", this.handleSaveRequested.bind(this));
    }

    registerExistingPreviews() {
        [...this.previews.children].forEach((node) => {
            const altField = node.querySelector(this.settings.selectors.altField);

            this.attachments.set(this.readPreviewId(node), {
                file: null,
                alt: altField?.value ?? "",
                existing: true,
            });
        });
    }

    async handleFilesSelected() {
        const images = this.takeSelectedImages();
        if (!images.length) return;

        const fragments = await this.requestPreviews(images);
        if (!fragments) return;

        this.registerPreviews(fragments, images);
    }

    takeSelectedImages() {
        const images = [...this.attachmentsInput.files].filter((file) => this.isImage(file));
        this.attachmentsInput.value = "";
        return images;
    }

    isImage(file) {
        return file.type.startsWith("image/") || this.settings.heicExtension.test(file.name);
    }

    async requestPreviews(images) {
        const body = new FormData();
        images.forEach((image) => body.append("files[]", image));

        const response = await this.post(this.settings.uploadUrl, body);
        if (!response.ok) return null;

        return (await response.json()).html;
    }

    registerPreviews(fragments, images) {
        fragments.forEach((fragment, index) => {
            const node = this.appendPreview(fragment);
            const id = this.readPreviewId(node);

            this.attachments.set(id, { file: images[index], alt: "", existing: false });
        });
    }

    appendPreview(fragment) {
        this.previews.insertAdjacentHTML("beforeend", fragment);
        return this.previews.lastElementChild;
    }

    readPreviewId(node) {
        const { action } = node.querySelector(this.settings.selectors.deleteButton).dataset;
        return action.replace(this.settings.deleteActionPrefix, "");
    }

    handleAltEdited(e) {
        const field = e.target.closest(this.settings.selectors.altField);
        if (!field) return;

        this.setAlt(this.idFromAltField(field), field.value);
    }

    idFromAltField(field) {
        return field.name.slice(
            this.settings.altNamePrefix.length,
            -this.settings.altNameSuffix.length,
        );
    }

    setAlt(id, alt) {
        const attachment = this.attachments.get(id);
        if (attachment) attachment.alt = alt;
    }

    handleDeleteClicked(e) {
        const button = e.target.closest(this.settings.selectors.deleteButton);
        if (!button) return;

        const id = button.dataset.action.replace(this.settings.deleteActionPrefix, "");
        this.attachments.delete(id);
        this.removePreview(button.closest(this.settings.selectors.previewItem));
    }

    removePreview(node) {
        node?.querySelector(this.settings.selectors.openDialog)?.close();
        node?.remove();
    }

    async handleSaveRequested(e) {
        e.preventDefault();
        this.clearErrors();

        const response = await this.post(this.saveUrl(e), this.buildPayload());
        await this.handleSaveResponse(response);
    }

    saveUrl(e) {
        return e.submitter?.formAction || this.form.action;
    }

    buildPayload() {
        const data = new FormData();
        data.append("content", this.contentField.value);

        let index = 0;
        for (const [id, { file, alt, existing }] of this.attachments) {
            if (existing) {
                data.append(`existing[${id}]`, alt ?? "");
                continue;
            }

            data.append(`attachments[${index}]`, file);
            data.append(`alts[${index}]`, alt ?? "");
            index += 1;
        }

        return data;
    }

    async handleSaveResponse(response) {
        if (response.ok) {
            window.location.assign(response.url);
            return;
        }

        if (response.status === 422) {
            const { errors } = await response.json();
            this.showErrors(errors);
        }
    }

    showErrors(errors) {
        Object.entries(errors).forEach(([field, messages]) => {
            this.showFieldError(field, messages[0]);
        });
    }

    showFieldError(field, message) {
        const paragraph = this.buildErrorParagraph(field, message);
        const index = this.indexFromField(field);

        if (field === "content") {
            this.contentField.insertAdjacentElement("afterend", paragraph);
        } else if (index !== null) {
            this.previews.children[index]?.appendChild(paragraph);
        } else {
            this.form.prepend(paragraph);
        }
    }

    buildErrorParagraph(field, message) {
        const paragraph = document.createElement("p");
        paragraph.className = this.settings.errorClass;
        paragraph.dataset.errorField = field;
        paragraph.textContent = message;
        return paragraph;
    }

    indexFromField(field) {
        const match = field.match(this.settings.indexedFieldExpr);
        return match ? Number(match[1]) : null;
    }

    clearErrors() {
        this.form.querySelectorAll(this.settings.selectors.error).forEach((el) => el.remove());
    }

    post(url, body) {
        return fetch(url, { method: "POST", headers: this.headers(), body });
    }

    headers() {
        return {
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": this.csrfToken,
            Accept: "application/json",
        };
    }
}
