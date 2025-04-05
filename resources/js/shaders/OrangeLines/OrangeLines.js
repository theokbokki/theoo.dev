import * as THREE from "three";
import Shader from "../Shader";
import vertexShader from './shader.vert';
import fragmentShader from './shader.frag';

export default class OrangeLines extends Shader {
    createShader() {
        // Set uniforms for time and resolution
        this.uniforms = {
            u_resolution: { value: new THREE.Vector2(this.width, this.height) },
            u_fixedResolution: { value: new THREE.Vector2(800.0, 800.0) },
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
        // Update time uniform each frame
        this.uniforms.u_time.value = this.clock.getElapsedTime();

        // Optionally, update resolution in case the canvas has been resized:
        this.uniforms.u_resolution.value.set(this.canvas.clientWidth, this.canvas.clientHeight);
    }
}
