import Life from "./Life";
import NoteBackdrop from "./NoteBackdrop";
import NoteSmallCaps from "./NoteSmallCaps";
import Page from "./Page";

class App {
    constructor() {
        this.notes();
        this.life();
        this.pages();
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

    pages() {
        const page = document.querySelector(".page");

        if (page) new Page(page);
    }
}

addEventListener("DOMContentLoaded", new App());
