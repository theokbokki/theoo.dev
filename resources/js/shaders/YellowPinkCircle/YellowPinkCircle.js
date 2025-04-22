import * as THREE from "three";
import Shader from "../Shader";
import vertexShader from './shader.vert';
import fragmentShader from './shader.frag';

export default class YellowPinkCircle extends Shader {
    createShader() {
        this.uniforms = {
            u_resolution: { value: new THREE.Vector2(this.width, this.height) },
            u_time: { value: 0.0 },
        };

        const material = new THREE.ShaderMaterial({
            uniforms: this.uniforms,
            vertexShader,
            fragmentShader,
        });

        const geometry = new THREE.PlaneGeometry(2, 2);
        this.plane = new THREE.Mesh(geometry, material);
        this.scene.add(this.plane);
    }

    update() {
        this.uniforms.u_time.value = this.clock.getElapsedTime();

        this.uniforms.u_resolution.value.set(this.canvas.clientWidth, this.canvas.clientHeight);
    }
}
