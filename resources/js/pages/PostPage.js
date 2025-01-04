import Wysiwyg from "../parts/wysiwyg";

export default class PostPage {
    constructor(el) {
        this.el = el;

        this.getElements();
        this.initElements();
    }

    getElements() {
        this.wysiwygs = this.el.querySelectorAll(".wysiwyg")
    }

    initElements() {
        this.wysiwygs.forEach((el) => new Wysiwyg(el));
    }
}
