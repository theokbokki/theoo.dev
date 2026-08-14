import gsap from "gsap";

export default class MagnetBackdrop {
    constructor(parent, targets, baseTarget = null, className = null, ready = true) {
        this.parent = parent;
        this.targets = Array.from(targets);
        this.baseTarget = baseTarget;
        this.className = className;
        this.ready = ready;

        this.current = null;
        this.visible = false;

        this.createEl();
        this.styleEl();
        if (this.baseTarget) this.positionEl();

        this.setEvents();
    }

    createEl() {
        this.el = document.createElement("div");
        this.parent.prepend(this.el);
    }

    styleEl() {
        if (this.className) {
            this.el.classList.add(this.className);
        }

        this.el.style.position = "absolute";
        this.el.style.pointerEvents = "none";
        this.el.style.zIndex = -1;
        this.el.style.transformOrigin = "center";
        this.el.style.opacity = this.baseTarget ? "1" : "0";
    }

    positionEl() {
        this.moveEl(this.baseTarget);
        this.current = this.baseTarget;
        this.visible = true;
    }

    moveEl(target, instant = false) {
        if (window.getComputedStyle(this.parent).display === "none") {
            return;
        }

        const targetBounds = target.getBoundingClientRect();
        const elBounds = this.el.getBoundingClientRect();

        return gsap.to(this.el, {
            width: targetBounds.width,
            height: targetBounds.height,
            x: "+=" + (targetBounds.left - elBounds.left),
            y: "+=" + (targetBounds.top - elBounds.top),
            duration: instant ? 0 : 0.2,
            ease: "back.out",
        });
    }

    goTo(target) {
        this.killMove();

        if (!this.visible) {
            let tl = gsap.timeline();

            tl.add(this.moveEl(target, true));
            tl.to(this.el, {
                opacity: 1,
                duration: 0.2,
                ease: "power3.out",
            });
            this.visible = true;

            return;
        }

        this.moveEl(target);
    }

    fadeOut() {
        this.killMove();
        gsap.to(this.el, { opacity: 0, duration: 0.2, ease: "power3.out" });
        this.visible = false;
    }

    returnToRest() {
        if (this.baseTarget) {
            this.current = this.baseTarget;
            this.goTo(this.baseTarget);

            return;
        }

        this.current = null;
        this.fadeOut();
    }

    setEvents() {
        this.parent.addEventListener("pointermove", this.onPointerMove.bind(this));

        this.parent.addEventListener("pointerleave", this.onPointerLeave.bind(this));

        this.parent.addEventListener("focusin", this.onFocusIn.bind(this));

        this.parent.addEventListener("focusout", this.onFocusOut.bind(this));
    }

    onPointerMove(e) {
        if (!this.ready) return;

        const target = this.targets.find((t) => t.contains(e.target));

        if (target) {
            clearTimeout(this.leaveTimeout);

            if (target !== this.current) {
                this.current = target;
                this.goTo(target);
            }

            return;
        }

        if (this.baseTarget && this.current === this.baseTarget) return;
        if (!this.baseTarget && !this.visible) return;

        clearTimeout(this.leaveTimeout);
        this.leaveTimeout = window.setTimeout(() => this.returnToRest(), 200);
    }

    onPointerLeave() {
        if (!this.ready) return;

        clearTimeout(this.leaveTimeout);
        this.leaveTimeout = window.setTimeout(() => this.returnToRest(), 200);
    }

    onFocusIn(e) {
        if (!this.ready) return;

        const target = this.targets.find((t) => t.contains(e.target));
        if (!target) return;

        clearTimeout(this.leaveTimeout);

        if (target === this.current) return;

        this.current = target;
        this.goTo(target);
    }

    onFocusOut(e) {
        if (!this.ready) return;

        requestAnimationFrame(() => {
            const active = document.activeElement;
            const stillInside = this.targets.some((t) => t.contains(active));

            if (stillInside) return;

            this.returnToRest();
        });
    }

    killMove() {
        gsap.killTweensOf(this.el, "width,height,x,y,opacity");
    }
}
