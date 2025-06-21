import jsPDF from 'jspdf';
import autoTable from 'jspdf-autotable';

/**
 * Irá determinar qual a função responsável por cada exportação.
 * Caso exista nos dados recebidos a opção de prato, utiliza a função para exportar
 * pratos, caso contrário irá utilizar a opção de exportar reservas.
 *
 * @param {Array<Object>} data - Dados a serem incluídos nos relatórios
 * @param {string} reportTitle - Título para ser incluído ao relatório
 * @returns {Function} - Retorna a função à qual será a responsável para fazer a exportação
 */
export default function exportToPDF(data, reportTitle) {
    return data[0]?.prato ? exportFavDishesToPDF(data, reportTitle) : exportReservationsToPDF(data, reportTitle);
}

/**
 * Gera e faz download de um arquivo PDF contendo relatório dos pratos favoritados.
 *
 * O PDF gerado inclui:
 * - Título do relatório
 * - Data e hora de geração
 * - Tabela com nome do prato, total de favoritos e descrição
 * - Total de pratos ao final do documento
 *
 * @function exportFavDishesToPDF
 * @param {Array<Object>} data - Dados dos pratos a serem incluídos no relatório
 * @param {string} categoryTitle - Título da categoria para o relatório
 */
function exportFavDishesToPDF(data, categoryTitle) {
    const doc = new jsPDF();

    // Adiciona título centralizado
    doc.setFontSize(20);
    const title = `Relatório de ${categoryTitle} Mais Favoritados`;
    const pageWidth = doc.internal.pageSize.width;
    const titleWidth = doc.getStringUnitWidth(title) * doc.internal.getFontSize() / doc.internal.scaleFactor;
    const titleX = (pageWidth - titleWidth) / 2;
    doc.text(title, titleX, 20);

    // Adiciona data e hora no topo direito
    doc.setFontSize(10);
    const now = new Date();
    const dataHora = `Data: ${now.toLocaleDateString('pt-BR')} - Hora: ${now.toLocaleTimeString('pt-BR')}`;
    const dataWidth = doc.getStringUnitWidth(dataHora) * doc.internal.getFontSize() / doc.internal.scaleFactor;
    doc.text(dataHora, pageWidth - dataWidth - 10, 10);

    // Preparar dados para a tabela
    const tableData = data.map(item => [
        item.prato.nome,
        item.total_favoritos.toString(),
        item.prato.descricao
    ]);

    // Criar tabela usando autoTable
    autoTable(doc, {
        startY: 30,
        head: [['Nome do Prato', 'Total Favoritos', 'Descrição']],
        body: tableData,
        theme: 'grid',
        styles: {
            fontSize: 10,
            cellPadding: 3,
            overflow: 'linebreak',
            halign: 'left'
        },
        headStyles: {
            fillColor: [66, 66, 66],
            textColor: 255,
            fontStyle: 'bold'
        },
        alternateRowStyles: {
            fillColor: [245, 245, 245]
        },
        columnStyles: {
            0: { cellWidth: 70 },
            1: { cellWidth: 40, halign: 'center' },
            2: { cellWidth: 80 }
        }
    });

    // Adiciona total de pratos
    const finalY = doc.lastAutoTable.finalY || 30;
    doc.setFont('helvetica', 'bold');
    doc.text(`Total de pratos: ${data.length}`, 15, finalY + 15);

    // Adicionar rodapé com número de páginas
    const pageCount = doc.internal.getNumberOfPages();
    for (let i = 1; i <= pageCount; i++) {
        doc.setPage(i);
        doc.setFontSize(10);
        doc.text(`Página ${i} de ${pageCount}`, doc.internal.pageSize.width - 20, doc.internal.pageSize.height - 10);
    }

    // Salva documento PDF
    doc.save(`relatorio_${categoryTitle.toLowerCase().replace(/\s+/g, '_')}.pdf`);
}

/**
 * Gera e faz download de um arquivo PDF contendo relatório de reservas.
 *
 * O PDF gerado inclui:
 * - Título do relatório
 * - Data e hora de geração
 * - Tabela com dados das reservas (total, confirmadas, pendentes, canceladas)
 *
 * @function exportReservationsToPDF
 * @param {Object} data - Dados das reservas
 * @param {string} reportTitle - Título do relatório
 */
