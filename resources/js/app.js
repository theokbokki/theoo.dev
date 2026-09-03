import ImageUpload from "./notes/ImageUpload";
class App {
    constructor() {
        this.notes();
    }

    notes() {
        const editForm = document.getElementById("edit-note");

        if (! editForm) return;

        new ImageUpload(editForm);
    }
}

window.addEventListener('DOMContentLoaded', new App());
