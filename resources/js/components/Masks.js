import IMask from "imask";
import formatDate from "../modules/utils/formatDate";

/**
 * Aplica máscara de telefone ao campo com a classe `.telefone`.
 *
 * Utiliza a biblioteca IMask para formatar a entrada no padrão brasileiro.
 * A função só executa se o elemento estiver presente no DOM.
 *
 * @function InputPhoneMask
 * @returns {void}
 */
export const InputPhoneMask = () => {
    const phoneInput = document.querySelector('.telefone');

    if (!phoneInput) return;

    IMask(phoneInput, {
        mask: '(00) 00000-0000'
    });
}

/**
 * Formata todas as datas encontradas em elementos com a classe `.reserDate`.
 *
 * A função busca os elementos com a classe `reserDate`, remove o prefixo 'Data: ',
 * aplica a função `formatDate` (customizada) e insere novamente no HTML com `<strong>`.
 *
 * @function formattedReserDate
 * @returns {void}
 */
export const formattedReserDate = () => {
    const elementTagName = document.querySelectorAll('.reserDate');

    if (!elementTagName) return;

    elementTagName.forEach((element) => {
        const dateText = element.textContent.replace('Data: ', '');
        element.innerHTML = `<strong>Data:</strong> ${formatDate(dateText)}`;
    });
}

/**
 * Formata o horário da primeira opção de um `<select>` com a classe `.reserTime`.
 *
 * A função extrai o valor da primeira `option`, transforma em um objeto `Date`,
 * e reescreve o texto exibido no formato `HH:mm` (24 horas, sem AM/PM).
 *
 * @function formattedReserTime
 * @returns {void}
 */
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

// Execução imediata das funções após importação
formattedReserTime();
formattedReserDate();
InputPhoneMask();
