window.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll(".js").forEach(el => el.classList.remove("js"));
    document.querySelectorAll(".no-js").forEach(el => el.style.display = "none");

    window.requestAnimationFrame(() => {
        document.body.classList.remove("js-loading");
    });
});
