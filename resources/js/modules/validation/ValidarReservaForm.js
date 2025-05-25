import CreateMessages from '../utils/CreateMessages';
import inputCustom from '../utils/customInput';

/**
 * Classe responsável pela validação do formulário de reservas.
 * 
 * @class ValidarReservaForm
 * @description Gerencia a validação de campos do formulário de reserva, incluindo data,
 * hora e quantidade de assentos. Implementa validações específicas para cada tipo de campo.
 */
class ValidarReservaForm {
    /**
     * Inicializa o validador do formulário de reserva.
     * Busca o formulário com a classe 'reserva-form' e inicializa os eventos.
     * 
     * @constructor
     */
    constructor() {
        this.formulario = document.querySelector('.reserva-form');

        if (!this.formulario) return;

        this.init();
    }

    /**
     * Inicializa os eventos do formulário.
     * Adiciona o listener de submit e configura inputs customizados.
     * 
     * @method init
     * @private
     */
    init() {
        this.formulario.addEventListener('submit', event => {
            this.handleSubmit(event);
        });

        inputCustom(this.formulario);
    }

    /**
     * Manipula o evento de submit do formulário.
     * Previne o comportamento padrão e valida os campos antes de submeter.
     * 
     * @method handleSubmit
     * @param {Event} event - Evento de submit do formulário
     * @private
     */
    handleSubmit(event) {
        event.preventDefault();
        const camposValidos = this.isFieldValid();

        if(camposValidos) {
            this.formulario.submit();
        }
    }

    /**
     * Valida todos os campos do formulário.
     * Remove mensagens de erro anteriores e valida cada campo marcado com a classe 'validar'.
     * 
     * @method isFieldValid
     * @returns {boolean} Retorna true se todos os campos são válidos, false caso contrário
     * @private
     */
    isFieldValid() {
        let valid = true;

        for(let errorText of this.formulario.querySelectorAll('.text-danger')) {
            errorText.remove();
        }

        for(let field of this.formulario.querySelectorAll('.validar')) {
            let label = field.previousElementSibling.innerHTML;

            if(!field.value) {
                CreateMessages.errorMessage(field, `Campo "${label.replace(':', '').toLocaleLowerCase()}" não pode estar em branco.`);
                valid = false;

            } else {
                if(field.classList.contains('dataRes')) {
                    if(!this.isDataValid(field)) valid = false;
                }

                if(field.classList.contains('horaRes')) {
                    if(!this.isHoraValid(field)) valid = false;
                }

                if(field.classList.contains('quantidade_cadeiras')) {
                    if(!this.isQuantityValid(field)) valid = false;
                }
            }
        }

        return valid;
    }

    /**
     * Valida o campo de data da reserva.
     * 
     * @method isDataValid
     * @param {HTMLElement} field - Campo de input da data
     * @returns {boolean} Retorna true se a data é válida, false caso contrário
     * @private
     */
    isDataValid(field) {
        const data = field.value;
        let valid = true;

        if(!data) {
            console.log('DATA NAO EXISTE');
            valid = false;
        }

        return valid;
    }

    /**
     * Valida o campo de hora da reserva.
     * 
     * @method isHoraValid
     * @param {HTMLElement} field - Campo de input da hora
     * @returns {boolean} Retorna true se a hora é válida, false caso contrário
     * @private
     */
    isHoraValid(field) {
        const hora = field.value;
        let valid = true;

        if(!hora) {
            console.log('HORA NAO EXISTE');
        }

        return valid;
    }

    /**
     * Valida a quantidade de assentos selecionada.
     * Verifica se a quantidade está dentro dos limites permitidos (1-12 pessoas).
     * 
     * @method isQuantityValid
     * @param {HTMLElement} field - Campo de seleção de quantidade de assentos
     * @returns {boolean} Retorna true se a quantidade é válida, false caso contrário
     * @private
     */
    isQuantityValid(field) {
        const input = field.value;
        const customInput = document.querySelector('#custom_assentos');
        let quantity;
        let valid = true;

        if (input === 'mais') {
            quantity = customInput.value;

            if (!quantity || quantity <= 0) {
                CreateMessages.errorMessage(customInput, 'Informe a quantidade de pessoas.');
                valid = false;
            }

            if (quantity > 12) {
                CreateMessages.errorMessage(customInput, 'Reservas acima de 12 devem ser feitas diretamente com o restaurante.');
                valid = false;
            }
        } else {
            quantity = input;
            if (!quantity) {
                CreateMessages.errorMessage(field, 'Selecione a quantidade de assentos.');
                valid = false;
            }
        }

        return valid;
    }

}

export default new ValidarReservaForm();
