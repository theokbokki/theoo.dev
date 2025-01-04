export default class Wysiwyg {
    constructor(el) {
        this.el = el;

        this.getElements();
        this.addCopyButtons();
    }

    getElements() {
        this.blocks = this.el.querySelectorAll("pre[data-lang]");
    }

    addCopyButtons() {
        this.blocks.forEach((block) => {
            if (!navigator.clipboard) {
                console.log("clipboard api not supported");
                return;
            }

            let wrapper = document.createElement("div");
            wrapper.classList.add("wysiwyg__code");
            block.parentNode.insertBefore(wrapper, block);

            wrapper.appendChild(block);

            let button = document.createElement("button");
            button.type = "button";
            button.classList.add("wysiwyg__copy");
            button.innerHTML = `<span class="sro">Copy code to clipboard</span>`;

            wrapper.appendChild(button);

            button.addEventListener(
                "click",
                async () => {
                    await this.copyCode(block);
                },
                { signal: window.app.controller.signal },
            );
        });
    }

    async copyCode(block) {
        let copiedCode = block.cloneNode(true);
        const html = copiedCode.outerHTML.replace(/<[^>]*>?/gm, "");

        block.parentNode.querySelector("button.wysiwyg__copy").classList.add("wysiwyg__copy--copied");
        setTimeout(function () {
            block.parentNode.querySelector("button.wysiwyg__copy").classList.remove("wysiwyg__copy--copied");
        }, 750);

        const parsedHTML = this.htmlDecode(html);

        await navigator.clipboard.writeText(parsedHTML);
    }

    htmlDecode(html) {
        const doc = new DOMParser().parseFromString(html, "text/html");
        return doc.documentElement.textContent;
    }
}
