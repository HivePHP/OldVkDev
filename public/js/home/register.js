class RegistrationForm {
    constructor() {
        this.steps = [
            document.getElementById("step-one"),
            document.getElementById("step-two"),
            document.getElementById("step-three"),
            document.getElementById("step-five")
        ];

        this.currentStep = 0;

        this.btnNext = document.querySelector(".btn-primary-reg");
        this.btnBack = this.createBackButton();

        this.initBirthdate();
        this.initEvents();
        this.updateUI();
        this.initPasswordStrength();
    }

    initPasswordStrength() {
        const pass = document.querySelector('[name="password1"]');

        const wrapper = document.querySelector(".password-strength");
        const bar = document.querySelector(".strength-bar");
        const txt = document.querySelector(".strength-text");

        pass.addEventListener("input", () => {
            const val = pass.value.trim();

            // скрываем если пусто
            if (val.length === 0) {
                wrapper.style.display = "none";
                bar.style.width = "0%";
                txt.textContent = "Сложность: нет";
                return;
            }

            wrapper.style.display = "block";

            let score = 0;

            if (val.length >= 1) score++;
            if (val.length >= 10) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++; // спецсимволы

            let percent = (score / 5) * 100;
            bar.style.width = percent + "%";

            if (score <= 1) {
                bar.style.background = "linear-gradient(90deg, #ff3b30, #ff6a4d)";
                txt.textContent = "Сложность: очень слабый";
            }
            else if (score === 2) {
                bar.style.background = "linear-gradient(90deg, #ff9500, #ffb84d)";
                txt.textContent = "Сложность: слабый";
            }
            else if (score === 3) {
                bar.style.background = "linear-gradient(90deg, #ffd60a, #ffe666)";
                txt.textContent = "Сложность: средний";
            }
            else if (score === 4) {
                bar.style.background = "linear-gradient(90deg, #34c759, #66d985)";
                txt.textContent = "Сложность: хороший";
            }
            else {
                bar.style.background = "linear-gradient(90deg, #0aaf5c, #4ee58a)";
                txt.textContent = "Сложность: отличный";
            }
        });
    }

    updateProgress() {
        const fill = document.getElementById("progressFill");
        const percent = ((this.currentStep + 1) / this.steps.length) * 100;
        fill.style.width = percent + "%";
    }

    createBackButton() {
        let btn = document.createElement("button");
        btn.textContent = "Назад";
        btn.classList.add("btn-back");
        btn.style.display = "none";

        document.querySelector(".reg-card").prepend(btn);
        return btn;
    }

    initEvents() {
        this.btnNext.addEventListener("click", () => this.next());
        this.btnBack.addEventListener("click", () => this.prev());

        // убрать ошибку при вводе
        document.querySelectorAll("input, select").forEach(el => {
            el.addEventListener("input", () => this.clearError(el));
            el.addEventListener("change", () => this.clearError(el));
        });
    }

    updateUI() {
        this.updateProgress();

        this.steps.forEach((step, index) => {
            step.style.display = index === this.currentStep ? "block" : "none";
        });

        this.btnBack.style.display = this.currentStep === 0 ? "none" : "inline-block";

        this.btnNext.textContent =
            this.currentStep === this.steps.length - 1 ? "Завершить" : "Далее";
    }

    next() {
        if (!this.validateStep()) return;

        if (this.currentStep < this.steps.length - 1) {
            this.currentStep++;
            this.updateUI();
        } else {
            this.finish();
        }
    }

    prev() {
        if (this.currentStep > 0) {
            this.currentStep--;
            this.updateUI();
        }
    }

    // ----------------------------
    // Валидация шагов
    // ----------------------------

    validateStep() {
        switch (this.currentStep) {
            case 0: return this.validateStepOne();
            case 1: return this.validateStepTwo();
            case 2: return this.validateStepThree();
            case 3: return this.validateStepFive();
        }
        return true;
    }

    validateStepOne() {
        const name = document.querySelector('[name="name"]');
        const surname = document.querySelector('[name="surname"]');

        if (!this.isValidName(name.value)) return this.error(name, "Введите корректное имя");
        if (!this.isValidName(surname.value)) return this.error(surname, "Введите корректную фамилию");

        return true;
    }

    validateStepTwo() {
        const day = document.querySelector('[name="day"]');
        const month = document.querySelector('[name="month"]');
        const year = document.querySelector('[name="year"]');

        if (!day.value) return this.error(day, "Выберите день");
        if (!month.value) return this.error(month, "Выберите месяц");
        if (!year.value) return this.error(year, "Выберите год");

        return true;
    }

    validateStepThree() {
        const sex = document.querySelector('[name="sex"]');
        const city = document.querySelector('[name="city"]');
        const country = document.querySelector('[name="country"]');

        if (!sex.value) return this.error(sex, "Выберите пол");
        if (!city.value.trim()) return this.error(city, "Введите город");
        if (!country.value.trim()) return this.error(country, "Введите страну");

        return true;
    }

    validateStepFive() {
        const email = document.querySelector('[name="email"]');
        const pass1 = document.querySelector('[name="password1"]');
        const pass2 = document.querySelector('[name="password2"]');

        if (!this.isValidEmail(email.value)) return this.error(email, "Некорректный Email");
        if (pass1.value.length < 6) return this.error(pass1, "Пароль минимум 6 символов");
        if (pass1.value !== pass2.value) return this.error(pass2, "Пароли не совпадают");

        return true;
    }

    // ----------------------------
    // Ошибки
    // ----------------------------

    error(el, msg) {
        this.clearError(el);

        el.classList.add("input-error");

        let err = document.createElement("div");
        err.className = "error-text";
        err.textContent = msg;

        el.closest(".form-group").appendChild(err);

        return false;
    }

    clearError(el) {
        el.classList.remove("input-error");
        const group = el.closest(".form-group");
        if (!group) return;

        const e = group.querySelector(".error-text");
        if (e) e.remove();
    }

    // ----------------------------
    // Дата рождения
    // ----------------------------
    initBirthdate() {
        const day = document.querySelector('[name="day"]');
        const month = document.querySelector('[name="month"]');
        const year = document.querySelector('[name="year"]');

        for (let i = 1; i <= 31; i++) {
            day.innerHTML += `<option value="${i}">${i}</option>`;
        }

        const months = [
            "Январь","Февраль","Март","Апрель","Май","Июнь",
            "Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"
        ];

        months.forEach((m, i) => {
            month.innerHTML += `<option value="${i + 1}">${m}</option>`;
        });

        const currentYear = new Date().getFullYear();
        for (let y = currentYear - 100; y <= currentYear - 14; y++) {
            year.innerHTML += `<option value="${y}">${y}</option>`;
        }
    }

    // ----------------------------
    finish() {
        const data = {
            name: document.querySelector('[name="name"]').value,
            surname: document.querySelector('[name="surname"]').value,
            day: document.querySelector('[name="day"]').value,
            month: document.querySelector('[name="month"]').value,
            year: document.querySelector('[name="year"]').value,
            sex: document.querySelector('[name="sex"]').value,
            city: document.querySelector('[name="city"]').value,
            country: document.querySelector('[name="country"]').value,
            email: document.querySelector('[name="email"]').value,
            password: document.querySelector('[name="password1"]').value
        };

        fetch("/reg", {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(data)
        })
            .then(r => r.json())
            .then(res => {
                if (res.status === "ok") {
                    //window.location = "/id" + res.uid;
                    console.log(res.uid);

                } else if (res.status === "err_mail") {
                    alert("Email уже занят");
                }
            });
    }

    // ----------------------------

    isValidName(str) {
        return /^[a-zA-Zа-яА-ЯёЁіІїЇ]+$/.test(str.trim());
    }

    isValidEmail(email) {
        return /^[\w.-]+@[\w.-]+\.\w{2,}$/i.test(email);
    }
}

// =========================
document.addEventListener("DOMContentLoaded", () => {
    new RegistrationForm();
});
