import { jsxs, Fragment, jsx } from "react/jsx-runtime";
import { Head, createInertiaApp } from "@inertiajs/react";
import createServer from "@inertiajs/react/server";
import ReactDOMServer from "react-dom/server";
function App() {
  return /* @__PURE__ */ jsxs(Fragment, { children: [
    /* @__PURE__ */ jsx(Head, { title: "Théoo's wizard lair" }),
    /* @__PURE__ */ jsx("h1", { className: "text-red-600", children: "Théoo's wizard lair" }),
    /* @__PURE__ */ jsx("main", { className: "" })
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
