import CreateMessages from '../utils/CreateMessages';

/**
 * Classe responsável pela validação do formulário de pratos.
 *
 * @class ValidaPratoForm
 * @description Gerencia validações de campos como nome, descrição, categoria e imagem
 * do prato, aplicando regras específicas para cada tipo de campo.
 */
class ValidaPratoForm {
    /**
     * Inicializa o validador do formulário de pratos.
     * Busca o formulário com a classe 'prato-form' e inicializa os eventos.
     *
     * @constructor
     */
    constructor() {
        this.formulario = document.querySelector('.prato-form');

        if(!this.formulario) return;

        this.init();
    }

    /**
     * Inicializa os eventos do formulário.
     *
     * @method init
     * @private
     */
    init() {
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
        const camposValidos = this.isFieldValid();

        if(camposValidos) {
            this.formulario.submit();
        }
    }

    /**
     * Valida todos os campos do formulário.
     * Remove mensagens de erro anteriores e aplica validações específicas para cada tipo de campo.
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
                if(field.classList.contains('nome')) {
                    if(!this.isNomeValid(field)) valid = false;
                }

                if(field.classList.contains('descricao')) {
                    if(!this.isDescricaoValid(field)) valid = false;
                }

                if(field.classList.contains('categoria')) {
                    if(!this.isCategoriaValid(field)) valid = false;
                }

                if(field.classList.contains('imagem')) {
                    if(!this.isImagemValid(field)) valid = false;
                }
            }
        }

        return valid;
    }

    /**
     * Valida o nome do prato.
     * Verifica se o nome tem entre 3 e 100 caracteres e contém apenas letras.
     *
     * @method isNomeValid
     * @param {HTMLElement} field - Campo de input do nome
     * @returns {boolean} Retorna true se o nome é válido, false caso contrário
     * @private
     */
    isNomeValid(field) {
        const pratoNome = field.value;
        let valid = true;

        if (pratoNome.length < 3 || pratoNome.length > 100) {
            CreateMessages.errorMessage(field, 'Deve conter entre 3 a 100 caracteres');
            valid = false;
            return;
        }

        if(!/^[a-zA-Zà-úÀ-ÚçÇ\s\-,.]+$/.test(pratoNome)) {
            CreateMessages.errorMessage(field, 'Deve conter apenas letras');
            valid = false;
        }

        return valid;
    }

    /**
     * Valida a descrição do prato.
     * Verifica se a descrição tem entre 3 e 100 caracteres e contém apenas letras.
     *
     * @method isDescricaoValid
     * @param {HTMLElement} field - Campo de input da descrição
     * @returns {boolean} Retorna true se a descrição é válida, false caso contrário
     * @private
     */
    isDescricaoValid(field) {
        const pratoDesc = field.value;
        let valid = true;

        if (pratoDesc.length < 3 || pratoDesc.length > 100) {
            CreateMessages.errorMessage(field, 'Deve conter entre 3 a 100 caracteres');
            valid = false;
            return;
        }

        if(!/^[a-zA-Zà-úÀ-ÚçÇ\s\-,.]+$/.test(pratoDesc)) {
            CreateMessages.errorMessage(field, 'Deve conter apenas letras');
            valid = false;
        }

        return valid;
    }

    /**
     * Valida a categoria do prato.
     * Verifica se a categoria selecionada está entre as opções válidas.
     *
     * @method isCategoriaValid
     * @param {HTMLElement} field - Campo de seleção da categoria
     * @returns {boolean} Retorna true se a categoria é válida, false caso contrário
     * @private
     */
    isCategoriaValid(field) {
        const categoria = field.value;
        const categorias = ['Entradas', 'Prato principal', 'Sobremesas', 'Cardapio infantil', 'Bebidas'];
        let valid = true

        if(!categorias.includes(categoria)) {
            valid = false;
            CreateMessages.errorMessage(field, 'Categoria não existe');
        }

        return valid;
    }

    /**
     * Valida o campo de imagem do prato.
     * Verifica se um arquivo foi selecionado, o tipo de arquivo e o tamanho (max 2MB).
     *
     * @method isImagemValid
     * @param {HTMLInputElement} field - Campo de upload de imagem (input type="file")
     * @returns {boolean} Retorna true se a imagem é válida ou se nenhum arquivo foi selecionado (em caso de edição onde a imagem não é obrigatória), false caso contrário
     * @private
     */
    isImagemValid(field) {
        let valid = true;
        const file = field.files[0]; // Pega o primeiro arquivo selecionado

        // Se não há arquivo selecionado e o campo não é obrigatório para um novo upload, é válido.
        // Se for um formulário de 'criação', e a imagem for obrigatória, essa lógica pode precisar de ajuste.
        // Assumindo que no update a imagem não é obrigatória, e no create ela pode ser,
        // mas a validação de 'campo em branco' já deveria pegar.
        if (!file) {
            // Se não há arquivo e o formulário é para edição (PUT), a imagem pode não ser obrigatória
            // Se for criação, e a imagem for obrigatória, você precisaria adicionar uma regra aqui
            // para 'campo vazio' específico para o input file.
            // Por enquanto, consideramos válido se nenhum arquivo for selecionado.
            // Se você quer que a imagem seja obrigatória em 'create', adicione:
            // if (this.formulario.classList.contains('form-create-prato')) { // Add a class to your create form
            //    CreateMessages.errorMessage(field, 'O campo imagem é obrigatório.');
            //    valid = false;
            // }
            return valid;
        }

        const maxSizeBytes = 2 * 1024 * 1024; // 2MB em bytes
        const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];

        // 1. Validar Tipo de Arquivo
        if (!allowedTypes.includes(file.type)) {
            CreateMessages.errorMessage(field, 'A imagem deve ser do tipo JPEG, PNG, JPG ou GIF.');
            valid = false;
        }

        // 2. Validar Tamanho do Arquivo
        if (file.size > maxSizeBytes) {
            CreateMessages.errorMessage(field, 'A imagem não pode ser maior que 2MB.');
            valid = false;
        }

        return valid;
    }
}

export default new ValidaPratoForm();
