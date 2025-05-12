import CreateMessages from '../utils/CreateMessages';
import inputCustom from '../utils/customInput';

class ValidarReservaForm {
    constructor() {
        this.formulario = document.querySelector('.reserva-form');

        if (!this.formulario) return;

        this.init();
    }

    init() {
        this.formulario.addEventListener('submit', event => {
            this.handleSubmit(event);
        });

        inputCustom(this.formulario);
    }

    handleSubmit(event) {
        event.preventDefault();
        const camposValidos = this.isFieldValid();

        if(camposValidos) {
            this.formulario.submit();
        }
    }

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

    isDataValid(field) {
        const data = field.value;
        let valid = true;

        if(!data) {
            console.log('DATA NAO EXISTE');
            valid = false;
        }

        return valid;
    }

    isHoraValid(field) {
        const hora = field.value;
        let valid = true;

        if(!hora) {
            console.log('HORA NAO EXISTE');
        }

        return valid;
    }

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
