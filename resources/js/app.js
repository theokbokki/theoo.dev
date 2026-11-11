import Life from "./Life";
import NoteBackdrop from "./NoteBackdrop";
import NoteSmallCaps from "./NoteSmallCaps";

class App {
    constructor() {
        this.notes();
        this.life();
    }

    notes() {
        const backdrop = document.querySelector(".note-backdrop");
        const content = document.querySelector(".note__content");

        if (backdrop) new NoteBackdrop(backdrop);
        if (content) new NoteSmallCaps(content);
    }

    life() {
        const form = document.querySelector(".life__form");

        if (form) new Life(form)
    }
}

addEventListener("DOMContentLoaded", new App());
