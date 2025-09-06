import * as THREE from "three";

class App {
    constructor() {
        this.getElements();
        this.init();
    }

    getElements() {
        this.header = document.querySelector('.header');
    }

    async init() {
        this.color = window.getComputedStyle(document.body)
            .getPropertyValue('--fg')
            .split(', ')
            .map((n) => parseFloat(n/255));

        this.manifest = await (await this.fetchAsset('/assets/manifest.json')).json();

        this.pet = this.getPet();

        this.vert = await (await this.fetchAsset(this.asset('ticket.vert'))).text();
        this.frag = await (await this.fetchAsset(this.asset('ticket.frag'))).text();

        this.size = { x: 150, y: 150 };

        this.createCanvas();
    }

    getPet() {
        const pets = ['matcha-full', 'tsuki-full', 'neko-full'];
        const pet = pets[Math.floor(Math.random() * pets.length)];

        return this.asset(pet + '.webp');
    }

    async fetchAsset(assetPath) {
        const res = await fetch(assetPath);

        if (!res.ok) throw new Error(`Failed to fetch asset ${assetPath}`);

        return res;
    }

    asset(name) {
        if (this.manifest && this.manifest[name]) {
            return '/' + this.manifest[name];
        }
        return '/assets/' + name;
    }


    animate(renderer, scene, camera, uniforms) {
        renderer.render(scene, camera);
    }

    createCanvas() {
        const scene = new THREE.Scene();

        const camera = new THREE.OrthographicCamera(-1, 1, 1, -1, 0.1, 10);
        camera.position.z = 1;

        const renderer = new THREE.WebGLRenderer();
        renderer.setSize(this.size.x, this.size.y);

        this.header.appendChild(renderer.domElement);
        renderer.domElement.classList.add('header__canvas');

        const loader = new THREE.TextureLoader();
        const texture = loader.load(this.pet);
        texture.colorSpace = THREE.SRGBColorSpace;

        const uniforms = {
            u_resolution: { value: new THREE.Vector2(this.size.x, this.size.y) },
            u_texture: { value: texture },
            u_color: { value: new THREE.Vector3(...this.color) }
        };

        const geometry = new THREE.PlaneGeometry(2, 2);
        const material = new THREE.ShaderMaterial({
            uniforms,
            vertexShader: this.vert,
            fragmentShader: this.frag,
            side: THREE.DoubleSide,
        });
        const plane = new THREE.Mesh(geometry, material);
        scene.add(plane);

        renderer.setAnimationLoop(() => this.animate(renderer, scene, camera, uniforms));
    }
}

window.addEventListener('DOMContentLoaded', () => new App());
