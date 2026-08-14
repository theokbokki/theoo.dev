import { gsap } from "gsap";

export default class FocusRing {
    constructor(settings = {}) {
        this.navigationKeys = ["Tab", "ArrowUp", "ArrowDown", "ArrowLeft", "ArrowRight", "Home", "End"];
        this.ringAttribute = "[data-focus-ring]";
        this.sectionAttribute = "[data-focus-section]";

        this.fadeDuration = settings.fadeDuration ?? 0.2;
        this.color = settings.color ?? "#0080FF";
        this.width = settings.width ?? 2;
        this.offset = settings.offset ?? 4;
        this.moveDuration = settings.moveDuration ?? 0.25;
        this.moveEase = settings.moveEase ?? "power3.out";

        this.focusedElement = null;
        this.focusedSection = null;
        this.isVisible = false;
        this.isKeyboardActive = false;

        this.frameId = null;
        this.tick = this.tick.bind(this);

        this.buildRing();
        this.suppressNativeOutline();
        this.listen();
    }

    buildRing() {
        const node = document.createElement("div");
        node.setAttribute("aria-hidden", "true");
        Object.assign(node.style, {
            position: "fixed",
            top: "0",
            left: "0",
            pointerEvents: "none",
            zIndex: "9999",
            opacity: "0",
            outlineStyle: "solid",
            outlineColor: this.color,
            outlineWidth: `${this.width}px`,
            outlineOffset: `${this.offset}px`,
        });
        document.body.appendChild(node);
        this.node = node;

        const config = { duration: this.moveDuration, ease: this.moveEase };
        this.moveX = gsap.quickTo(node, "x", config);
        this.moveY = gsap.quickTo(node, "y", config);
        this.moveWidth = gsap.quickTo(node, "width", config);
        this.moveHeight = gsap.quickTo(node, "height", config);
    }

    suppressNativeOutline() {
        const sheet = document.createElement("style");
        sheet.textContent = `
            ${this.ringAttribute}:focus,
            ${this.ringAttribute}:focus-visible {
                outline: none;
            }
        `;
        document.head.appendChild(sheet);
        this.styleSheet = sheet;
    }

    listen() {
        window.addEventListener("keydown", (event) => this.onKeyDown(event), true);
        window.addEventListener("pointerdown", () => this.onPointerDown(), true);
        document.addEventListener("focusin", (event) => this.onFocusIn(event));
        document.addEventListener("focusout", () => this.onFocusOut());
    }

    measureFocusBox(element) {
        const rect = element.getBoundingClientRect();
        const { borderRadius } = getComputedStyle(element);
        const insetX = Number(element.dataset.focusInsetX) || 0;
        const insetY = Number(element.dataset.focusInsetY) || 0;

        return {
            x: rect.left - insetX,
            y: rect.top - insetY,
            width: rect.width + insetX * 2,
            height: rect.height + insetY * 2,
            borderRadius,
        };
    }

    findRingTarget(element) {
        return element.closest?.(this.ringAttribute) ?? null;
    }

    findSection(element) {
        return element.closest(this.sectionAttribute)?.dataset.focusSection ?? null;
    }

    isNavigationKey(event) {
        const hasModifier = event.metaKey || event.ctrlKey || event.altKey;
        return !hasModifier && this.navigationKeys.includes(event.key);
    }

    onKeyDown(event) {
        if (this.isNavigationKey(event)) this.isKeyboardActive = true;
    }

    onPointerDown() {
        this.isKeyboardActive = false;
    }

    onFocusIn(event) {
        const target = this.findRingTarget(event.target);
        if (!target || !this.isKeyboardActive) {
            this.hide();
            return;
        }

        const section = this.findSection(target);
        const changedSection = this.isVisible && section !== this.focusedSection;

        this.focusedElement = target;
        this.focusedSection = section;

        if (!this.isVisible) this.appear(target);
        else if (changedSection) this.jumpAcross(target);
        else this.glideTo(target);

        this.startTracking();
    }

    onFocusOut() {
        requestAnimationFrame(() => {
            if (!this.findRingTarget(document.activeElement)) this.hide();
        });
    }

    setBorderRadius(borderRadius) {
        this.node.style.borderRadius = borderRadius;
    }

    jumpTo(box) {
        this.setBorderRadius(box.borderRadius);
        gsap.set(this.node, { x: box.x, y: box.y, width: box.width, height: box.height });
        this.moveX(box.x, box.x);
        this.moveY(box.y, box.y);
        this.moveWidth(box.width, box.width);
        this.moveHeight(box.height, box.height);
    }

    appear(element) {
        this.jumpTo(this.measureFocusBox(element));
        this.isVisible = true;
        gsap.killTweensOf(this.node, "opacity");
        gsap.to(this.node, { opacity: 1, duration: this.fadeDuration, ease: "power3.out" });
    }

    glideTo(element) {
        const box = this.measureFocusBox(element);
        this.setBorderRadius(box.borderRadius);
        this.moveX(box.x);
        this.moveY(box.y);
        this.moveWidth(box.width);
        this.moveHeight(box.height);
    }

    jumpAcross(element) {
        const box = this.measureFocusBox(element);
        gsap.killTweensOf(this.node, "opacity");
        const timeline = gsap.timeline();
        timeline.to(this.node, {
            opacity: 0,
            duration: this.fadeDuration * 0.8,
            ease: "power3.out",
            onComplete: () => this.jumpTo(box),
        });
        timeline.to(this.node, { opacity: 1, duration: this.fadeDuration, ease: "power3.out" });
    }

    hide() {
        if (!this.isVisible) return;
        this.isVisible = false;
        this.focusedElement = null;
        this.focusedSection = null;
        this.stopTracking();
        gsap.killTweensOf(this.node, "opacity");
        gsap.to(this.node, { opacity: 0, duration: this.fadeDuration, ease: "power3.out" });
    }

    startTracking() {
        if (this.frameId) return;
        this.frameId = requestAnimationFrame(this.tick);
    }

    stopTracking() {
        if (!this.frameId) return;
        cancelAnimationFrame(this.frameId);
        this.frameId = null;
    }

    tick() {
        this.frameId = requestAnimationFrame(this.tick);
        if (!this.focusedElement || !this.isVisible) return;
        if (!this.focusedElement.isConnected) {
            this.hide();
            return;
        }
        this.glideTo(this.focusedElement);
    }
}
