class Journal {
    constructor(el) {
        this.canvas = el;
        
        this.getElements();
        this.init();
        this.removeNoJs();

        this.textCanvas = document.createElement('canvas');
        this.tctx = this.textCanvas.getContext('2d');
        this.gl = this.canvas.getContext('webgl');
        if (!this.gl) throw new Error("WebGL not supported");

        this.fragShaderSource = `
precision mediump float;
uniform sampler2D u_tex;
uniform vec2 u_res;
uniform float u_time;
uniform vec3 u_color;
uniform float u_scanOn;
float rand(vec2 co){return fract(sin(dot(co.xy,vec2(12.9898,78.233)))*43758.5453);}
void main(){
  vec2 uv = gl_FragCoord.xy / u_res.xy;
  vec2 centered = uv * 2.0 - 1.0;
  float r2 = dot(centered, centered);
  centered *= 1.0 + 0.08 * r2;
  vec2 texUV = (centered * 0.5) + 0.5;
  texUV.y = 1.0 - texUV.y;
  float ca = 0.0015;
  vec2 caOff = (uv - 0.5);
  float r = texture2D(u_tex, texUV + caOff * ca).r;
  float g = texture2D(u_tex, texUV).g;
  float b = texture2D(u_tex, texUV - caOff * ca).b;
  vec3 txt = vec3(r,g,b);
  vec3 tinted = txt * u_color;
  float blur = (texture2D(u_tex, texUV + vec2(0.002,0.0)).r
    + texture2D(u_tex, texUV + vec2(-0.002,0.0)).r
    + texture2D(u_tex, texUV + vec2(0.0,0.002)).r
    + texture2D(u_tex, texUV + vec2(0.0,-0.002)).r) * 0.25;
  vec3 bloom = blur * u_color * 0.7;
  vec3 outc = tinted + bloom * pow(txt, vec3(1.3));
  if(u_scanOn > 0.0){
    float scan = 0.5 + 0.5*sin(gl_FragCoord.y * 0.4);
    float line = mix(0.88,1.0,scan);
    outc *= line;
  }
  vec2 pos = uv - 0.5;
  float vig = smoothstep(0.8,0.3,length(pos));
  outc *= mix(0.88,1.0,vig);
  float n = (rand(gl_FragCoord.xy * (1.0 + sin(u_time*0.27)))) * 0.05;
  outc += n;
  outc = pow(outc, vec3(0.92));
  gl_FragColor = vec4(outc,1.0);
}
`;

        this.setupWebGL();
        this.attachEvents();

        this.resize();
        this.startRenderLoop();
    }

    getElements() {
        this.text = document.querySelector('.text');
    }

    init() {
        this.crtThemes = {
            green:   {color:'#59ff59', rgb:[0.35,1.0,0.35]},
            amber:   {color:'#ffb84d', rgb:[1.0,0.72,0.3]},
            cyan:    {color:'#50d6ff', rgb:[0.32,0.84,1.0]}
        };
        this.themeOrder = ["green","amber","cyan"];
        this.currentTheme = "amber";
        this.legendText = "SCROLL: ↑/↓ | THEME: ←/→";
        this.scrollLine = 0;
        this.plainText = this.text.innerText;
        this.wrappedLines = [];
        this.visibleLineCount = 0;
        this.lineHeight = Math.round(36 * devicePixelRatio);
        this.fontSize = Math.round(18 * devicePixelRatio);
        this.font = this.fontSize + 'px monospace';
        this.needsRedraw = true;
        this.wrapWidth = 0;
        this.uiTopMargin = 32;
        this.dividerPad = 64;
        this.indicatorTopPad = 20;
        this.uiRightPadding = 40;
        this.uiButtonWidth = 130;
        this.uiButtonHeight = 42;
        this.uiButtonMargin = 10;
        this.uiFontSizePx = Math.round(16 * devicePixelRatio);
        this.xpad = 24 * devicePixelRatio;
        this.ypad = this.indicatorTopPad + this.uiButtonHeight + this.dividerPad * devicePixelRatio;
    }

