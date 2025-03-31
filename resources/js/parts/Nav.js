export default class Nav {
    constructor(el) {
        this.el = el;

        this.getElements();
        this.setupHighlighter();
        this.setEvents();
    }

    getElements() {
        this.itemsContainer = this.el.querySelector(".nav__items");
        this.items = this.el.querySelectorAll(".nav__link");
        this.activeItem = this.el.querySelector(".nav__item--active .nav__link");
    }

    setupHighlighter() {
        this.activeItem.parentElement.classList.remove("nav__item--active");
        const itemBounds = this.activeItem.getBoundingClientRect();
        const parentBounds = this.el.getBoundingClientRect();

        this.defaultLeft = itemBounds.left - parentBounds.left;
        this.defaultTop = itemBounds.top - parentBounds.top;
        this.defaultWidth = itemBounds.width;
        this.defaultHeight = itemBounds.height;

        this.highlighter = document.createElement("span");

        this.positionHighlighter(this.defaultLeft, this.defaultTop, this.defaultWidth, this.defaultHeight);

        this.highlighter.classList.add("nav__highlighter");

        this.el.insertBefore(this.highlighter, this.itemsContainer);
    }

    positionHighlighter(left, top, width, height) {
        this.highlighter.style.transform = `translate3d(${left}px, ${top}px, 0)`;
        this.highlighter.style.width = `${width}px`;
        this.highlighter.style.height = `${height}px`;
    }

    setEvents() {
        this.items.forEach((item) => {
            item.addEventListener("mouseenter", this.handleMouseEnter.bind(this));
            item.addEventListener("mouseleave", this.handleMouseLeave.bind(this));
        });
    }

    handleMouseEnter(e) {
        if (this.timeoutId) {
            clearTimeout(this.timeoutId);
            this.timeoutId = null;
        }

        const itemBounds = e.currentTarget.getBoundingClientRect();
        const parentBounds = this.el.getBoundingClientRect();

        const left = itemBounds.left - parentBounds.left;
        const top = itemBounds.top - parentBounds.top;

        this.positionHighlighter(left, top, itemBounds.width, itemBounds.height);
    }

    handleMouseLeave() {
        this.timeoutId = setTimeout(() => {
            this.positionHighlighter(this.defaultLeft, this.defaultTop, this.defaultWidth, this.defaultHeight);
        }, 200);
    }
}
