import "./bootstrap";
import Nav from "./parts/Nav";

class App {
    constructor() {
        this.setupPart(".nav", Nav);
    }

    setupPart(selector, className) {
        document.querySelectorAll(selector).forEach((el) => {
            new className(el);
        });
    }
}

window.addEventListener("DOMContentLoaded", () => {
    new App();
});
