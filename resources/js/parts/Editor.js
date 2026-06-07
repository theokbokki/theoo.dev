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
    }

    setEvents() {
        this.toggle.addEventListener("click", this.onToggle.bind(this));

        this.el.addEventListener("input", debounce(this.onInput.bind(this)));

        this.el.addEventListener("paste", this.onPaste.bind(this));
    }

    onToggle() {
        this.el.style.display = this.show ? "none" : "block";
        this.content.style.display = this.show ? "block" : "none";

        this.show = !this.show;
    }

    async onInput(e) {
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

    async onPaste(e) {
        e.preventDefault();

        const start = this.el.selectionStart;
        const end = this.el.selectionEnd;

        const items = e.clipboardData.items;

        let text = null;

        for (const item of items) {
            if (item.type && item.type.startsWith("image/")) {
                const blob = item.getAsFile();
                if (!blob) break;

                const file = new File([blob], "pasted-image", {
                    type: blob.type,
                });

                const form = new FormData();
                form.append(
                    "file",
                    blob,
                    "pasted-image." + blob.type.split("/")[1],
                );

                const response = await fetch(
                    "/page/upload/" + this.el.dataset.id,
                    {
                        method: "POST",
                        headers: {
                            "X-Requested-With": "XMLHttpRequest",
                            "X-CSRF-TOKEN": this.csrf,
                        },
                        body: form,
                    },
                );

                console.log(response);

                const pos = this.el.selectionStart;

                const data = await response.json();
                text = `[![](${data.thumb})](${data.full})`;
            }
        }

        if (!text) {
            text = e.clipboardData.getData("text/plain") || "";
        }

        if (text.length > 0) {
            this.el.value =
                this.el.value.slice(0, start) + text + this.el.value.slice(end);

            const newPos = start + text.length;
            this.el.setSelectionRange(newPos, newPos);

            this.onInput();
        }
    }
}
