import "./bootstrap";
import Nav from "./parts/Nav";
import OrangeLines from './shaders/OrangeLines/OrangeLines';
import PurpleLines from './shaders/PurpleLines/PurpleLines';
import GradientColors from './shaders/GradientColors/GradientColors';

class App {
    constructor() {
        this.setupPart(".nav", Nav);

        new OrangeLines("orange-lines");
        new PurpleLines("purple-lines");
        new GradientColors("gradient-colors");
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