    removeNoJs() {
        this.text.classList.add('sro');

        document.body.classList.remove('app');
        document.body.style.overflow = 'hidden';
    }

    wrapTextToLines(tabW) {
        this.tctx.font = this.font;

        const output = [];
        const tabStr = ' '.repeat(tabW);
        const paragraphs = this.plainText.replace(/\r/g, '').split('\n');

        for (let p = 0; p < paragraphs.length; ++p) {
            let tline = paragraphs[p].replace(/\t/g, tabStr);

            if (tline.trim() === '' && paragraphs[p].length > 0) {
                output.push('');
                continue;
            }

            let words = tline.split(/(\s+)/);
            let line = '';

            for (let n = 0; n < words.length; ++n) {
                let testLine = line + words[n];
                let width = this.tctx.measureText(testLine).width;

                if (width > this.wrapWidth && line !== '') {
                    output.push(line.replace(/\s+$/g, ''));
                    line = words[n].replace(/^\s+/g, '');
                } else {
                    line = testLine;
                }
            }

            output.push(line.replace(/\s+$/g, ''));
        }

        return output;
    }

    updateWrapAndRedraw() {
        this.wrapWidth = this.textCanvas.width - this.xpad * 2;

        if (window.innerWidth < 520) {
            this.ypad = this.indicatorTopPad + this.uiButtonHeight * 2 + this.dividerPad * devicePixelRatio;
        } else {
            this.ypad = this.indicatorTopPad + this.uiButtonHeight + this.dividerPad * devicePixelRatio;
        }

        this.wrappedLines = this.wrapTextToLines(4);
        this.visibleLineCount = Math.floor((this.textCanvas.height - this.ypad) / this.lineHeight);
        this.needsRedraw = true;
    }

    drawCanvasUI() {
        const isMobile = window.innerWidth < 520;

        this.tctx.font = `${this.uiFontSizePx}px monospace`;
        this.tctx.textBaseline = 'top';
        this.tctx.shadowColor = this.crtThemes[this.currentTheme].color;
        this.tctx.shadowBlur = 6 * devicePixelRatio;
        this.tctx.fillStyle = this.crtThemes[this.currentTheme].color;

        if(isMobile) {
            this.tctx.fillText(this.legendText, this.uiRightPadding, this.uiTopMargin);

            this.tctx.font = `bold ${this.uiFontSizePx}px monospace`;
            const totalWidth = (this.uiButtonWidth + this.uiButtonMargin) * this.themeOrder.length - this.uiButtonMargin;
            const y = this.uiTopMargin + this.uiFontSizePx + this.uiButtonMargin + 32;

            this.themeOrder.forEach((theme, i) => {
                const cx = this.uiRightPadding + i * (this.uiButtonWidth + this.uiButtonMargin);

                if (theme === this.currentTheme) {
                    this.tctx.fillStyle = this.crtThemes[theme].color;
                    this.tctx.shadowBlur = 12 * devicePixelRatio;
                    this.tctx.fillRect(cx, y, this.uiButtonWidth, this.uiButtonHeight);
                    this.tctx.shadowBlur = 0;
                }

                this.tctx.fillStyle = theme === this.currentTheme ? '#111' : this.crtThemes[theme].color;
                this.tctx.fillText(theme.toUpperCase(), cx + 14, y + 9);

                if (theme !== this.currentTheme) {
                    this.tctx.strokeStyle = this.crtThemes[theme].color;
                    this.tctx.lineWidth = 1;
                    this.tctx.strokeRect(cx, y, this.uiButtonWidth, this.uiButtonHeight);
                }
            });

            this.tctx.shadowBlur = 0;
            this.tctx.globalAlpha = 0.26;
            this.tctx.strokeStyle = this.crtThemes[this.currentTheme].color;
            this.tctx.beginPath();
            const yDiv = y + this.uiButtonHeight + this.uiButtonMargin + 24;
            this.tctx.moveTo(this.xpad, yDiv);
            this.tctx.lineTo(this.textCanvas.width - this.xpad, yDiv);
            this.tctx.lineWidth = 2.5 * devicePixelRatio;
            this.tctx.stroke();
            this.tctx.globalAlpha = 1.0;
        } else {
            this.tctx.fillText(this.legendText, this.xpad, this.uiTopMargin);

            this.tctx.font = `bold ${this.uiFontSizePx}px monospace`;
            let baseX = this.textCanvas.width - this.uiRightPadding - (this.uiButtonWidth + this.uiButtonMargin) * this.themeOrder.length;
            let y = this.indicatorTopPad;

            this.themeOrder.forEach((theme, i) => {
                const cx = baseX + i * (this.uiButtonWidth + this.uiButtonMargin);

                if (theme === this.currentTheme) {
                    this.tctx.fillStyle = this.crtThemes[theme].color;
                    this.tctx.shadowBlur = 12 * devicePixelRatio;
                    this.tctx.fillRect(cx, y, this.uiButtonWidth, this.uiButtonHeight);
                    this.tctx.shadowBlur = 0;
                }

                this.tctx.fillStyle = theme === this.currentTheme ? '#111' : this.crtThemes[theme].color;
                this.tctx.fillText(theme.toUpperCase(), cx + 14, y + 9);

                if (theme !== this.currentTheme) {
                    this.tctx.strokeStyle = this.crtThemes[theme].color;
                    this.tctx.lineWidth = 1;
                    this.tctx.strokeRect(cx, y, this.uiButtonWidth, this.uiButtonHeight);
                }
            });

            this.tctx.shadowBlur = 0;
            this.tctx.globalAlpha = 0.26;
            this.tctx.strokeStyle = this.crtThemes[this.currentTheme].color;
            this.tctx.beginPath();
            this.tctx.moveTo(this.xpad, this.indicatorTopPad + this.uiButtonHeight + this.dividerPad / 2);
            this.tctx.lineTo(this.textCanvas.width - this.xpad, this.indicatorTopPad + this.uiButtonHeight + this.dividerPad / 2);
            this.tctx.lineWidth = 2.5 * devicePixelRatio;
            this.tctx.stroke();
            this.tctx.globalAlpha = 1.0;
        }
    }

