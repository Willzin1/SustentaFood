import { token, urlApi } from "../global/globalVariables";

export default async function reservationsReports() {
    try {
        const charts = document.querySelectorAll('.reservasChart');
        if (!charts.length) return;

        const [dia, semana, mes] = await Promise.all([
            fetchReports('dia'),
            fetchReports('semana'),
            fetchReports('mes')
        ]);

        const reports = [
            { data: dia, titulo: 'Reservas do Dia' },
            { data: semana, titulo: 'Reservas da Semana' },
            { data: mes, titulo: 'Reservas do Mês' }
        ];

        reports.forEach((report, index) => {
            if (charts[index]) {
                createGraph(charts[index], report.data, report.titulo);
            }
        });

    } catch (error) {
        alert('Erro ao carregar dados das reservas');
    }
}

async function fetchReports(date) {
    const res = await axios.get(`${urlApi}/relatorios/reservas/${date}`, {
        headers: { Authorization: `Bearer ${token}` }
    });
    return res.data;
}

function createGraph(canvas, data, title) {
    const labels = ['Total', 'Confirmadas', 'Pendentes', 'Canceladas'];
    const values = [data.total, data.confirmadas, data.pendentes, data.canceladas];

    new Chart(canvas, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total',
                data: values,   // azul        verde    amarelo     vermelho
                backgroundColor: ['#4e73df', '#1cc88a', '#f6c23e', '#e74a3b']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                title: { display: true, text: title }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: Math.ceil(Math.max(...values) / 5) || 1
                    }
                }
            }
        }
    });
}
