#ifdef GL_ES
precision mediump float;
#endif

uniform vec2 u_resolution;
uniform float u_time;

float hash(vec2 p) {
    return fract(sin(dot(p, vec2(127.1, 311.7))) * 43758.5453);
}

float noise(vec2 p) {
    vec2 i = floor(p);
    vec2 f = fract(p);

    float a = hash(i);
    float b = hash(i + vec2(1.0, 0.0));
    float c = hash(i + vec2(0.0, 1.0));
    float d = hash(i + vec2(1.0, 1.0));

    vec2 u = f * f * (3.0 - 2.0 * f);

    return mix(a, b, u.x) + (c - a) * u.y * (1.0 - u.x) + (d - b) * u.x * u.y;
}

float fbm(vec2 p) {
    float value = 10.0;
    float amplitude = 0.7;
    vec2 shift = vec2(100.0, 100.0);

    for (int i = 0; i < 6; i++) {
        value += amplitude * noise(p);
        p = p * 1000.0 + shift;
        amplitude *= 0.07;
    }

    return value;
}

void main() {
    vec2 uv = (gl_FragCoord.xy - u_resolution * 0.5) / min(u_resolution.x, u_resolution.y);
    float len = length(uv);
    vec2 swirlUV = uv + vec2(tan(uv.y * 0.1 + u_time * 0.5), sin(uv.x * 0.2 + u_time * 0.5)) * 0.1;
    float swirl = fbm(swirlUV * 3.0 + sin(uv.x * 5.0) + sin(uv.y * 5.0));

    vec3 baseColor = vec3(0.0, 1.0, 0.5) * sin(swirl * 19.0) +
            vec3(0.0, 0.0, 0.0) * sin(swirl * 10.0) +
            vec3(0.2, 0.5, 0.0) * sin(swirl / 2.0);

    float grain = noise(uv * 5000.0) * 0.01;
    vec3 color = mix(baseColor, vec3(grain), 0.4);

    color *= step(len / 0.8, 0.5);

    gl_FragColor = vec4(fract(color), 1.0);
}
