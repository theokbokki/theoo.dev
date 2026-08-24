import FocusRing from "./FocusRing";
import Nav from "./Nav";
import PageTransition from "./PageTransition";

window.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".js").forEach(el => el.classList.remove("js"));
    document.querySelectorAll(".no-js").forEach(el => el.style.display = "none");

    new FocusRing();
    new Nav();
    new PageTransition();

    window.requestAnimationFrame(() => {
        document.body.classList.remove("js-loading");
    });
});
