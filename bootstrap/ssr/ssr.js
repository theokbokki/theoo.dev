import { jsx, Fragment, jsxs } from "react/jsx-runtime";
import { Head, createInertiaApp } from "@inertiajs/react";
import { motion } from "motion/react";
import { Canvas, useFrame } from "@react-three/fiber";
import { Text } from "@react-three/drei";
import { useRef, useMemo } from "react";
import * as THREE from "three";
import createServer from "@inertiajs/react/server";
import ReactDOMServer from "react-dom/server";
const miffySticker = "/build/assets/miffy-sticker-7FT-eDLA.png";
const f1Sticker = "/build/assets/f1-sticker-dzcukJ37.png";
const tsukiSticker = "/build/assets/tsuki-sticker-D9IcgLOi.png";
const matchaSticker = "/build/assets/matcha-sticker-EBHShiXi.png";
const ankySticker = "/build/assets/anky-sticker-TfT6ROqz.png";
const logoSticker = "/build/assets/logo-sticker-BvhPhmij.png";
function App$1({ src, alt, width = 80 }) {
  return /* @__PURE__ */ jsx(Fragment, { children: /* @__PURE__ */ jsx(
    motion.img,
    {
      drag: true,
      style: {
        scale: 0.7
      },
      whileDrag: {
        scale: 0.8,
        rotateX: "10deg",
        filter: "drop-shadow(0 5px 2px rgba(0, 0, 0, 0.2))",
        zIndex: 99
      },
      dragMomentum: false,
      src,
      alt,
      className: "absolute cursor-grab active:cursor-grabbing drop-shadow-[0_1.5px_0.5px_rgba(0,0,0,0.3)]"
    }
  ) });
}
const picnic = "/build/assets/PicNic-Regular-woBZUxHO.woff";
var hero_text_default$1 = "uniform float u_time;\nuniform vec3 u_lightPos;\nuniform vec3 u_color;\n\nvarying vec2 vUv;\nvarying vec3 vNormal;\nvarying vec3 vViewDir;\n\nvoid main() {\n    \n    vec3 normal = normalize(vNormal);\n    vec3 lightDir = normalize(u_lightPos - vViewDir);\n\n    \n    float fresnel = pow(1.0 - dot(vViewDir, normal), 3.0);\n\n    \n    vec3 halfVector = normalize(lightDir + vViewDir);\n    float specular = pow(max(dot(normal, halfVector), 0.0), 64.0);\n\n    \n    float reflection = abs(sin(vUv.x * 10.0 + u_time * 2.0));\n\n    \n    vec3 metalColor = u_color + specular * 0.6 + reflection * 0.4 + fresnel * 0.8;\n\n    gl_FragColor = vec4(metalColor, 1.0);\n}";
var hero_text_default = "varying vec2 vUv;\nvarying vec3 vNormal;\nvarying vec3 vViewDir;\n\nvoid main() {\n    vUv = uv;\n    vNormal = normalize(normalMatrix * normal); \n    vViewDir = normalize(cameraPosition - vec3(modelViewMatrix * vec4(position, 1.0)));\n\n    gl_Position = projectionMatrix * modelViewMatrix * vec4(position, 1.0);\n}";
function TextShader() {
  const materialRef = useRef();
  const uniforms = useMemo(
    () => ({
      u_time: { value: 0 },
      u_lightPos: { value: new THREE.Vector3(5, 5, 5) },
      // Simulated light source
      u_color: { value: new THREE.Color(1, 0.8, 0.5) }
      // Gold-ish color
    }),
    []
  );
  useFrame((state) => {
    if (materialRef.current) {
      materialRef.current.uniforms.u_time.value = state.clock.getElapsedTime();
    }
  });
  return /* @__PURE__ */ jsxs("mesh", { children: [
    /* @__PURE__ */ jsx(Text, { font: picnic, fontSize: 1.6, maxWidth: 12, textAlign: "center", children: "Welcome to Théoo's wizard lair" }),
    /* @__PURE__ */ jsx(
      "shaderMaterial",
      {
        ref: materialRef,
        fragmentShader: hero_text_default$1,
        vertexShader: hero_text_default,
        uniforms
      }
    )
  ] });
}
function HeroText() {
  return /* @__PURE__ */ jsx("div", { id: "hero-text-container", className: "h-63", children: /* @__PURE__ */ jsx(Canvas, { camera: { position: [0, 0, 5] }, children: /* @__PURE__ */ jsx(TextShader, {}) }) });
}
function App() {
  return /* @__PURE__ */ jsxs(Fragment, { children: [
    /* @__PURE__ */ jsx(Head, { title: "Théoo's wizard lair" }),
    /* @__PURE__ */ jsx(HeroText, {}),
    /* @__PURE__ */ jsxs("main", { className: "relative flex items-center justify-center", children: [
      /* @__PURE__ */ jsx(App$1, { src: miffySticker, alt: "A sticker of miffy riding a scooter." }),
      /* @__PURE__ */ jsx(App$1, { src: f1Sticker, alt: "A sticker of a ferrari formula one car." }),
      /* @__PURE__ */ jsx(App$1, { src: tsukiSticker, alt: "A sticker of Tsuki, my tuxedo cat." }),
      /* @__PURE__ */ jsx(App$1, { src: matchaSticker, alt: "A sticker of Matcha, my small tabby cat sleeping." }),
      /* @__PURE__ */ jsx(
        App$1,
        {
          src: logoSticker,
          alt: "A sticker of my logo. 2 cartoon eyes representing the two Os of Théoo"
        }
      ),
      /* @__PURE__ */ jsx(App$1, { src: ankySticker, alt: "A sticker of an Ankylosaurus." })
    ] })
  ] });
}
const __vite_glob_0_0 = /* @__PURE__ */ Object.freeze(/* @__PURE__ */ Object.defineProperty({
  __proto__: null,
  default: App
}, Symbol.toStringTag, { value: "Module" }));
createServer(
  (page) => createInertiaApp({
    page,
    render: ReactDOMServer.renderToString,
    resolve: (name) => {
      const pages = /* @__PURE__ */ Object.assign({ "./Pages/App.jsx": __vite_glob_0_0 });
      return pages[`./Pages/${name}.jsx`];
    },
    setup: ({ App: App2, props }) => /* @__PURE__ */ jsx(App2, { ...props })
  })
);
