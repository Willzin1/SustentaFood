import { token, urlApi } from "../global/globalVariables";
import createLoadingDiv from "../modules/utils/createLoadingDiv";
import exportToPDF from "./exportToPDF";

/**
 * Gera gráficos com dados de relatórios de reservas (diário, semanal e mensal).
 *
 * Esta função busca os dados de reservas a partir da API, separando por período (dia, semana e mês),
 * e em seguida cria gráficos para exibir esses dados em elementos canvas da interface.
 * Os gráficos são renderizados apenas se houver elementos com a classe `.reservasChart` presentes na página.
 *
 * @returns {Promise<void>} - Não retorna nada diretamente. Manipula o DOM ao renderizar gráficos.
 */
export default async function reservationsReports() {
    const container = document.querySelector('.containerGerente');

    if (!container) return;

    const loadingDiv = createLoadingDiv(container, 'Buscando reservas...');

    try {
        const charts = document.querySelectorAll('.reservasChart');
        if (!charts.length) {
            loadingDiv.remove();
            return;
        }

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

        handleExportButton();
    } catch (error) {
        toastr.error('Erro ao carregar dados das reservas');
    } finally {
        loadingDiv.remove();
    }
}

/**
 *  Busca dados da resrva para um período específico.
 *
 * @param {string} date - Período desejado
 * @returns {Promise<Object>} - Um objeto com os dados das reservas do período solicitado
 */
async function fetchReports(date) {
    const res = await axios.get(`${urlApi}/relatorios/reservas/${date}`, {
        headers: { Authorization: `Bearer ${token}` }
    });
    return res.data;
}

/**
 *
 * @param {HTMLCanvasElement} canvas - Elemento onde será renderizado o gráfico
 * @param {Object} data - Dados da reserva (total, confirmadas, pendentes, canceladas)
 * @param {string} title - Título a ser exibido no gráfico.
 */
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

/**
 * Responsável por lidar com os botões de exportar reservas
 *
 * @throws {Error} - Em caso de erro na requisição à API
 */
function handleExportButton() {
    const exportButton = document.querySelectorAll('.export-button');

    exportButton.forEach(async button => {
        button.addEventListener('click', async (e) => {
            e.preventDefault();

            const title = button.closest('div').querySelector('h5').textContent.trim();

            // Determine which period to fetch based on the title
            let period;
            if (title.includes('Hoje')) period = 'dia';
            if (title.includes('Semana')) period = 'semana';
            if (title.includes('Mês')) period = 'mes';

            try {
                const data = await fetchReports(period);

                const formattedData = [
                    `Total de Reservas: ${data.total}`,
                    `Reservas Confirmadas: ${data.confirmadas}`,
                    `Reservas Pendentes: ${data.pendentes}`,
                    `Reservas Canceladas: ${data.canceladas}`
                ];

                exportToPDF(formattedData, `Relatório de Reservas - ${title}`);
            } catch (error) {
                toastr.error('Erro ao exportar relatório');
            }
        });
    });
}
