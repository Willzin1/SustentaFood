import Error from './../utils/Error';
import validaReserva from './reservaValidator';

class ValidarReservaForm {
    constructor() {
        this.formulario = document.querySelector('.reserva-form');
        this.validaRes = validaReserva;

        if (!this.formulario) return;

        this.init();
    }


    init() {
        this.formulario.addEventListener('submit', event => {
            this.handleSubmit(event);
        });
    }

    handleSubmit(event) {
        event.preventDefault();
        const camposValidos = this.isFieldValid();
        const validaRes = this.validaRes();

        if(camposValidos && validaRes) {
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
                Error.criaErro(field, `Campo "${label.replace(':', '').toLocaleLowerCase()}" não pode estar em branco.`);
                valid = false;

            } else {
                if(field.classList.contains('dataRes')) {
                    if(!this.isDataValid(field)) valid = false;
                }

                if(field.classList.contains('horaRes')) {
                    if(!this.isHoraValid(field)) valid = false;
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
}

export default new ValidarReservaForm();
