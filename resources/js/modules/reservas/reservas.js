const reservas = [];

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
