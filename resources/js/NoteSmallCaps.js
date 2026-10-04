export default class NoteSmallCaps {
    constructor(el) {
        this.el = el;
        this.firstP = this.el.querySelector('p');
        this.content = this.firstP.textContent;

        this.firstLetter = this.content.charAt(0);

        let end = 20;
        while (end < this.content.length && this.content[end] !== ' ') {
            end++;
        }

        this.smallCapsChars = this.content.substring(1, end);
        this.restOfP = this.content.substring(end);

        this.firstP.innerHTML = `${this.firstLetter}<span class="note__smallcaps">${this.smallCapsChars}</span>${this.restOfP}`;
    }
}
