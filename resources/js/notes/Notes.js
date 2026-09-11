export default class Notes {
    constructor() {
        this.form = document.querySelector(".notes__form");

        if (!this.form) return;

        this.getEls();
        this.setEvents();
    }

    getEls() {
        this.uploadImageInput = this.form.querySelector("#upload-image");
        this.contentTextarea = this.form.querySelector("#content");
    }

    setEvents() {
        this.uploadImageInput.addEventListener("change", this.onImageUpload.bind(this));
    }

    async onImageUpload(e) {
        e.preventDefault();

        const files = this.uploadImageInput.files;

        if (!files.length) return;

        const images = [...files]
            .filter(file => file.type.startsWith("image/"))
            .filter(Boolean);

        if (!images.length) return;

        const form = new FormData();

        images.forEach((image, index) => {
            let uuid = self.crypto.randomUUID();

            this.contentTextarea.setRangeText(`![](/storage/notes/thumb/${uuid}.webp)`, this.contentTextarea.selectionEnd, this.contentTextarea.selectionEnd, "end");

            form.append("files[]", image);
            form.append("uuids[]", uuid);

            if (index === images.length - 1) return;

            this.contentTextarea.setRangeText("\n\n", this.contentTextarea.selectionEnd, this.contentTextarea.selectionEnd, "end");
        });

        const response = await fetch("/notes/image", {
            method: "POST",
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": this.csrf,
            },
            body: form,
        });

        this.uploadImageInput.value = "";
    }
}
