/**
 * Classe utilitária para criação de mensagens de erro no formulário.
 * 
 * @class CreateMessages
 */
class CreateMessages {
    /**
     * Cria e insere uma mensagem de erro após um campo específico.
     * 
     * @static
     * @method errorMessage
     * @param {HTMLElement} campo - Campo do formulário após o qual a mensagem será inserida
     * @param {string} mensagem - Texto da mensagem de erro
     * @returns {void}
     * 
     * @example
     * CreateMessages.errorMessage(inputField, 'Este campo é obrigatório');
     */
    static errorMessage(campo, mensagem) {
        const div = document.createElement('div');
        div.innerHTML = mensagem;
        div.classList.add('text-danger');
        campo.insertAdjacentElement('afterend', div);
    }
}

export default CreateMessages;
