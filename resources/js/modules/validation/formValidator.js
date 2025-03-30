import { isEmail, isMobilePhone } from 'validator';
import validaReserva from './reservaValidator';

class ValidaFormulario {
    constructor() {
        this.formulario = document.querySelector('.formulario');

        if(!this.formulario) return;

        this.eventos();
    }

    eventos() {
        this.formulario.addEventListener('submit', event => {
            this.handleSubmit(event);
        });
    }

    handleSubmit(event) {
        event.preventDefault();
        const camposValidos = this.camposSaoValidos();
        const senhasValidas = this.senhasSaoValidas();
        const reservaValida = validaReserva();

        if(camposValidos && senhasValidas && reservaValida) {
            this.formulario.submit();
        }
    }

    senhasSaoValidas() {
        let valid = true;
        const senha = this.formulario.querySelector('.senha');
        const senhaRepetida = this.formulario.querySelector('.senhaRepetida');

        if(!senhaRepetida) return valid;

        if(senha.value.length < 6 || senha.value.length > 20){
            valid = false;
            this.criaErro(senha, 'Senha precisa conter entre 6 a 20 caracteres');
        }


        if(senha.value !== senhaRepetida.value) {
            valid = false;
            this.criaErro(senha, 'Senhas não coincidem.');
            this.criaErro(senhaRepetida, 'Senhas não coincidem.');
        }

        return valid;
    }

    camposSaoValidos() {
        let valid = true;

        for(let errorText of this.formulario.querySelectorAll('.text-danger')){
            errorText.remove();
        }

        for(let campo of this.formulario.querySelectorAll('.validar')){
            let label = campo.previousElementSibling.innerHTML;

            if(!campo.value) {
                this.criaErro(campo, `Campo "${label.replace(':', '').toLocaleLowerCase()}" não pode estar em branco.`);
                valid = false;
            }

            if(campo.classList.contains('nome')) {
                if(!this.validaUsuario(campo)) valid = false;
            }

            if(campo.classList.contains('email')) {
                if(!this.validaEmail(campo)) valid = false;
            }

            if(campo.classList.contains('telefone')) {
                if(!this.validaTelefone(campo)) valid = false;
            }
        }

        return valid;
    }

    validaUsuario(campo) {
        const usuario = campo.value;
        let valid = true;

        if(usuario.length < 3 || usuario.length > 12) {
            this.criaErro(campo, 'Nome deve conter entre 3 e 255 caracteres.');
            valid = false;
        };

        if(!usuario.match(/[a-zA-Z]+/g)) {
            this.criaErro(campo, 'Nome deve conter apenas letras.');
            valid = false;
        }

        return valid;
    }

    validaEmail(campo) {
        if(!campo) return;

        const email = campo.value;
        let valid = true;

        if(!email) return valid;

        if(!isEmail(email)) {
            this.criaErro(campo, 'Insira um e-mail válido');
            valid = false;
        }

        return valid;
    }

    validaTelefone(campo) {
        if(!campo) return;

        const tel = campo.value;
        let valid = true;

        if(!isMobilePhone(tel, 'pt-BR')) {
            this.criaErro(campo, 'Insira um telefone válido');
            valid = false;
        }

        return valid;
    }

    criaErro(campo, mensagem){
        const div = document.createElement('div');
        div.innerHTML = mensagem;
        div.classList.add('text-danger');
        campo.insertAdjacentElement('afterend', div);
    }
}

export default new ValidaFormulario();