    render() {
        if (!this.needsRedraw) return;

        this.tctx.clearRect(0, 0, this.textCanvas.width, this.textCanvas.height);
        this.tctx.fillStyle = '#191000';
        this.tctx.fillRect(0, 0, this.textCanvas.width, this.textCanvas.height);

        this.drawCanvasUI();

        this.tctx.font = this.font;
        this.tctx.shadowColor = this.crtThemes[this.currentTheme].color;
        this.tctx.shadowBlur = 8 * devicePixelRatio;
        this.tctx.fillStyle = this.crtThemes[this.currentTheme].color;
        this.tctx.textBaseline = 'top';

        let y = this.ypad;
        let maxScroll = this.wrappedLines.length - this.visibleLineCount;

        if (maxScroll < 0) maxScroll = 0;
        
        this.scrollLine = Math.min(maxScroll, this.scrollLine);

        for (let i = 0; i < this.visibleLineCount; ++i) {
            let idx = this.scrollLine + i;
            let line = '';

            if (idx >= 0 && idx < this.wrappedLines.length) {
                line = this.wrappedLines[idx];
            }

            this.tctx.fillText(line, this.xpad, y);
            y += this.lineHeight;
        }

        this.gl.bindTexture(this.gl.TEXTURE_2D, this.tex);
        this.gl.texImage2D(this.gl.TEXTURE_2D, 0, this.gl.RGBA, this.gl.RGBA, this.gl.UNSIGNED_BYTE, this.textCanvas);

        this.needsRedraw = false;
    }

    resize() {
        this.canvas.width = Math.floor(window.innerWidth * devicePixelRatio);
        this.canvas.height = Math.floor(window.innerHeight * devicePixelRatio);
        this.textCanvas.width = this.canvas.width;
        this.textCanvas.height = this.canvas.height;

        this.updateWrapAndRedraw();
        this.needsRedraw = true; 
    }

    clampScroll(n) {
        let maxScroll = this.wrappedLines.length - this.visibleLineCount;

        if (maxScroll < 0) maxScroll = 0;

        return Math.max(0, Math.min(maxScroll, n));
    }

