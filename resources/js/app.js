import axios from "axios";
import "./bootstrap";
import TransitionEngine from "./TransitionEngine";

class App {
    constructor() {
        this.controller = new AbortController();
    }
}

window.addEventListener("DOMContentLoaded", () => {
    window.app = new App();
    new TransitionEngine();
});
