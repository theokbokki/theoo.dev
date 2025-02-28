export default class Nav {
    constructor(el) {
        this.el = el;

        this.getElements();
        this.setup();
        this.setEvents();
    }

    getElements() {
        this.container = document.querySelector('[data-role="nav-container"]');
        this.toggle = this.el.querySelector('[data-role="nav-toggle"]');
        this.mobileOpen = document.querySelector('[data-role="mobile-nav-open"]');
        this.mobileClose = document.querySelector('[data-role="mobile-nav-close"]');
    }

    setup() {
        this.el.classList.add("absolute");
        this.el.classList.add("hidden");
        this.el.classList.add("opacity-0");
    }

    closeNav() {
        this.el.classList.add("opacity-0");
        this.container.classList.add("before:opacity-0");
        this.el.style.transform = "scale(0.98)";

        setTimeout(() => {
            this.el.classList.add("hidden");
            this.container.classList.add("before:hidden");
        }, 250);

        this.el.dataset.sate = "closed";
    }

    openNav() {
        this.el.classList.remove("hidden");
        this.container.classList.remove("before:hidden");
        this.el.style.transform = "translate3d(0, 1.5rem, 0) scale(0.98)";
        document.body.classList.add('overflow-hidden');
        document.body.classList.add('h-full');

        setTimeout(() => {
            this.el.classList.remove("opacity-0");
            this.container.classList.remove("before:opacity-0");
            this.el.style.transform = "translate3d(0, 0, 0) scale(1.0)";
        }, 20);

        this.el.dataset.state = "open";
    }

    setEvents() {
        this.mobileOpen.addEventListener("click", (e) => {
            e.preventDefault();

            this.openNav();
        });

        this.mobileClose.addEventListener("click", (e) => {
            e.preventDefault();

            this.closeNav();
        });
    }
}
