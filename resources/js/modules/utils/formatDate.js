export default function formatDate(dataISO) {
    const data = new Date(dataISO);
    return data.toLocaleDateString('pt-BR');
}