    attachEvents() {
        window.addEventListener('resize', () => this.resize());

        window.addEventListener('keydown', e => {
            if (e.key === 'ArrowDown') {
                e.preventDefault();

                this.scrollLine = this.clampScroll(this.scrollLine + 1);
                this.needsRedraw = true; 
            }
            else if (e.key === 'ArrowUp') {
                e.preventDefault();

                this.scrollLine = this.clampScroll(this.scrollLine - 1);
                this.needsRedraw = true; 
            }
            else if (e.key === 'ArrowLeft') {
                e.preventDefault();

                let idx = this.themeOrder.indexOf(this.currentTheme);

                this.currentTheme = this.themeOrder[(idx + this.themeOrder.length - 1) % this.themeOrder.length];
                this.needsRedraw = true; 
            }
            else if (e.key === 'ArrowRight') {
                e.preventDefault();

                let idx = this.themeOrder.indexOf(this.currentTheme);

                this.currentTheme = this.themeOrder[(idx + 1) % this.themeOrder.length];
                this.needsRedraw = true;
            }
        });

        this.canvas.addEventListener('wheel', e => {
            e.preventDefault();
            this.wheelAccumulator = this.wheelAccumulator ?? 0;
            this.wheelAccumulator += (e.deltaY > 0 ? 1 : -1);

            if (Math.abs(this.wheelAccumulator) >= 6) {
                const direction = this.wheelAccumulator > 0 ? 1 : -1;
                this.scrollLine = this.clampScroll(this.scrollLine + direction);
                this.needsRedraw = true;
                this.wheelAccumulator = 0;
            }
        });

        this.attachTouchEvents();
    }

    attachTouchEvents() {
        let touchStartX = null;
        let touchStartY = null;
        let lastTouchY = null;
        let verticalAccum = 0;

        this.canvas.addEventListener('touchstart', e => {
            if (e.touches.length === 1) {
                const touch = e.touches[0];

                touchStartX = touch.clientX;
                touchStartY = touch.clientY;
                lastTouchY = touch.clientY;
                verticalAccum = 0;
            }
        }, { passive: true });

        this.canvas.addEventListener('touchmove', e => {
            if (e.touches.length !== 1 || lastTouchY === null) return;

            e.preventDefault();

            const currentY = e.touches[0].clientY;
            const deltaY = lastTouchY - currentY;
            const scrollSensitivity = 0.02; 

            verticalAccum += deltaY * scrollSensitivity;

            const linesToScroll = Math.trunc(verticalAccum);

            if (linesToScroll !== 0) {
                verticalAccum -= linesToScroll;

                this.scrollLine = this.clampScroll(this.scrollLine + linesToScroll);
                this.needsRedraw = true;
            }

            lastTouchY = currentY;
        }, { passive: false });

        this.canvas.addEventListener('touchend', e => {
            if (touchStartX === null || touchStartY === null) return;

            const touch = e.changedTouches[0];
            const dx = touch.clientX - touchStartX;
            const dy = touch.clientY - touchStartY;
            const absDx = Math.abs(dx);
            const absDy = Math.abs(dy);
            const swipeThreshold = 40;

            if (absDx > absDy && absDx > swipeThreshold) {
                if(dx > 0){
                    let idx = this.themeOrder.indexOf(this.currentTheme);

                    this.currentTheme = this.themeOrder[(idx + this.themeOrder.length - 1) % this.themeOrder.length];
                    this.needsRedraw = true;
                } else {
                    let idx = this.themeOrder.indexOf(this.currentTheme);

                    this.currentTheme = this.themeOrder[(idx + 1) % this.themeOrder.length];
                    this.needsRedraw = true;
                }
            }

            touchStartX = null;
            touchStartY = null;
            lastTouchY = null;
            verticalAccum = 0;
        }, { passive: true });

        this.canvas.addEventListener('touchcancel', e => {
            touchStartX = null;
            touchStartY = null;
            lastTouchY = null;
            verticalAccum = 0;
        }, { passive: true });
    }

