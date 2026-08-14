import { gsap } from "gsap";
import MagnetBackdrop from "./MagnetBackdrop";

export default class Tooltip {
    constructor(el, toggleEl, settings = {}) {
        this.el = el;
        this.toggleEl = toggleEl;

        this.getEls();
        this.init(settings);
        this.setEvents();
    }

    getEls() {
        this.backdrop = this.el.querySelector(".tooltip__backdrop");
        this.items = this.el.querySelectorAll(".tooltip__item");
        this.active = this.el.querySelector(".tooltip__item--active");
    }

    init(settings) {
        this.width = settings.width ?? "auto";
        this.isOpen = settings.open ?? false;

        this.el.style.width = this.width;

        this.positionEl();
    }

    setEvents() {
        window.addEventListener("keydown", this.onKeyDown.bind(this));
        window.addEventListener("click", this.onClickOutside.bind(this));
        this.items.forEach(item => {
            if (item === this.active) return;

            item.addEventListener("mousedown", this.onItemDown.bind(this));
            item.addEventListener("mouseup", this.onItemUp.bind(this));
        });
    }

    onKeyDown(e) {
        if (e.key === "Escape" && this.isOpen) {
            this.close();
        }
    }

    onClickOutside(e) {
        if (e.target === this.el || e.target === this.toggleEl) return

        this.close();
    }

    onItemDown() {
        gsap.to(this.backdrop.el, { scale: .95, duration: .15, ease: "power3.out" });
    }

    onItemUp() {
        gsap.to(this.backdrop.el, { scale: 1, duration: .15, ease: "power3.out" });
    }

    positionEl() {
        const elPosition = this.el.getBoundingClientRect();
        const togglePosition = this.toggleEl.getBoundingClientRect();
        let originX;
        let originY;
        let translateX;
        let translateY;

        if (togglePosition.top >= (window.innerHeight / 2)) {
            translateX = togglePosition.top - elPosition.bottom - 8 + "px";
            originX = "bottom";
        }

        if (togglePosition.top < (window.innerHeight / 2)) {
            translateX = togglePosition.bottom - elPosition.top + 8 + "px";
            originX = "top";
        }

        if (togglePosition.left >= (window.innerWidth / 2)) {
            translateY = togglePosition.right - elPosition.right + "px";
            originY = "right";
        }

        if (togglePosition.left < (window.innerWidth / 2)) {
            translateY = togglePosition.left - elPosition.left + "px";
            originY = "left";
        }

        this.createBackdrop();

        this.el.style.transformOrigin = `${originX} ${originY}`;
        this.el.style.transform = `translate3d(${translateY}, ${translateX}, 0) scale(.5)`
        this.el.style.display = "none";
    }

    toggle() {
        if (this.isOpen) {
            this.close();

            return;
        }

        this.open();
    }

    open() {
        this.isOpen = true;

        gsap.killTweensOf(this.el);

        gsap.to(this.el, {
            display: "flex",
            opacity: 1,
            scale: 1,
            duration: .3,
            ease: "back.out",
            onComplete: () => this.backdrop.ready = true,
        });

    }

    close() {
        this.isOpen = false;
        this.backdrop.ready = false;

        gsap.killTweensOf(this.el);

        let tl = gsap.timeline()

        tl.to(this.el, {
            display: "none",
            opacity: 0,
            duration: .15,
            ease: "power3.out",
        });

        tl.to(this.el, {
            scale: .5,
            duration: 0,
        });
    }

    createBackdrop() {
        this.backdrop = new MagnetBackdrop(
            this.el,
            this.el.querySelectorAll('.tooltip__item'),
            this.el.querySelector('.tooltip__item--active'),
            "tooltip__backdrop",
            false,
        );
    }
}
