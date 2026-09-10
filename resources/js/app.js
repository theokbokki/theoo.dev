import ImageUpload from "./notes/ImageUpload";
import PostsDraft from "./posts/PostsDraft";

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
        const postsDraftForm = document.querySelector(".posts__form--draft");

        if (! postsDraftForm) return;

        new PostsDraft(postsDraftForm);
    }
}

window.addEventListener('DOMContentLoaded', new App());
