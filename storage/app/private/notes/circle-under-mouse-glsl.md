```
#ifdef GL_ES
precision mediump float;
#endif

uniform float u_time;
uniform vec2 u_resolution;
uniform vec2 u_mouse;

float sdCircle(vec2 position, float radius)
{
    return length(position) - radius;
}

void main() {
    vec2 uv = gl_FragCoord.xy / u_resolution.y;
    vec2 mouseUv = u_mouse.xy / u_resolution.y;

    mouseUv.y = 1.0 - mouseUv.y;

    float circle = sdCircle(uv - mouseUv, 0.2);

    vec3 color;

    if(circle > 0.0) {
        color = vec3(0.0, 0.0, 0.0);
    } else {
        color = vec3(1.0, 1.0, 1.0);
    }

    gl_FragColor = vec4(color, 1.0);
}
```
