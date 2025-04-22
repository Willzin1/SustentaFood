import IMask from "imask";

export default function InputPhoneMask() {
    const phoneInput = document.querySelector('.telefone');

    if (!phoneInput) return;

    IMask(phoneInput, {
        mask: '(00) 00000-0000'
    });
}

InputPhoneMask();
