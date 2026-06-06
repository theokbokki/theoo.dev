import BackdropLeaves from "./parts/BackdropLeaves";
import Editor from "./parts/Editor";

window.addEventListener("DOMContentLoaded", () => {
    new BackdropLeaves(document.querySelector(".backdrop__leaves"));

    const editor = document.querySelector(".editor");
    if (editor) {
        new Editor(editor);
    }
});
