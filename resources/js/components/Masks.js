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
    })
}

formattedReserDate();
InputPhoneMask();
