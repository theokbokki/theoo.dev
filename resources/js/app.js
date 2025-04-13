import OrangeLines from './shaders/OrangeLines/OrangeLines';
import PurpleLines from './shaders/PurpleLines/PurpleLines';
import GradientColors from './shaders/GradientColors/GradientColors';

class App {
    constructor() {
        this.setupShader("orange-lines", OrangeLines);
        this.setupShader("purple-lines", PurpleLines);
        this.setupShader("gradient-colors", GradientColors);
    }

    setupPart(selector, className) {
        document.querySelectorAll(selector).forEach((el) => {
            new className(el);
        });
    }

    setupShader(selector, className) {
        const shader = document.getElementById(selector);

        if (shader) {
            new className(shader);
        }
    }
}

window.addEventListener("DOMContentLoaded", () => {
    new App();
});
