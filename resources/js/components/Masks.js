import IMask from "imask";

export const InputPhoneMask = () => {
    const phoneInput = document.querySelector('.telefone');

    if (!phoneInput) return;

    IMask(phoneInput, {
        mask: '(00) 00000-0000'
    });
}

export const formattedReserDate = () => {
    const elementTagName = document.querySelectorAll('.reserDate');

    if (!elementTagName) return;

    elementTagName.forEach((element) => {
        const dateText = element.textContent.replace('Data: ', '');

        const date = new Date(dateText);
        const dateFormatted = date.toLocaleDateString('pt-br');

        element.innerHTML = `<strong>Data:</strong> ${dateFormatted}`;
    });
}

export const formattedReserTime = () => {
    const elementTag = document.querySelector('.reserTime');

    if (!elementTag || !elementTag.options) return;

    const selectValue = elementTag.options[0].value;
    const timeDate = new Date(selectValue);

    elementTag.options[0].textContent = timeDate.toLocaleTimeString('pt-BR', {
        hour12: false,
        hour: "2-digit",
        minute: '2-digit'
    });
}

formattedReserTime();
formattedReserDate();
InputPhoneMask();
