export default class Nav {
    constructor(el) {
        this.el = el;

        this.getElements();
        this.setup();
        this.setEvents();
    }

    getElements() {
        this.toggle = this.el.querySelector('[data-role="nav-toggle"]');
        this.mobileOpen = document.querySelector('[data-role="mobile-nav-open"]');
        this.mobileClose = document.querySelector('[data-role="mobile-nav-close"]');
    }

    setup() {
        this.closeNav();
    }

    closeNav() {
        this.el.classList.add("opacity-0");

        setTimeout(() => {
            this.el.classList.add("hidden");
        }, 250);

        this.el.dataset.sate = "closed";
    }

    openNav() {
        this.el.classList.remove("hidden");

        setTimeout(() => {
            this.el.classList.remove("opacity-0");
        }, 20);

        this.el.dataset.sate = "open";
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
