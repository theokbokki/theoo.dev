import Draggable from './Draggable.js';

class Memories {
    constructor(el) {
        this.el = el;

        if (window.location.hash !== '#intro') {
            window.location.hash = '#intro';
            location.reload();
        }

        document.documentElement.style.overflow = 'hidden';
        this.el.style.overflow = 'hidden';

        this.getElements();

        this.canvasDrag = new Draggable(this.canvas, true);
        this.images.forEach(image => new Draggable(image));

        this.setupBackToCenter();
    }

    getElements() {
        this.canvas = this.el.querySelector('.memories__canvas');
        this.images = this.el.querySelectorAll('.memories__img');
        this.backToCenterBtn = this.el.querySelector('.memories__btn');
    }

    setupBackToCenter() {
        this.backToCenterBtn.addEventListener('click', (e) => {
            e.preventDefault();
            
            this.canvasDrag.resetPosition(true);
        });
    }
}

window.addEventListener('DOMContentLoaded', () => {
    new Memories(document.querySelector('.memories'));
});
