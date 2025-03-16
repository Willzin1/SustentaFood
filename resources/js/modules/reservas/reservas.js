const totalAssentos = 90;
const reservas = [];

export function validarReserva() {
    const dataInput = document.getElementById('data').value;
    const horaInput = document.getElementById('hora').value;
    const quantidadeCadeirasInput = document.getElementById('quantidade_cadeiras').value;

    const reservasDataHora = reservas.filter(reserva => reserva.data === dataInput && reserva.hora === horaInput);
    const cadeirasOcupadas = reservasDataHora.reduce((total, reserva) => total + reserva.quantidade_cadeiras, 0);

    const quantidadeSolicitada = quantidadeCadeirasInput === 'mais' ? parseInt(document.getElementById('custom_assentos').value) : parseInt(quantidadeCadeirasInput);

    if (quantidadeSolicitada + cadeirasOcupadas > totalAssentos) {
        alert('Número total de assentos excede a disponibilidade.');
        return false;
    }

    return true;
}

export function adicionarReserva() {
    const dataInput = document.getElementById('data').value;
    const horaInput = document.getElementById('hora').value;
    const quantidadeCadeirasInput = document.getElementById('quantidade_cadeiras').value;

    const quantidadeSolicitada = quantidadeCadeirasInput === 'mais' ? parseInt(document.getElementById('custom_assentos').value) : parseInt(quantidadeCadeirasInput);

    reservas.push({
        data: dataInput,
        hora: horaInput,
        quantidade_cadeiras: quantidadeSolicitada
    });
}

export function mostrarInputCustomizado() {
    const quantidadeCadeirasSelect = document.getElementById('quantidade_cadeiras');
    const customInput = document.getElementById('custom_assentos');

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
