class Slider {
    constructor(selector, interval = 3500) {
        this.slides = document.querySelectorAll(selector);
        this.index = 0;
        this.interval = interval;

        if (this.slides.length === 0) return;

        this.slides[0].classList.add("active");
        this.start();
    }

    next() {
        this.slides[this.index].classList.remove("active");
        this.index = (this.index + 1) % this.slides.length;
        this.slides[this.index].classList.add("active");
    }

    start() {
        this.timer = setInterval(() => this.next(), this.interval);
    }
}

new Slider(".slide", 3500);