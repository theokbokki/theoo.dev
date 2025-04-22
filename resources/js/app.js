import GradientColors from "./shaders/GradientColors/GradientColors";
import YellowPinkCircle from "./shaders/YellowPinkCircle/YellowPinkCircle";

import.meta.glob([
    "../fonts/**",
    "../favicons/**.svg",
    "../favicons/**.png",
    "../favicons/**.ico",
    "../favicons/**.webmanifest",
]);

class App {
    constructor() {
        this.setupShader("gradient-colors", GradientColors);
        this.setupShader("yellow-pink-circle", YellowPinkCircle);
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
