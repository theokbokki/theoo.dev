import NoteBackdrop from "./NoteBackdrop";

class App {
    constructor() {
        this.notes();
    }

    notes() {
        const backdrop = document.querySelector(".note-backdrop");

        if (backdrop) new NoteBackdrop(backdrop);
    }
}

addEventListener("DOMContentLoaded", new App());
