import PostPage from "./pages/PostPage";

export default class TransitionEngine {
    constructor() {
        this.setDefaults();
        this.init();
        this.handlePopstate();
        this.getPage(document.body);
    }

    setDefaults() {
        if (history.scrollRestoration) {
            history.scrollRestoration = "manual";
        }

        this.isPopstate = false;
        this.lastPopstateTime = 0;
        this.transitionDelay = 400;
    }

    init() {
        window.app.controller.abort();
        window.app.controller = new AbortController();

        this.getElements();
        this.setEvents();

        document.body.classList.remove("hidden");
    }

    getElements() {
        this.transitionLinks = document.querySelectorAll("[data-transition=true]");
    }

    setEvents() {
        this.transitionLinks.forEach((link) => {
            link.addEventListener(
                "click",
                async (e) => {
                    e.preventDefault();

                    window.sessionStorage.setItem(window.location.href, window.scrollY);

                    this.lastPopstateTime = Date.now();
                    this.handleHistory(e.target.href ?? e.currentTarget.href);
                    const newPage = await this.fetchNewPage(e.target.href ?? e.currentTarget.href);

                    this.transitionPage(newPage);
                },
                { signal: window.app.controller.signal },
            );
        });
    }

    getPage(el) {
        switch (el.dataset.page) {
            case "project":
            case "article":
                return new PostPage(el);
        }
    }

    handlePopstate() {
        window.addEventListener("popstate", async () => {
            const currentTime = Date.now();
            const timeSinceLastPopstate = currentTime - this.lastPopstateTime;

            if (timeSinceLastPopstate < 1000) {
                window.location.reload();
                return;
            }

            this.lastPopstateTime = currentTime;
            this.isPopstate = true;

            window.sessionStorage.setItem(this.previousPage, window.scrollY);
            this.handleHistory(window.location.href);

            const newPage = await this.fetchNewPage(window.location.href);
            this.transitionPage(newPage);
        });
    }

    async fetchNewPage(href) {
        const response = await axios.get(href);
        const parser = new DOMParser();

        return parser.parseFromString(response.data.html, "text/html");
    }

    async transitionPage(newPage) {
        document.body.classList.add("hidden");

        await this.waitFor(this.transitionDelay);

        this.replaceHead(newPage);

        requestAnimationFrame(() => {
            this.replaceBody(newPage);

            this.handleScrollPosition();

            this.isPopstate = false;

            requestAnimationFrame(() => {
                this.init();
            });
        });
    }

    handleHistory(href) {
        if (!this.isPopstate) {
            history.pushState(null, null, href.substring(href.indexOf("/")));
        }

        this.previousPage = window.location.href;
    }

    async waitFor(delay) {
        return new Promise((resolve) => setTimeout(resolve, delay));
    }

    replaceHead(newPage) {
        const oldStylesheets = Array.from(document.head.querySelectorAll("link[rel='stylesheet']"));
        const oldScripts = Array.from(document.head.querySelectorAll("script"));

        const newHead = newPage.querySelector("head");
        // Remove all from the head but keep old scripts and styles to avoid flickering
        Array.from(document.head.children).forEach((child) => {
            if (!oldStylesheets.includes(child) && !oldScripts.includes(child)) {
                child.remove();
            }
        });

        Array.from(newHead.children).forEach((child) => {
            document.head.appendChild(child.cloneNode(true));
        });
    }

    replaceBody(newPage) {
        const newBody = newPage.querySelector("body");
        document.body.innerHTML = newBody.innerHTML;
        document.body.dataset.page = newBody.dataset.page;

        this.getPage(document.body);
    }

    handleScrollPosition() {
        let scrollAmount = 0;
        if (this.isPopstate) {
            scrollAmount = window.sessionStorage.getItem(window.location.href);
        }

        window.scrollTo(0, scrollAmount);
    }
}
