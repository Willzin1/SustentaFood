/**
 * Converte uma data ISO para o formato brasileiro (dd/mm/aaaa).
 * 
 * @function formatDate
 * @param {string} dataISO - Data em formato ISO (YYYY-MM-DD)
 * @returns {string} Data formatada no padrão brasileiro
 * 
 * @example
 * const data = formatDate('2024-03-20');
 * // Retorna: '20/03/2024'
 */
export default function formatDate(dataISO) {
    const data = new Date(dataISO);
    return data.toLocaleDateString('pt-BR');
}
