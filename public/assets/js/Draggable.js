export default class Draggable {
    constructor(el, onlyDrag = false) {
        this.el = el;
        this.onlyDrag = onlyDrag;

        this.init();
        this.setEvents();
        this.animate();
    }

    init() {
        this.dragging = false;

        const { rotation, x, y } = this.getTransformValues();
        this.x = x;
        this.y = y;
        this.rotation = rotation;
        this.scale = 1;

        this.targetRotation = this.rotation;
        this.targetScale = this.scale;

        this.initialX = 0;
        this.initialY = 0;

        this.style = this.el.style;
        this.style.cursor = "grab";
    }

    setEvents() {
        this.el.addEventListener("mouseenter", this.onMouseEnter.bind(this));
        this.el.addEventListener("mouseout", this.onMouseOut.bind(this));
        this.el.addEventListener("mousedown", this.onMouseDown.bind(this));
        this.el.addEventListener("mouseup", this.onMouseUp.bind(this));
        this.el.addEventListener("mousemove", this.onMouseMove.bind(this));

        this.el.addEventListener("touchstart", this.onMouseDown.bind(this), false);
        this.el.addEventListener("touchend", this.onMouseUp.bind(this), false);
        this.el.addEventListener("touchmove", this.onMouseMove.bind(this), false);
    }

    onMouseEnter() {
        if (this.dragging || this.onlyDrag) return;

        this.setHoverEffect();
    }

    onMouseOut() {
        if (this.dragging || this.onlyDrag) return;
        this.resetEffect();
    }

    onMouseDown(e) {
        if (e.target !== this.el) return;
        
        if (! e.touches) {
            this.el.setPointerCapture(e.pointerId);
        }

        this.dragging = true;
        this.style.cursor = "grabbing";

        const point = e.touches ? e.touches[0] : e;
        this.initialX = point.clientX - this.x;
        this.initialY = point.clientY - this.y;

        if (!this.onlyDrag) this.setPressedEffect();
    }

    onMouseMove(e) {
        if (!this.dragging) return;

        e.preventDefault();

        const point = e.touches ? e.touches[0] : e;
        this.x = point.clientX - this.initialX;
        this.y = point.clientY - this.initialY;
    }

    onMouseUp(e) {
        if (! e.touches) {
            this.el.releasePointerCapture(e.pointerId);
        }

        this.dragging = false;
        this.style.cursor = "grab";

        if (!this.onlyDrag) this.setHoverEffect();
    }

    setHoverEffect() {
        this.targetScale = 1.03;
        this.targetRotation = this.rotation - 4 * Math.sign(this.rotation);
        this.targetShadow = "0 12px 22px -8px rgba(0, 0, 0, 35%)";
    }

    setPressedEffect() {
        this.targetScale = 1.08;
        this.targetRotation = this.rotation - 8 * Math.sign(this.rotation);
        this.targetShadow = "0 20px 32px -8px rgba(0, 0, 0, 15%)";
    }

    resetEffect() {
        this.targetScale = 1;
        this.targetRotation = this.rotation;
        this.targetShadow = "0 8px 16px -8px rgba(0, 0, 0, 50%)";
    }

    animate() {
        const lerp = (a, b, t) => a + (b - a) * t;

        const update = () => {
            this.scale = lerp(this.scale, this.targetScale, 0.12);
            this.rotation = lerp(this.rotation, this.targetRotation, 0.12);

            const transform = this.onlyDrag
                ? `translate3d(${this.x}px, ${this.y}px, 0)`
                : `translate3d(${this.x}px, ${this.y}px, 0) rotate(${this.rotation}deg) scale(${this.scale})`;

            this.style.transform = transform;

            if (!this.onlyDrag && this.targetShadow) {
                this.style.boxShadow = this.targetShadow;
            }

            requestAnimationFrame(update);
        };

        update();
    }

    getTransformValues() {
        const matrix = window.getComputedStyle(this.el).transform;

        if (!matrix || matrix === "none") {
            return { rotation: 0, x: 0, y: 0 };
        }

        const values = matrix.match(/matrix.*\((.+)\)/)[1].split(", ");
        return {
            rotation: Math.round(Math.atan2(values[1], values[0]) * (180 / Math.PI)),
            x: parseFloat(values[4]),
            y: parseFloat(values[5]),
        };
    }
}
