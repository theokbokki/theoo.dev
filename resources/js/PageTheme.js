export default class PageTheme {
    constructor(el) {
        this.el = el;

        this.getElements();
        this.setEvents();
        this.init();
    }

    getElements() {
        this.toggles = this.el.querySelectorAll(".page__toggle");
    }

    setEvents() {
        this.toggles.forEach((toggle) => {
            toggle.addEventListener('click', this.onClick.bind(this));
        });
    }

    init() {
        this.hues = {
            'amber': 19,
            'green': 120,
            'cyan': 180,
            'magenta': 320,
        };

        this.el.style.display = "flex";
        this.el.querySelector(`[data-theme=${localStorage.getItem("garden-theme") ?? 'amber'}]`).click();
    }

    onClick(e) {
        const theme = e.target.dataset.theme;

        document.documentElement.style.setProperty('--hue', this.hues[theme]);
        localStorage.setItem("garden-theme", theme);

        const activeToggle = this.el.querySelector("[data-active=true]");

        if (activeToggle) {
            activeToggle.dataset.active = false;
        }

        e.target.dataset.active = true;
    }
}
