class Links {
    constructor(el) {
        this.el = el;

        this.getElements();
        this.setEvents();
    }

    getElements() {
        this.imgs = this.el.querySelectorAll('.table__item--img');
    }
    
    setEvents() {
        window.addEventListener('mousemove', this.onMouseMove.bind(this));
    }

    onMouseMove(e) {
        this.imgs.forEach(img => {
            img.style.position = 'fixed';
            img.style.top = 0;
            img.style.left = 0;
            img.style.transform = `translate3d(calc(${e.clientX}px - 50%), calc(${e.clientY}px - 50%), 0)`;
            img.style.transition = 'transform  750ms cubic-bezier(0.27, 0.5, 0.17, 1.33)';
        });
    }
}

window.addEventListener('DOMContentLoaded', () => {
    const el = document.querySelector('.app');

    new Links(el);
});
