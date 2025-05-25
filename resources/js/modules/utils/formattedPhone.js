/**
 * Inicializa a formatação de números de telefone em elementos com a classe 'phoneUser'.
 * 
 * @function formattedPhone
 * @returns {void}
 */
export default function formattedPhone() {
    const elementTagName = document.querySelector('.phoneUser');

    if (!elementTagName) return;

    formatPhone(elementTagName);
}

/**
 * Formata um número de telefone dentro de um elemento HTML.
 * Atualmente suporta apenas elementos <p>.
 * 
 * THIS FUNCTION WILL WORK IN THE SAME WAY AS InputMasks Function, BUT THIS ONE WILL WORK ON
 * DIFFERENT ELEMENTS TYPES, SUCH AS 'p' OR 'div', SHOULD WE KEEP IT?
 * 
 * @function formatPhone
 * @param {HTMLElement} element - Elemento HTML contendo o número de telefone
 * @returns {void}
 * 
 * @example
 * // Para um elemento <p> com o conteúdo "11999998888"
 * // Será formatado para: "Telefone: (11) 99999-8888"
 */
const formatPhone = (element) => {

    if (element.tagName === 'P') {
        const textPhone = element.textContent.replace(/\D/g, '');
        const textPhoneFormatted = textPhone.replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3');

        return element.innerHTML = `<strong>Telefone: </strong>${textPhoneFormatted}`;;
    };
}

formattedPhone();
