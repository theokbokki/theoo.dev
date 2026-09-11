import Posts from "./posts/Posts";
import Notes from "./notes/Notes";

class App {
    constructor() {
        new Notes;
        new Posts;
    }
}

window.addEventListener('DOMContentLoaded', new App());
