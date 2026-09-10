export default class PostsDraft {
    constructor(el) {
        this.el = el;

        this.attachments = new Map();

        this.init();
        this.getEls();
        this.setEvents();
    }

    init() {
        this.settings = {
            selectors: {
                form: ".posts__form--draft",
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
    }

    getEls() {
        this.form = this.el;
        this.attachmentsInput = this.el.querySelector(this.settings.selectors.attachmentsInput);
        this.previews = this.el.querySelector(this.settings.selectors.previews);
        this.contentField = this.el.querySelector(this.settings.selectors.content);
        this.csrfToken = this.el.querySelector(this.settings.selectors.csrfToken)?.value;
    }

    setEvents() {
        this.attachmentsInput.addEventListener("change", this.handleFilesSelected.bind(this));
        this.previews.addEventListener("input", this.handleAltEdited.bind(this));
        this.previews.addEventListener("click", this.handleDeleteClicked.bind(this));
        this.form.addEventListener("submit", this.handleSaveRequested.bind(this));
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
            const previewNode = this.appendPreview(fragment);
            const id = this.readPreviewId(previewNode);

            this.attachments.set(id, { file: images[index], alt: "" });
        });
    }

    appendPreview(fragment) {
        this.previews.insertAdjacentHTML("beforeend", fragment);

        return this.previews.lastElementChild;
    }

    readPreviewId(previewNode) {
        const { action } = previewNode.querySelector(this.settings.selectors.deleteButton).dataset;
        return action.replace(this.settings.deleteActionPrefix, "");
    }


    handleAltEdited(e) {
        const field = e.target.closest(this.settings.selectors.altField);
        if (!field) return;

        this.setAlt(this.idFromAltField(field), field.value);
    }

    idFromAltField(field) {
        return field.name.slice(this.settings.altNamePrefix.length, -this.settings.altNameSuffix.length);
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

    removePreview(previewNode) {
        previewNode?.querySelector(this.settings.selectors.openDialog)?.close();
        previewNode?.remove();
    }

    async handleSaveRequested(e) {
        e.preventDefault();
        this.clearErrors();

        const response = await this.post(this.saveUrl(e), this.buildDraft());
        await this.handleSaveResponse(response);
    }

    saveUrl(e) {
        return e.submitter?.formAction || this.form.action;
    }

    buildDraft() {
        const draft = new FormData();
        draft.append("content", this.contentField.value);

        let index = 0;
        for (const { file, alt } of this.attachments.values()) {
            draft.append(`attachments[${index}]`, file);
            draft.append(`alts[${index}]`, alt);

            index += 1;
        }

        return draft;
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
