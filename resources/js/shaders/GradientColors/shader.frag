#ifdef GL_ES
precision mediump float;
#endif

uniform vec2 u_resolution;
uniform float u_time;

void main() {
    vec2 uv = gl_FragCoord.xy / u_resolution.xy;
    uv.x *= u_resolution.x / u_resolution.y;

    float angle = atan(uv.y + 0.5, uv.x + 0.5) * 0.5 + u_time * 0.2;
    float dist = length(uv - vec2(0.001));

    float colorIntensity = cos(angle * -2.0) + sin(dist * 2.0 - u_time * 0.2);
    vec3 color = vec3(1.0 + 0.5 * sin(colorIntensity * 3.0), 0.5 + 0.5 * cos(colorIntensity * 1.0), 0.5 + 1.0 * sin(colorIntensity * 2.0));

    color = mix(color, vec3(0.3, 0.6, 0.2), 0.2);

    gl_FragColor = vec4(color, 1.0);
}