function exportReservationsToPDF(data, reportTitle) {
    const doc = new jsPDF();

    // Adiciona título centralizado
    doc.setFontSize(20);
    const title = `Relatório de ${reportTitle}`;
    const pageWidth = doc.internal.pageSize.width;
    const titleWidth = doc.getStringUnitWidth(title) * doc.internal.getFontSize() / doc.internal.scaleFactor;
    const titleX = (pageWidth - titleWidth) / 2;
    doc.text(title, titleX, 20);

    // Adiciona data e hora no topo direito
    doc.setFontSize(10);
    const now = new Date();
    const dataHora = `Data: ${now.toLocaleDateString('pt-BR')} - Hora: ${now.toLocaleTimeString('pt-BR')}`;
    const dataWidth = doc.getStringUnitWidth(dataHora) * doc.internal.getFontSize() / doc.internal.scaleFactor;
    doc.text(dataHora, pageWidth - dataWidth - 10, 10);

    // Preparar dados para a tabela
    const tableData = [data.map(item => item.split(': ')[1])];

    // Criar tabela usando autoTable
    autoTable(doc, {
        startY: 30,
        head: [['Total', 'Confirmadas', 'Pendentes', 'Canceladas']],
        body: tableData,
        theme: 'grid',
        styles: {
            fontSize: 10,
            cellPadding: 3,
            overflow: 'linebreak',
            halign: 'center'
        },
        headStyles: {
            fillColor: [66, 66, 66],
            textColor: 255,
            fontStyle: 'bold'
        },
        alternateRowStyles: {
            fillColor: [245, 245, 245]
        },
        columnStyles: {
            0: { cellWidth: 'auto' },
            1: { cellWidth: 'auto' },
            2: { cellWidth: 'auto' },
            3: { cellWidth: 'auto' }
        }
    });

    // Adicionar rodapé com número de páginas
    const pageCount = doc.internal.getNumberOfPages();
    for (let i = 1; i <= pageCount; i++) {
        doc.setPage(i);
        doc.setFontSize(10);
        doc.text(`Página ${i} de ${pageCount}`, doc.internal.pageSize.width - 20, doc.internal.pageSize.height - 10);
    }

    // Salva documento PDF
    const fileName = `relatorio_${reportTitle.toLowerCase().replace(/\s+/g, '_')}.pdf`;
    doc.save(fileName);
}

/**
 * Gera e faz download de um arquivo PDF contendo relatório detalhado de um cliente.
 *
 * O PDF gerado inclui:
 * - Título do relatório
 * - Data e hora de geração
 * - Informações pessoais do cliente (nome, email, telefone)
 * - Tabela com histórico de reservas do cliente
 * - Número de páginas no rodapé
 *
 * @function exportClientToPDF
 * @description Exporta as informações do cliente e seu histórico de reservas para um arquivo PDF
 * @example
 * // Chamada da função ao clicar no botão de exportar
 * <button onclick="exportClientToPDF()">Exportar PDF</button>
 */
function exportClientToPDF() {
    // Inicializar jsPDF
    const doc = new jsPDF();

    // Configurar fonte e tamanho
    doc.setFont('helvetica');

    // Adicionar título centralizado
    doc.setFontSize(20);
    const title = 'Relatório Cliente';
    const pageWidth = doc.internal.pageSize.width;
    const titleWidth = doc.getStringUnitWidth(title) * doc.internal.getFontSize() / doc.internal.scaleFactor;
    const titleX = (pageWidth - titleWidth) / 2;
    doc.text(title, titleX, 20);

    // Adicionar data e hora no topo direito
    doc.setFontSize(10);
    const now = new Date();
    const dataHora = `Data: ${now.toLocaleDateString('pt-BR')} - Hora: ${now.toLocaleTimeString('pt-BR')}`;
    const dataWidth = doc.getStringUnitWidth(dataHora) * doc.internal.getFontSize() / doc.internal.scaleFactor;
    doc.text(dataHora, pageWidth - dataWidth - 10, 10);

    // Adicionar informações do cliente
    doc.setFontSize(12);
    const clientName = document.querySelector('.user-name').textContent.split(': ')[1];
    const clientEmail = document.querySelector('.user-email').textContent.split(': ')[1];
    const clientPhone = document.querySelector('.user-phone').textContent;

    doc.text(`Nome: ${clientName}`, 14, 35);
    doc.text(`Email: ${clientEmail}`, 14, 45);
    doc.text(`Telefone: ${clientPhone}`, 14, 55);

    // Criar tabela no PDF usando autoTable diretamente
    autoTable(doc, {
        startY: 65,
        head: [['ID', 'Data', 'Hora', 'Qtd. Pessoas', 'Status']],
        body: Array.from(document.querySelectorAll('.reservas-tabela tbody tr')).map(row => {
            const cells = row.getElementsByTagName('td');
            return [
                cells[0].textContent,
                cells[1].textContent,
                cells[2].textContent,
                cells[3].textContent,
                cells[4].textContent
            ];
        }),
        theme: 'grid',
        styles: {
            fontSize: 10,
            cellPadding: 3,
            overflow: 'linebreak',
            halign: 'center'
        },
        headStyles: {
            fillColor: [66, 66, 66],
            textColor: 255,
            fontStyle: 'bold'
        },
        alternateRowStyles: {
            fillColor: [245, 245, 245]
        }
    });

    // Adicionar rodapé
    const pageCount = doc.internal.getNumberOfPages();
    for (let i = 1; i <= pageCount; i++) {
        doc.setPage(i);
        doc.setFontSize(10);
        doc.text(`Página ${i} de ${pageCount}`, doc.internal.pageSize.width - 20, doc.internal.pageSize.height - 10);
    }

    // Salvar o PDF
    const fileName = `cliente_${clientName.replace(/\s+/g, '_')}_reservas.pdf`;
    doc.save(fileName);
}

window.exportClientToPDF = exportClientToPDF;
