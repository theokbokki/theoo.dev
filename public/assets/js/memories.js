import Draggable from './Draggable.js';

class Memories {
    constructor(el) {
        this.el = el;

        if (window.location.hash !== '#intro') {
            window.location.hash = '#intro';
            location.reload();
        };

        document.documentElement.style.overflow = 'hidden';

        this.getElements();

        new Draggable(this.canvas, true);

        this.images.forEach(image => new Draggable(image));
    }

    getElements() {
        this.canvas = this.el.querySelector('.memories__canvas');

        this.images = this.el.querySelectorAll('.memories__img');
    }
}

window.addEventListener('DOMContentLoaded', () => {
    new Memories(document.querySelector('.memories'))
});
