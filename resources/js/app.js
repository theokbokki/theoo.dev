import BackdropLeaves from "./parts/BackdropLeaves";
import DynamicFavicon from "./parts/DynamicFavicon";
import Editor from "./parts/Editor";

window.addEventListener("DOMContentLoaded", () => {
    new BackdropLeaves(document.querySelector(".backdrop__leaves"));
    new DynamicFavicon(document.getElementById("favicon"));

    const editor = document.querySelector(".editor");
    if (editor) {
        new Editor(editor);
    }
});
