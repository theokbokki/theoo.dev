import "./bootstrap";
import Nav from "./parts/Nav.js";

class App {
    constructor(el) {
        this.el = el;
        document.body.classList.remove('opacity-0');

        this.linkJs('[data-role="nav"]', Nav);
    }

    linkJs(selector, className) {
        const els = document.querySelectorAll(selector);

        els.forEach((el) => {
            new className(el);
        });
    }
}

window.addEventListener("DOMContentLoaded", () => {
    const el = document.getElementById("app");
    new App(el);
});
