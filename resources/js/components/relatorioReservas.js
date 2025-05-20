import { token, urlApi } from "../global/globalVariables";

export default async function relatorioReservas() {
    const diaDiv = document.getElementById('totalDia');
    const semanaDiv = document.getElementById('totalSemana');
    const mesDiv = document.getElementById('totalMes');

    if (!diaDiv || !semanaDiv || !mesDiv) return;

    try {
        const [dia, semana, mes] = await Promise.all([
            axios.get(`${urlApi}/relatorios/reservas/dia`, {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            }),
            axios.get(`${urlApi}/relatorios/reservas/semana`, {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            }),
            axios.get(`${urlApi}/relatorios/reservas/mes`, {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            }),
        ]);

        diaDiv.textContent = dia.data.total;
        semanaDiv.textContent = semana.data.total;
        mesDiv.textContent = mes.data.total;

        createGraph(mes.data.semanas);

    } catch (error) {
        alert('Erro ao carregar dados das reservas');
        console.log(error)
    }
}

function createGraph(data) {
    const labels = data.map(item => item.periodo);
    const valores = data.map(item => item.total);

    return new Chart(document.getElementById('reservasChart'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Reservas por semana',
                data: valores,
                backgroundColor: '#4e73df'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}
