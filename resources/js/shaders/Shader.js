import * as THREE from "three";

export default class Shader {
    constructor(canvas) {
        this.canvas = canvas;

        this.width = this.canvas.clientWidth;
        this.height = this.canvas.clientHeight;

        this.scene = new THREE.Scene();
        this.camera = new THREE.PerspectiveCamera(75, this.width / this.height, 0.1, 1000);
        this.camera.position.z = 1;

        this.renderer = new THREE.WebGLRenderer({ canvas: this.canvas, antialias: true });
        this.renderer.setSize(this.width, this.height);

        this.clock = new THREE.Clock();

        if (this.createShader === Shader.prototype.createShader) {
            throw new Error("Subclasses of ShaderBase must implement a createShader() method");
        }

        this.createShader();

        this.handleResize();

        this.animate();
    }

    createShader() {
        throw new Error("createShader() must be implemented in the subclass.");
    }

    handleResize() {
        window.addEventListener("resize", () => {
            this.width = this.canvas.parentElement.offsetWidth;
            this.height = this.width;
            this.canvas.width = this.width;
            this.canvas.height = this.height;
            this.canvas.style.width = this.width + "px";
            this.canvas.style.height = this.height + "px";
            this.renderer.setSize(this.width, this.height, false);
            this.camera.aspect = this.width / this.height;
            this.camera.updateProjectionMatrix();
        });
    }

    animate() {
        requestAnimationFrame(() => this.animate());
        if (typeof this.update === "function") {
            this.update(this.clock.getElapsedTime());
        }
        this.renderer.render(this.scene, this.camera);
    }
}
