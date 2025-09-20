class App {
    constructor() {
        this.init();
    }

    async init() {
        this.color = window.getComputedStyle(document.body)
            .getPropertyValue('--fg')
            .split(', ')
            .map((n) => parseFloat(n / 255));

        this.size = { x: 150, y: 150 };

        // pick a random pet texture
        const pets = ['matcha-full.webp', 'tsuki-full.webp', 'neko-full.webp'];
        const pet = pets[Math.floor(Math.random() * pets.length)];
        this.pet = `/assets/img/${pet}`;

        // load shaders
        this.vert = await (await fetch('/assets/shaders/ticket.vert')).text();
        this.frag = await (await fetch('/assets/shaders/ticket.frag')).text();

        this.createCanvas();
    }

    createShader(gl, type, source) {
        const shader = gl.createShader(type);
        gl.shaderSource(shader, source);
        gl.compileShader(shader);
        if (!gl.getShaderParameter(shader, gl.COMPILE_STATUS)) {
            console.error(gl.getShaderInfoLog(shader));
            throw new Error("Shader compile error");
        }
        return shader;
    }

    createProgram(gl, vertSrc, fragSrc) {
        const program = gl.createProgram();
        const vShader = this.createShader(gl, gl.VERTEX_SHADER, vertSrc);
        const fShader = this.createShader(gl, gl.FRAGMENT_SHADER, fragSrc);
        gl.attachShader(program, vShader);
        gl.attachShader(program, fShader);
        gl.linkProgram(program);
        if (!gl.getProgramParameter(program, gl.LINK_STATUS)) {
            console.error(gl.getProgramInfoLog(program));
            throw new Error("Program link error");
        }
        return program;
    }

    async createCanvas() {
        const canvas = document.getElementById('pets-canvas');
        canvas.width = this.size.x;
        canvas.height = this.size.y;

        const gl = canvas.getContext('webgl2');
        if (!gl) throw new Error('WebGL2 not supported');

        const program = this.createProgram(gl, this.vert, this.frag);
        gl.useProgram(program);

        // fullscreen quad
        const vertices = new Float32Array([
            -1, -1,
             1, -1,
            -1,  1,
            -1,  1,
             1, -1,
             1,  1
        ]);
        const vao = gl.createVertexArray();
        gl.bindVertexArray(vao);

        const vbo = gl.createBuffer();
        gl.bindBuffer(gl.ARRAY_BUFFER, vbo);
        gl.bufferData(gl.ARRAY_BUFFER, vertices, gl.STATIC_DRAW);

        const posLoc = gl.getAttribLocation(program, 'a_position');
        gl.enableVertexAttribArray(posLoc);
        gl.vertexAttribPointer(posLoc, 2, gl.FLOAT, false, 0, 0);

        // uniforms
        const uResolution = gl.getUniformLocation(program, 'u_resolution');
        const uColor = gl.getUniformLocation(program, 'u_color');
        const uTexture = gl.getUniformLocation(program, 'u_texture');

        // texture
        const tex = gl.createTexture();
        const img = new Image();
        img.src = this.pet;
        img.onload = () => {
            gl.bindTexture(gl.TEXTURE_2D, tex);
            gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_S, gl.CLAMP_TO_EDGE);
            gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_WRAP_T, gl.CLAMP_TO_EDGE);
            gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MIN_FILTER, gl.LINEAR);
            gl.texParameteri(gl.TEXTURE_2D, gl.TEXTURE_MAG_FILTER, gl.LINEAR);
            gl.texImage2D(gl.TEXTURE_2D, 0, gl.RGBA, gl.RGBA, gl.UNSIGNED_BYTE, img);

            requestAnimationFrame(render);
        };

        const render = (time) => {
            gl.viewport(0, 0, canvas.width, canvas.height);
            gl.clearColor(0, 0, 0, 1);
            gl.clear(gl.COLOR_BUFFER_BIT);

            gl.useProgram(program);
            gl.uniform2f(uResolution, this.size.x, this.size.y);
            gl.uniform3fv(uColor, this.color);
            gl.uniform1i(uTexture, 0);

            gl.bindVertexArray(vao);
            gl.drawArrays(gl.TRIANGLES, 0, 6);

            requestAnimationFrame(render);
        };
    }
}

window.addEventListener('DOMContentLoaded', () => new App());
