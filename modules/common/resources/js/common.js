import FocusRing from "./FocusRing";
import Nav from "./Nav";

window.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".js").forEach(el => el.classList.remove("js"));
    document.querySelectorAll(".no-js").forEach(el => el.style.display = "none");

    new FocusRing();
    new Nav();

    window.requestAnimationFrame(() => {
        document.body.classList.remove('js-loading');
    });
});
