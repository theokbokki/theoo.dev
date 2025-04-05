#ifdef GL_ES
precision mediump float;
#endif

uniform vec2 u_resolution;
uniform float u_time;

float random(vec2 uv) {
    return fract(sin(dot(uv.xy, vec2(12.9898, 78.233))) * 43758.5453123);
}

void main() {
    vec2 uv = (gl_FragCoord.xy - 0.5 * u_resolution) / min(u_resolution.x, u_resolution.y);

    uv *= 75.0;
    uv.x -= 300.0;
    uv.y -= 3.0;

    float x = uv.x;
    float y = uv.y;

    float offsetX = sin(x / 40.0);
    float offsetY = sin(y / 40.0);

    float distance = length(vec2(offsetX, offsetY));
    float angle = cos(sin(distance)) * 3.0;
    float d = 5.0 * cos(sin(angle));

    float timeOffset = sin(cos(u_time / 10.0)) * 20.0 + 3.14159 / 60.0;
    float radialFactor = cos(sin(offsetY)) + 20.0;
    float oscillation = cos(sin(d * 100.0));

    float q = (x / 10.0 + offsetX / radialFactor * oscillation);
    float angleOffset = d / 300.0 - timeOffset / 8.0;

    float transformedX = q * angleOffset / 20.0;
    float transformedY = (y / 4.0 + 5.0 * angle * angle + q) / 2.0 * cos(angleOffset);

    float colorIntensity = sin(transformedX + transformedY) * 4.0 + 4.0;

    gl_FragColor = vec4(
            colorIntensity / 2.0,
            colorIntensity / (random(uv / 100000.0)) / 10.0,
            colorIntensity,
            1.0
        );
}
