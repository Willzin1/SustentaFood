export default function formattedPhone() {
    const elementTagName = document.querySelector('.phoneUser');

    if (!elementTagName) return;

    formatPhone(elementTagName);
}

// THIS FUNCTION WILL WORK IN THE SAME WAY AS InputMasks Function, BUT THIS ONE WILL WORK ON
// DIFFERENT ELEMENTS TYPES, SUCH AS 'p' OR 'div', SHOULD WE KEEP IT?
const formatPhone = (element) => {

    if (element.tagName === 'P') {
        const textPhone = element.textContent.replace(/\D/g, '');
        const textPhoneFormatted = textPhone.replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3');

        return element.innerHTML = `<strong>Telefone: </strong>${textPhoneFormatted}`;;
    };
}

formattedPhone();
