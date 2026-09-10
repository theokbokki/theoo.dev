import ImageUpload from "./notes/ImageUpload";
import Posts from "./posts/Posts";

class App {
    constructor() {
        this.notes();
        this.posts();
    }

    notes() {
        const editForm = document.getElementById("edit-note");

        if (! editForm) return;

        new ImageUpload(editForm);
    }

    posts() {
        new Posts();
    }
}

window.addEventListener('DOMContentLoaded', new App());
