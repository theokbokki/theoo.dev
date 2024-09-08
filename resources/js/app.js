import './bootstrap';
import Wysiwyg from './parts/wysiwyg';

class App {
    constructor() {
         document.querySelectorAll('.wysiwyg').forEach(el => new Wysiwyg(el));
    }
}

addEventListener('load', () => new App());
