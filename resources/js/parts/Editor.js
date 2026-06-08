import { debounce } from "../Helpers";

export default class Editor {
    constructor(el) {
        this.el = el;

        this.init();
        this.getElements();
        this.setEvents();
    }

    init() {
        this.show = false;
        this.csrf = document.querySelector('meta[name="csrf-token"]').content;
    }

    getElements() {
        this.toggle = document.querySelector('[data-action="editor"]');
        this.content = document.querySelector(".content");
        this.imageBtn = document.querySelector('[data-action="image"]');
        this.imageInput = document.querySelector("#image");
    }

    setEvents() {
        this.toggle.addEventListener("click", this.onToggle.bind(this));

        this.el.addEventListener("input", debounce(this.onInput.bind(this)));

        this.el.addEventListener("paste", this.onPaste.bind(this));

        this.imageBtn.addEventListener("click", () => this.imageInput.click());

        this.imageInput.addEventListener("change", this.onImage.bind(this));
    }

    onToggle() {
        this.el.style.display = this.show ? "none" : "block";
        this.content.style.display = this.show ? "block" : "none";

        this.show = !this.show;
    }

    async onInput() {
        const response = await fetch("/page/update/" + this.el.dataset.id, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": this.csrf,
            },
            body: JSON.stringify({ content: this.el.value }),
        });

        const data = await response.json();

        this.content.innerHTML = data.html;
    }

    async uploadFiles(files) {
        const images = [...files]
            .filter((f) => f.type.startsWith("image/"))
            .filter(Boolean);

        if (!images.length) return null;

        const form = new FormData();
        images.forEach((file) => form.append("files[]", file));

        const response = await fetch("/page/upload/" + this.el.dataset.id, {
            method: "POST",
            headers: {
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-TOKEN": this.csrf,
            },
            body: form,
        });

        const results = await response.json();

        return results
            .map((img) => `[![](${img.thumb})](${img.full})`)
            .join("\n\n");
    }

    insertText(text) {
        const start = this.el.selectionStart;
        const end = this.el.selectionEnd;

        this.el.value =
            this.el.value.slice(0, start) + text + this.el.value.slice(end);

        const newPos = start + text.length;
        this.el.setSelectionRange(newPos, newPos);

        this.onInput();
    }

    async onPaste(e) {
        e.preventDefault();

        const images = [...e.clipboardData.items]
            .map((item) => item.getAsFile())
            .filter((f) => f?.type.startsWith("image/"));

        const text = images.length
            ? await this.uploadFiles(images)
            : e.clipboardData.getData("text/plain") || "";

        if (text) this.insertText(text);
    }

    async onImage() {
        if (!this.imageInput.files.length) return;

        if (typeof ClipboardItem !== "undefined" && navigator.clipboard.write) {
            const textPromise = this.uploadFiles(this.imageInput.files).then(
                (text) => new Blob([text || ""], { type: "text/plain" }),
            );

            navigator.clipboard.write([
                new ClipboardItem({ "text/plain": textPromise }),
            ]);
        } else {
            const text = await this.uploadFiles(this.imageInput.files);

            if (text) await navigator.clipboard.writeText(text);
        }

        this.imageBtn.textContent = "Image Copied";
        this.imageBtn.style.outline = "2px solid rgba(104, 125, 47, .5)";
        this.imageBtn.style.outlineOffset = "2px";

        setTimeout(() => {
            this.imageBtn.textContent = "Add image";
            this.imageBtn.style.outline = "none";
        }, 2000);

        this.imageInput.value = "";
    }
}
