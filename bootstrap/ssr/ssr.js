import { jsx, Fragment, jsxs } from "react/jsx-runtime";
import { Head, createInertiaApp } from "@inertiajs/react";
import { motion } from "motion/react";
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
      whilePress: {
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
function App() {
  return /* @__PURE__ */ jsxs(Fragment, { children: [
    /* @__PURE__ */ jsx(Head, { title: "Théoo's wizard lair" }),
    /* @__PURE__ */ jsx("h1", { className: "sr-only", children: "Théoo's wizard lair" }),
    /* @__PURE__ */ jsxs("main", { className: "m-auto flex items-center justify-center relative w-175 h-175 my-80 rounded-2xl overflow-hidden", children: [
      /* @__PURE__ */ jsx("figure", { className: "absolute inset-0", children: /* @__PURE__ */ jsx("img", { src: "https://eclecticlight.co/wp-content/uploads/2019/09/sisleycanalloing.jpg", alt: "", class: "w-full h-full object-cover" }) }),
      /* @__PURE__ */ jsxs("div", { class: "w-135 h-135 rounded-xl bg-white/60 backdrop-blur-sm shadow-lg shadow-neutral-800/50", children: [
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
