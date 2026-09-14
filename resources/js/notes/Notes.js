import { createElement } from "react";

export default class Notes {
    constructor() {
        this.form = document.querySelector(".notes-form");

        if (!this.form) return;

        this.getEls();
        this.setEvents();
    }

    getEls() {
        this.imageButton = this.form.querySelector("[data-action=image");
        this.linkButton = this.form.querySelector("[data-action=link");
        this.quoteButton = this.form.querySelector("[data-action=quote");
        this.boldButton = this.form.querySelector("[data-action=bold");
        this.italicButton = this.form.querySelector("[data-action=italic");
        this.contentTextarea = this.form.querySelector("#content");
    }

    setEvents() {
        this.imageButton.addEventListener("click", this.uploadImage.bind(this));
        this.linkButton.addEventListener("click", this.insertLink.bind(this));
        this.quoteButton.addEventListener("click", this.insertQuote.bind(this));
        this.boldButton.addEventListener("click", this.insertBold.bind(this));
        this.italicButton.addEventListener("click", this.insertItalic.bind(this));
    }

    uploadImage(e) {
        e.preventDefault();

        this.fileInput = document.createElement("input");
        this.fileInput.setAttribute("type", "file");
        this.fileInput.setAttribute("accept", "image/*");
        this.fileInput.click();

        this.fileInput.addEventListener("change", this.onImageUpload.bind(this));
    }

    async onImageUpload(e) {
        e.preventDefault();

        const files = this.fileInput.files;

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

        this.fileInput.remove();
    }

    insertLink(e) {
        e.preventDefault();

        const start = this.contentTextarea.selectionStart;
        const end = this.contentTextarea.selectionEnd;

        this.contentTextarea.setRangeText("[](", this.contentTextarea.selectionStart, this.contentTextarea.selectionStart, start === end ? "end" : "preserve");
        this.contentTextarea.setRangeText(")", this.contentTextarea.selectionEnd, this.contentTextarea.selectionEnd);
        this.contentTextarea.focus();
        this.contentTextarea.selectionStart = start + 1;
        this.contentTextarea.selectionEnd = start + 1;
    }

    insertQuote(e) {
        e.preventDefault();

        this.contentTextarea.setRangeText("\n\n> ", this.contentTextarea.selectionStart, this.contentTextarea.selectionStart, "end");
        this.contentTextarea.focus();
    }

    insertBold(e) {
        e.preventDefault();

        const start = this.contentTextarea.selectionStart;
        const end = this.contentTextarea.selectionEnd;

        this.contentTextarea.setRangeText("**", this.contentTextarea.selectionStart, this.contentTextarea.selectionStart);

        const newEnd = this.contentTextarea.selectionEnd;

        this.contentTextarea.setRangeText("**", this.contentTextarea.selectionEnd, this.contentTextarea.selectionEnd);
        this.contentTextarea.focus();

        if (start === end) {
            this.contentTextarea.selectionStart = start + 2;
            this.contentTextarea.selectionEnd = start + 2;
        } else {
            this.contentTextarea.selectionStart = newEnd + 2;
            this.contentTextarea.selectionEnd = newEnd + 2;
        }
    }

    insertItalic(e) {
        e.preventDefault();

        const start = this.contentTextarea.selectionStart;
        const end = this.contentTextarea.selectionEnd;

        this.contentTextarea.setRangeText("_", this.contentTextarea.selectionStart, this.contentTextarea.selectionStart);

        const newEnd = this.contentTextarea.selectionEnd;

        this.contentTextarea.setRangeText("_", this.contentTextarea.selectionEnd, this.contentTextarea.selectionEnd);
        this.contentTextarea.focus();

        if (start === end) {
            this.contentTextarea.selectionStart = start + 1;
            this.contentTextarea.selectionEnd = start + 1;
        } else {
            this.contentTextarea.selectionStart = newEnd + 1;
            this.contentTextarea.selectionEnd = newEnd + 1;
        }
    }
}