    setupWebGL() {
        const vsSource = `attribute vec2 a_pos;void main(){gl_Position=vec4(a_pos,0,1);}`;

        const compileShader = (src, type) => {
            const s = this.gl.createShader(type);

            this.gl.shaderSource(s, src);
            this.gl.compileShader(s);

            if (!this.gl.getShaderParameter(s, this.gl.COMPILE_STATUS)) {
                console.error(this.gl.getShaderInfoLog(s));
            }

            return s;
        };

        const vs = compileShader(vsSource, this.gl.VERTEX_SHADER);
        const fs = compileShader(this.fragShaderSource, this.gl.FRAGMENT_SHADER);
        this.prog = this.gl.createProgram();

        this.gl.attachShader(this.prog, vs);
        this.gl.attachShader(this.prog, fs);
        this.gl.linkProgram(this.prog);

        if (!this.gl.getProgramParameter(this.prog, this.gl.LINK_STATUS)) {
            console.error(this.gl.getProgramInfoLog(this.prog));
        }

        this.a_pos = this.gl.getAttribLocation(this.prog, 'a_pos');
        this.u_tex = this.gl.getUniformLocation(this.prog, 'u_tex');
        this.u_res = this.gl.getUniformLocation(this.prog, 'u_res');
        this.u_time = this.gl.getUniformLocation(this.prog, 'u_time');
        this.u_color = this.gl.getUniformLocation(this.prog, 'u_color');
        this.u_scanOn = this.gl.getUniformLocation(this.prog, 'u_scanOn');

        this.quad = this.gl.createBuffer();

        this.gl.bindBuffer(this.gl.ARRAY_BUFFER, this.quad);
        this.gl.bufferData(this.gl.ARRAY_BUFFER, new Float32Array([-1, -1, 1, -1, -1, 1, -1, 1, 1, -1, 1, 1]), this.gl.STATIC_DRAW);

        this.tex = this.gl.createTexture();
        this.gl.bindTexture(this.gl.TEXTURE_2D, this.tex);
        this.gl.texParameteri(this.gl.TEXTURE_2D, this.gl.TEXTURE_WRAP_S, this.gl.CLAMP_TO_EDGE);
        this.gl.texParameteri(this.gl.TEXTURE_2D, this.gl.TEXTURE_WRAP_T, this.gl.CLAMP_TO_EDGE);
        this.gl.texParameteri(this.gl.TEXTURE_2D, this.gl.TEXTURE_MIN_FILTER, this.gl.LINEAR);
        this.gl.texParameteri(this.gl.TEXTURE_2D, this.gl.TEXTURE_MAG_FILTER, this.gl.LINEAR);
    }

    startRenderLoop() {
        let start = performance.now(), last = start;

        const frame = (now) => {
            this.render();

            last = now;

            this.gl.viewport(0, 0, this.canvas.width, this.canvas.height);
            this.gl.clearColor(0, 0, 0, 1);
            this.gl.clear(this.gl.COLOR_BUFFER_BIT);
            this.gl.useProgram(this.prog);
            this.gl.bindBuffer(this.gl.ARRAY_BUFFER, this.quad);
            this.gl.enableVertexAttribArray(this.a_pos);
            this.gl.vertexAttribPointer(this.a_pos, 2, this.gl.FLOAT, false, 0, 0);
            this.gl.uniform1i(this.u_tex, 0);
            this.gl.uniform2f(this.u_res, this.canvas.width, this.canvas.height);
            this.gl.uniform1f(this.u_time, (now - start) / 1000.0);
            let c = this.crtThemes[this.currentTheme].rgb;
            this.gl.uniform3f(this.u_color, c[0], c[1], c[2]);
            this.gl.uniform1f(this.u_scanOn, 1.0);
            this.gl.activeTexture(this.gl.TEXTURE0);
            this.gl.bindTexture(this.gl.TEXTURE_2D, this.tex);
            this.gl.drawArrays(this.gl.TRIANGLES, 0, 6);

            requestAnimationFrame(frame);
        };

        requestAnimationFrame(frame);
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new Journal(document.getElementById("glCanvas"));
});
