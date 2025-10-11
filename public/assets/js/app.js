import ThemePicker from './ThemePicker.js';

class App {
    constructor(el) {
        this.el = el;
        
        this.makeThemePicker();
    }

    makeThemePicker() {
        this.themeForm = this.el.querySelector('.app__theme');

        new ThemePicker(this.themeForm);
    }
}

window.addEventListener('DOMContentLoaded', () => {
    const el = document.querySelector('.app');

    new App(el);
});
