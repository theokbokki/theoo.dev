export default class ImageUpload {
    constructor(el) {
        this.el = el;
        this.textarea = this.el.querySelector("#content");
        this.button = this.el.querySelector("#upload-image-btn");
        this.input = this.el.querySelector("#upload-image-input");

        this.button.addEventListener("click", this.onClick.bind(this));
        this.input.addEventListener("change", this.onImageUpload.bind(this));
    }

    onClick(e) {
        e.preventDefault();
        this.input.click();

        const url = this.button.attributes.formaction;
    }

    async onImageUpload() {
        if (!this.input.files.length) return;

        const images = [...this.input.files]
            .filter((f) => f.type.startsWith("image/"))
            .filter(Boolean);

        if (!images.length) return;

        this.button.disabled = true;
        this.button.textContent = "Uploading...";

        const form = new FormData();

        images.forEach((image, index) => {
            let uuid = self.crypto.randomUUID();

            this.textarea.setRangeText(`![](/storage/notes/thumb/${uuid}.webp)`, this.textarea.selectionEnd, this.textarea.selectionEnd, "end");

            form.append("files[]", image);
            form.append("uuids[]", uuid);

            if (index === images.length - 1) return;

            this.textarea.setRangeText("\n\n", this.textarea.selectionEnd, this.textarea.selectionEnd, "end");
        });

        const response = await fetch("/notes/image", {
            method: "POST",
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": this.csrf,
            },
            body: form,
        });

        this.button.textContent = "Add image";
        this.input.value = "";
    }
}
