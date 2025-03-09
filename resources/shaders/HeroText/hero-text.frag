uniform float u_time;

varying vec2 vUv;

void main() {
    float angle = atan(vUv.y + 0.5, vUv.x + 0.5) * 0.5 + u_time * 0.2;
    float dist = length(vUv - vec2(0.001));

    float colorIntensity = cos(angle * -2.0) + sin(dist * 2.0 - u_time * 0.2);
    vec3 color = vec3(1.0 + 0.5 * sin(colorIntensity * 3.0), 0.5 + 0.5 * cos(colorIntensity * 1.0), 0.5 + 1.0 * sin(colorIntensity * 2.0));

    color = mix(color, vec3(0.3, 0.6, 0.2), 0.2);

    gl_FragColor = vec4(color, 1.0);
}
