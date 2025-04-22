<a href="https://github.com/whitecube/pluton/tree/vite" target="_blank">Pluton</a> is a JavaScript library built at <a href="https://whitecube.be" target="_blank">Whitecube</a> that allows you to link JS classes to CSS classes.

```js
export default class Example {
    static selector = ".example";

    constructor(el) {
        this.el = el;

        this.getElements();
        this.setEvents();
    }

    getElements() {}

    setEvents() {}
}
```
