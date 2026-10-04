import NoteBackdrop from "./NoteBackdrop";
import NoteSmallCaps from "./NoteSmallCaps";

class App {
    constructor() {
        this.notes();
    }

    notes() {
        const backdrop = document.querySelector(".note-backdrop");
        const content = document.querySelector(".note__content");

        if (backdrop) new NoteBackdrop(backdrop);
        if (content) new NoteSmallCaps(content);
    }
}

addEventListener("DOMContentLoaded", new App());
