export default class Page {
    constructor(el) {
        this.el = el;

        this.getElements();
        this.init();
        this.setEvents();
    }

    init() {
        this.count = 6;
        this.focused = new Set();
        this.content.classList.add('page__content--focus');
        this.onScroll();
    }

    getElements() {
        this.root = document.documentElement;
        this.content = this.el.querySelector('.page__content');
        this.blocks = [...this.content.querySelectorAll('p, h1, h2, h3, h4, h5, h6, li, blockquote, tr, dt, dd, figcaption')]
            .filter((block) => !block.closest('pre') && block.textContent.trim() !== '');
    }

    setEvents() {
        window.addEventListener('scroll', this.throttle(() => this.onScroll()), { passive: true });

        window.addEventListener('resize', this.throttle(() => this.onScroll()));

        document.fonts.ready.then(() => this.onScroll());
    }

    onScroll() {
        const middle = window.innerHeight / 2;
        const isTop = window.scrollY <= 1;
        const isBottom = window.innerHeight + window.scrollY >= this.root.scrollHeight - 2;

        const ranked = this.blocks
            .map((block, index) => ({ block, index, ...this.getDistance(block, middle) }))
            .sort((a, b) => a.distance - b.distance || a.height - b.height);

        const focused = new Set(ranked.slice(0, this.count).map(({ block }) => block));
        const center = ranked[0]?.index ?? 0;

        this.blocks.forEach((block, index) => {
            if ((isTop && index <= center) || (isBottom && index >= center)) focused.add(block);
        });

        this.focused.forEach((block) => block.classList.toggle('is-focused', focused.has(block)));
        focused.forEach((block) => block.classList.add('is-focused'));
        this.focused = focused;
    }

    getDistance(block, middle) {
        const { top, bottom, height } = block.getBoundingClientRect();
        const distance = middle < top ? top - middle : middle > bottom ? middle - bottom : 0;

        return { distance, height };
    }

    throttle(closure) {
        let frame;

        return (...args) => {
            if (frame) return;

            frame = requestAnimationFrame(() => {
                frame = null;
                closure.apply(this, args);
            });
        };
    }
}
