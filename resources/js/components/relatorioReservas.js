export default async function relatorioReservas() {
    const diaDiv = document.getElementById('totalDia');
    const semanaDiv = document.getElementById('totalSemana');
    const mesDiv = document.getElementById('totalMes');

    if (!diaDiv || !semanaDiv || !mesDiv) return;

    try {
        const [dia, semana, mes, grafico] = await Promise.all([
            axios.get('http://20.186.89.170/api/relatorios/reservas/dia'),
            axios.get('http://20.186.89.170/api/relatorios/reservas/semana'),
            axios.get('http://20.186.89.170/api/relatorios/reservas/mes'),
            axios.get('http://20.186.89.170/api/relatorios/reservas/diaSemana'),
        ]);

        diaDiv.textContent = dia.data.total;
        semanaDiv.textContent = semana.data.total;
        mesDiv.textContent = mes.data.total;

        const labels = grafico.data.map(item => item.label);
        const valores = grafico.data.map(item => item.total);

        new Chart(document.getElementById('reservasChart'), {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Reservas por Dia',
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

    } catch (error) {
        alert('Erro ao carregar dados das reservas');
    }
}
