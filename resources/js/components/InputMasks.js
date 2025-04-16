class InputMasks {

    constructor() {
        this.tel = document.querySelector('.telefone');

        if (!this.tel) return;

        this.phoneMask(this.tel);
    }

    phoneMask(phoneInput) {
        phoneInput.addEventListener('input', () => {
            let phone = phoneInput.value.replace(/\D/g, '');

            if (phone.length > 11) {
                return;
            }

            if (phone.length > 0) {
                const ddd = phone.slice(0, 2);
                const fiveDigits = phone.slice(2, 7);
                const fourDigits = phone.slice(7, phone.length);

                phone = `(${ddd}`;
                if (fiveDigits) phone += `) ${fiveDigits}`;
                if (fourDigits) phone += `-${fourDigits}`;
            }

            this.tel.value = phone;
        });
    }
}

export default new InputMasks;
