#version 300 es
precision mediump float;

uniform sampler2D u_texture;
uniform vec2 u_resolution;
uniform vec3 u_color;

out vec4 fragColor;

void main() {
    vec2 uv = gl_FragCoord.xy / u_resolution;
    uv.y = 1.0 - uv.y;
    vec2 normalizedPixelSize = vec2(4.0) / u_resolution;
    vec2 uvPixel = normalizedPixelSize * floor(uv / normalizedPixelSize);

    vec4 color = texture(u_texture, uvPixel);
    float luma = dot(vec3(0.2126, 0.7152, 0.0722), color.rgb);

    vec2 cellUV = fract(uv / normalizedPixelSize);
    float height = 1.25 - luma;

    float xStart = 0.05;
    float xEnd = 0.95;

    if (
        cellUV.x > xStart &&
        cellUV.x < xEnd &&
        cellUV.y > 0.0 &&
        cellUV.y < height &&
        color.a > 0.0
    ) {
        color = vec4(u_color, 1.0);
    } else {
        color = vec4(vec3(1.0), 0.0);
    }

    fragColor = color;
}
