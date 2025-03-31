export default function validaReserva() {
    const totalAssentos = 90;
    const reservas = [];
    const dataInput = document.getElementById('data');
    const horaInput = document.getElementById('hora');
    const quantidadeInput = document.getElementById('quantidade_cadeiras');
    let isValid = true;

    if (!dataInput || !horaInput || !quantidadeInput) {
        return isValid;
    };

    const data = dataInput.value;
    const hora = horaInput.value;
    const quantidade = quantidadeInput.value;

    const reservasDataHora = reservas.filter(reserva => reserva.data === data && reserva.hora === hora);
    const cadeirasOcupadas = reservasDataHora.reduce((total, reserva) => total + reserva.quantidade_cadeiras, 0);

    const quantidadeSolicitada = quantidade === 'mais' ? parseInt(document.getElementById('custom_assentos').value) : parseInt(quantidade);

    if (quantidadeSolicitada + cadeirasOcupadas > totalAssentos) {
        alert('Número total de assentos excede a disponibilidade.');
        isValid = false;
    }

    return isValid;
};
