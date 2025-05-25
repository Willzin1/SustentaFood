import { isEmail, isMobilePhone } from 'validator';

import CreateMessages from '../utils/CreateMessages';

/**
 * Classe responsável pela validação de formulários de usuário.
 * Implementa validações para login e registro de usuários.
 * 
 * @class ValidaUserFormulario
 * @description Gerencia validações de campos como nome, email, telefone e senha,
 * com regras específicas para cada tipo de campo e formulário (login/registro).
 */
class ValidaUserFormulario {
    /**
     * Inicializa o validador de formulário de usuário.
     * Busca o formulário com a classe 'formulario' e inicializa os eventos.
     * 
     * @constructor
     */
    constructor() {
        this.formulario = document.querySelector('.formulario');

        if(!this.formulario) return;

        this.eventos();
    }

    /**
     * Inicializa os eventos do formulário.
     * 
     * @method eventos
     * @private
     */
    eventos() {
        this.formulario.addEventListener('submit', event => {
            this.handleSubmit(event);
        });
    }

    /**
     * Manipula o evento de submit do formulário.
     * 
     * @method handleSubmit
     * @param {Event} event - Evento de submit do formulário
     * @private
     */
    handleSubmit(event) {
        event.preventDefault();
        const camposValidos = this.camposSaoValidos();

        if(camposValidos) {
            this.formulario.submit();
        }
    }

    /**
     * Valida o campo de senha no formulário de login.
     * 
     * @method handleLogin
     * @param {HTMLElement} campo - Campo de input da senha
     * @returns {boolean} Retorna true se a senha é válida, false caso contrário
     * @private
     */
    handleLogin(campo) {
        const senha = campo.value;
        let valid = true;

        if(senha.length < 6 || senha.length > 20) {
            valid = false;
            CreateMessages.errorMessage(campo, 'Senha precisa conter entre 6 a 20 caracteres');
        }

        return valid;
    }

    /**
     * Valida os campos de senha no formulário de registro.
     * Verifica se as senhas coincidem e atendem aos requisitos de tamanho.
     * 
     * @method handleRegister
     * @param {HTMLElement} campo - Campo de input da senha
     * @returns {boolean} Retorna true se as senhas são válidas, false caso contrário
     * @private
     */
    handleRegister(campo) {
        const senha = campo.value;
        const senhaRepetida = this.formulario.querySelector('.senhaRepetida');
        let valid = true;

        if(senha.length < 6 || senha.length > 20) {
            valid = false;
            CreateMessages.errorMessage(campo, 'Senha precisa conter entre 6 a 20 caracteres');
            return;
        }

        if(senha !== senhaRepetida.value) {
            valid = false;
            CreateMessages.errorMessage(campo, 'Senhas não coincidem');
            CreateMessages.errorMessage(senhaRepetida, 'Senha não coincidem');
        }

        return valid;
    }

    /**
     * Valida todos os campos do formulário.
     * Remove mensagens de erro anteriores e aplica validações específicas para cada tipo de campo.
     * 
     * @method camposSaoValidos
     * @returns {boolean} Retorna true se todos os campos são válidos, false caso contrário
     * @private
     */
    camposSaoValidos() {
        let valid = true;

        for(let errorText of this.formulario.querySelectorAll('.text-danger')){
            errorText.remove();
        }

        for(let campo of this.formulario.querySelectorAll('.validar')){
            let label = campo.previousElementSibling.innerHTML;

            if(!campo.value) {
                CreateMessages.errorMessage(campo, `Campo "${label.replace(':', '').toLocaleLowerCase()}" não pode estar em branco.`);
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

    /**
     * Valida o nome do usuário.
     * Verifica tamanho e se contém apenas letras.
     * 
     * @method validaUsuario
     * @param {HTMLElement} campo - Campo de input do nome
     * @returns {boolean} Retorna true se o nome é válido, false caso contrário
     * @private
     */
    validaUsuario(campo) {
        const nomeUser = campo.value;
        let valid = true;

        if(nomeUser.length < 3 || nomeUser.length > 255) {
            CreateMessages.errorMessage(campo, 'Nome deve conter entre 3 e 255 caracteres.');
            valid = false;
            return valid;
        };

        if(!/^[a-zA-Zà-úÀ-Ú\s]+$/.test(nomeUser)) {
            CreateMessages.errorMessage(campo, 'Nome deve conter apenas letras.');
            valid = false;
            return valid;
        }

        return valid;
    }

    /**
     * Valida o email do usuário usando a biblioteca validator.
     * 
     * @method validaEmail
     * @param {HTMLElement} campo - Campo de input do email
     * @returns {boolean} Retorna true se o email é válido, false caso contrário
     * @private
     */
    validaEmail(campo) {
        const email = campo.value;
        let valid = true;

        if(!isEmail(email)) {
            CreateMessages.errorMessage(campo, 'Insira um e-mail válido');
            valid = false;
        }

        return valid;
    }

    /**
     * Valida o telefone do usuário usando a biblioteca validator.
     * Verifica se está no formato brasileiro.
     * 
     * @method validaTelefone
     * @param {HTMLElement} campo - Campo de input do telefone
     * @returns {boolean} Retorna true se o telefone é válido, false caso contrário
     * @private
     */
    validaTelefone(campo) {
        const tel = campo.value;
        let valid = true;

        if(!isMobilePhone(tel, 'pt-BR')) {
            CreateMessages.errorMessage(campo, 'Insira um telefone válido');
            valid = false;
        }

        return valid;
    }
}

export default new ValidaUserFormulario();
