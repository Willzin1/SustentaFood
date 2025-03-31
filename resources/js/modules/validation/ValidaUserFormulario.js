import { isEmail, isMobilePhone } from 'validator';

class ValidaUserFormulario {
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

        if(camposValidos) {
            this.formulario.submit();
        }
    }

    handleLogin(campo) {
        const senha = campo.value;
        let valid = true;

        if(senha.length < 6 || senha.length > 20) {
            valid = false;
            this.criaErro(campo, 'Senha precisa conter entre 6 a 20 caracteres');
        }

        return valid;
    }

    handleRegister(campo) {
        const senha = campo.value;
        const senhaRepetida = this.formulario.querySelector('.senhaRepetida');
        let valid = true;

        if(senha.length < 6 || senha.length > 20) {
            valid = false;
            this.criaErro(campo, 'Senha precisa conter entre 6 a 20 caracteres');
            return;
        }

        if(senha !== senhaRepetida.value) {
            valid = false;
            this.criaErro(campo, 'Senhas não coincidem');
            this.criaErro(senhaRepetida, 'Senha não coincidem');
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
            } else {

                if(campo.classList.contains('nome')) {
                    if(!this.validaUsuario(campo)) valid = false;
                }

                if(campo.classList.contains('email')) {
                    if(!this.validaEmail(campo)) valid = false;
                }

                if(campo.classList.contains('telefone')) {
                    if(!this.validaTelefone(campo)) valid = false;
                }

                if(campo.classList.contains('senha')) {
                    if(this.formulario.classList.contains('login-form')) {
                        if(!this.handleLogin(campo)) valid = false;
                    }
                    if(this.formulario.classList.contains('register-form')) {
                        if(!this.handleRegister(campo)) valid = false;
                    }
                }
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
            return valid;
        };

        if(!/^[a-zA-Z]+$/.test(usuario)) {
            this.criaErro(campo, 'Nome deve conter apenas letras.');
            valid = false;
            return valid;
        }

        return valid;
    }

    validaEmail(campo) {
        const email = campo.value;
        let valid = true;

        if(!isEmail(email)) {
            this.criaErro(campo, 'Insira um e-mail válido');
            valid = false;
        }

        return valid;
    }

    validaTelefone(campo) {
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

export default new ValidaUserFormulario();
