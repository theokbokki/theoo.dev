export default class Life {
    constructor(el) {
        this.el = el;
        this.getElements();
        this.setEvents();
    }

    getElements() {
        this.content = this.el.querySelector('#content');
        this.token = this.el.querySelector('[name=_token]');
    }

    setEvents() {
        this.el.addEventListener('submit', (e) => this.onSubmit(e));
        this.content.addEventListener('input', this.debounce(() => this.el.requestSubmit()));
    }

    async onSubmit(e) {
        e.preventDefault();
        try {
            await fetch(this.el.action, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': this.token.value,
                },
                body: JSON.stringify({ content: this.content.value }),
            });
        } catch (error) {
            console.log(error);
        }
    }

    debounce(closure, timeout = 300) {
        let timer;
        
        return (...args) => {
            clearTimeout(timer);
            timer = setTimeout(() => closure.apply(this, args), timeout);
        };
    }
}
