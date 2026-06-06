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
    }

    getElements() {
        this.toggle = document.querySelector('[data-action="editor"]');
        this.content = document.querySelector(".content");
    }

    setEvents() {
        this.toggle.addEventListener("click", this.onToggle.bind(this));
        this.el.addEventListener("input", debounce(this.onInput.bind(this)));
    }

    onToggle() {
        this.el.style.display = this.show ? "none" : "block";
        this.content.style.display = this.show ? "block" : "none";

        this.show = !this.show;
    }

    async onInput(e) {
        const response = await fetch("/page/edit/" + this.el.dataset.routeKey, {
            method: "POST",
            body: this.el.value,
        });
    }
}
