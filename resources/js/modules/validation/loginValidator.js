class ValidaFormulario {
    constructor() {
        this.formulario = document.querySelector('.formu');

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

        if(camposValidos && senhasValidas) {
            this.formulario.submit();
        }
    }

    senhasSaoValidas() {
        let valid = true;
        const senha = this.formulario.querySelector('.senha');
        const senhaRepetida = this.formulario.querySelector('.senhaRepetida');

        if(senha.value.length < 6 || senha.value.length > 20){
            valid = false;
            this.criaErro(senha, 'Senha precisa conter entre 6 a 20 caracteres');
            return;
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
            } else {

                if(campo.classList.contains('email')) {
                    if(!this.validaEmail(campo)) valid = false;
                }

                if(campo.classList.contains('senha')) {
                    if(!this.senhasSaoValidas()) valid = false;
                }
            }
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

    criaErro(campo, mensagem){
        const div = document.createElement('div');
        div.innerHTML = mensagem;
        div.classList.add('text-danger');
        campo.insertAdjacentElement('afterend', div);
    }
}
