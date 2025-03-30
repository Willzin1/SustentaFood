export default function mostrarInputCustomizado() {
    const quantidadeCadeirasSelect = document.getElementById('quantidade_cadeiras');
    const customInput = document.getElementById('custom_assentos');

    if (!quantidadeCadeirasSelect || !customInput) return;

    if (quantidadeCadeirasSelect.value === 'mais') {
        customInput.classList.remove('hidden');  // Torna o input visível
        customInput.setAttribute("name", "quantidade_cadeiras"); // Permite que o valor seja enviado no formulário
        quantidadeCadeirasSelect.removeAttribute("name"); // Remove o nome do select para evitar duplicidade
    } else {
        customInput.classList.add('hidden'); // Oculta o input
        customInput.value = ""; // Limpa o campo
        customInput.removeAttribute("name"); // Remove o nome do input personalizado
        quantidadeCadeirasSelect.setAttribute("name", "quantidade_cadeiras"); // Restaura o nome do select
    }
}

mostrarInputCustomizado();
