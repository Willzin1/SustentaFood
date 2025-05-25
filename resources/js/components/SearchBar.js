import createLoadingDiv from '../modules/utils/createLoadingDiv';
import formatDate from '../modules/utils/formatDate';
import { token, urlApi, urlStorageApi } from '../global/globalVariables';

/**
 * Ativa a funcionalidade de busca de reservas no painel do gerente.
 *
 * Dispara uma requisição GET para o endpoint correto com base no filtro selecionado (por nome, status, data etc.)
 * e atualiza a tabela com os resultados da busca.
 *
 * @function searchReservations
 * @returns {void}
 */
export function searchReservations() {
    let searchBtn = document.querySelector('.btnBusca');

    if (!searchBtn) return;

    searchBtn.addEventListener('click', async () => {
        let search = document.querySelector('input[name="search"]').value;
        let filter = document.querySelector('select[name="filter"]').value;
        const loadingDiv = createLoadingDiv(document.querySelector('.containerGerente'), 'Buscando reservas...');

        if (filter === 'Data' && search) {
            search = formatDateToApi(search);
        }

        const pathname = window.location.pathname;
        const endpoint = getRightEndpoint(pathname);

        try {
            const response = await axios.get(endpoint, {
                headers: {
                    Authorization: `Bearer ${token}`
                },
                params: { search, filter },
                withCredentials: true
            });

            const reservas = response.data.data ? response.data.data : response.data.reservas.data;

            if (reservas.length <= 0) {
                toastr.warning('Nenhuma reserva encontrada!');
                return;
            }

            changeTable(reservas, 'reservas');
        } catch (e) {
            toastr.warning('Erro inesperado, tente novamente!');
            console.error(e);
        } finally {
            loadingDiv.remove();
        }
    });
}

/**
 * Ativa a funcionalidade de busca de pratos no painel do gerente.
 *
 * Dispara uma requisição GET para o endpoint de cardápio usando os parâmetros de busca e filtro selecionados.
 * Atualiza a tabela com os pratos encontrados.
 *
 * @function searchDishes
 * @returns {void}
 */
export function searchDishes() {
    let searchBtn = document.querySelector('.btnBuscaDish');

    if (!searchBtn) return;

    searchBtn.addEventListener('click', async () => {
        let search = document.querySelector('input[name="search"]').value;
        let filter = document.querySelector('select[name="filter"]').value;
        const loadingDiv = createLoadingDiv(document.querySelector('.containerGerente'), 'Buscando pratos...');

        try {
            const response = await axios.get(`${urlApi}/cardapio`, {
                headers: {
                    Authorization: `Bearer ${token}`
                },
                params: { search, filter },
                withCredentials: true
            });

            if (response.data.data.length <= 0) {
                toastr.warning('Nenhum prato encontrado!');
                return;
            }

            changeTable(response.data.data, 'pratos');
        } catch (e) {
            toastr.error('Erro inesperado, tente novamente!');
            console.error(e);
        } finally {
            loadingDiv.remove();
        }
    });
}

/**
 * Atualiza o conteúdo da tabela com os dados fornecidos (reservas ou pratos).
 *
 * @param {Array} data - Lista de objetos (reservas ou pratos)
 * @param {string} type - Tipo de dado ("reservas" ou "pratos") para determinar estrutura das colunas
 *
 * @function changeTable
 * @returns {void}
 */
function changeTable(data, type) {
    let tbody = document.querySelector('tbody');

    if (!tbody) return;

    tbody.innerHTML = '';

    if (!data || data.length === 0) return;

    data.forEach(item => {
        let row = document.createElement('tr');

        if (type === 'reservas') {
            row.innerHTML = `
                <td>${item.id}</td>
                ${item.user ? `<td><a href="/admin/users/${item.user.id}">${item.user.name}</a></td>` : `<td>${item.name}</td>`}
                <td>${formatDate(item.data)}</td>
                <td>${item.hora}</td>
                <td>${item.quantidade_cadeiras}</td>
                <td>${item.status}</td>
                <td><a href="/admin/reservas/${item.id}/edit">Gerenciar reserva</a></td>
            `;
        } else if (type === 'pratos') {
            row.innerHTML = `
                <td><img src="${urlStorageApi}/${item.imagem}" alt="${item.nome}" width="50"></td>
                <td>${item.nome}</td>
                <td>${item.descricao}</td>
                <td>${item.categoria}</td>
                <td>
                    <a href="/admin/cardapio/${item.id}/edit" class="btn btn-warning">Editar</a>
                    <form action="/admin/cardapio/${item.id}" method="POST" style="display:inline;">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                        <button class="btn btn-danger">Excluir</button>
                    </form>
                </td>
            `;
        }

        tbody.appendChild(row);
    });
}

/**
 * Define o endpoint correto com base na URL atual da página.
 *
 * @param {string} actualPath - Caminho atual do navegador (window.location.pathname)
 * @returns {string} - URL do endpoint correspondente
 *
 * @function getRightEndpoint
 */
function getRightEndpoint(actualPath) {
    let baseApiUrl = urlApi;

    const routes = [
        { path: '/reservas/dia', endpoint: `${baseApiUrl}/relatorios/reservas/dia` },
        { path: '/reservas/semana', endpoint: `${baseApiUrl}/relatorios/reservas/semana` },
        { path: '/reservas/mes', endpoint: `${baseApiUrl}/relatorios/reservas/mes` },
        { path: '/reservas', endpoint: `${baseApiUrl}/reservas` }
    ];

    const matchedRoute = routes.find(route => actualPath.includes(route.path));
    return matchedRoute ? matchedRoute.endpoint : baseApiUrl;
}

/**
 * Converte a data do formato brasileiro (dd/mm/yyyy) para o formato da API (yyyy-mm-dd).
 *
 * @param {string} date - Data no formato dd/mm/yyyy
 * @returns {string} - Data no formato yyyy-mm-dd
 *
 * @function formatDateToApi
 */
function formatDateToApi(date) {
    const [day, month, year] = date.split('/');
    return `${year}-${month}-${day}`;
}
