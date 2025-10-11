export default class ThemePicker {
    constructor(el) {
        this.el = el;

        this.getElements();
        this.init();
        this.setEvents();
    }

    getElements() {
        this.checkboxes = this.el.querySelectorAll('.app__checkbox');
    }

    init() {
        this.colors = {
            red: false,
            orange: false,
            yellow: false,
            green: false,
            blue: false,
            purple: false,
            pink: false,
        };

        const savedColors = localStorage.getItem('colors');

        if (savedColors) {
            this.localStorageColors = JSON.parse(savedColors);

            this.colors = { ...this.colors, ...this.localStorageColors };
        }

        this.checkboxes.forEach(checkbox => {
            checkbox.checked = !!this.colors[checkbox.value];
        });

        const randomColor = this.getRandomColor();

        if (randomColor) {
            document.body.classList.add(`app--${randomColor}`);
        }
    }

    setEvents() {
        this.checkboxes.forEach(checkbox => {
            checkbox.addEventListener('input', (e) => {
                const checkbox = e.target;

                if (this.colors[checkbox.value] === undefined) return;

                this.colors[checkbox.value] = checkbox.checked;

                localStorage.setItem('colors', JSON.stringify(this.colors));
            });
        });
    }

    getRandomColor() {
        const activeColors = Object.keys(this.colors).filter(color => this.colors[color]);
        const availableColors = activeColors.length ? activeColors : Object.keys(this.colors);

        return availableColors[Math.floor(Math.random() * availableColors.length)];
    }
}
