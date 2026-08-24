export default class PageTransition {
    constructor() {
        this.duration = 150;

        document.addEventListener("click", this.onClick.bind(this));

        window.addEventListener("pageshow", () => {
            document.body.classList.remove("js-leaving");
        });
    }

    onClick(e) {
        if (e.button !== 0 || e.metaKey || e.ctrlKey || e.shiftKey || e.altKey) return;

        const link = e.target.closest("a");

        if (!link) return;
        if (link.target && link.target !== "_self") return;
        if (link.hasAttribute("download")) return;
        if (!link.getAttribute("href")) return;

        const url = new URL(link.href, location.href);
        if (url.origin !== location.origin) return;

        if (url.pathname === location.pathname && (url.hash || url.href === location.href)) return;

        e.preventDefault();
        this.leave(url.href);
    }

    leave(href) {
        document.body.classList.add("js-leaving");

        let done = false;
        const go = () => {
            if (done) return;
            done = true;
            window.location.href = href;
        };

        document.body.addEventListener(
            "transitionend",
            (e) => { if (e.propertyName === "opacity") go(); },
            { once: true }
        );

        setTimeout(go, this.duration + 50);
    }
}
