import Tooltip from "./Tooltip";

export default class Nav {
    constructor() {
        this.el = document.querySelector('.nav');

        this.getEls();
        this.setEvents();
    }

    getEls() {
        this.button = this.el.querySelector('.nav__button');
        this.tooltipEl = this.el.querySelector('.nav__tooltip');
        this.tooltip = new Tooltip(
            this.tooltipEl,
            this.button,
            {width: "240px"}
        );
    }

    setEvents() {
        this.button.addEventListener("click", this.onClick.bind(this));
    }

    onClick() {
        this.tooltip.toggle();
    }
}
