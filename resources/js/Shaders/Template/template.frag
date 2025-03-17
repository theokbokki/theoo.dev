uniform float u_time;
uniform vec2 u_mouse;
varying vec2 vUv;

void main() {
    vec3 color = vec3(u_mouse.x, u_mouse.y, abs(sin(u_time)));

    gl_FragColor = vec4(color, 1.0);
}
