import './bootstrap';
import Wysiwyg from './parts/wysiwyg';

class App {
    constructor() {
         document.querySelectorAll('.wysiwyg').forEach(el => new Wysiwyg(el));

        this.loadPage();
    }

    loadPage() {
        document.querySelectorAll('body > *').forEach((el, index) => {
            el.style = `--index: ${index + 1}`;

            el.classList.add("load");
        });

        document.querySelectorAll(`a[href*="${location.hostname}"]:not([href*="mailto:"]):not([target="_blank"])`).forEach((el) => {
            el.addEventListener('click', (e) => {
                e.preventDefault();

                document.body.style.opacity = 0;

                const href = e.currentTarget.href;

                setTimeout((href) => {
                    window.location = href;
                }, 200, href);
            });
        });
    }
}

addEventListener('load', () => new App());
