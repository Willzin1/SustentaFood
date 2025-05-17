import createLoadingDiv from '../modules/utils/createLoadingDiv';
import formatDate from '../modules/utils/formatDate';
import { token, urlApi, urlStorageApi } from '../global/globalVariables';

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

        try {
            const response = await axios.get(getRightEndpoint(pathname) , {
                headers: {
                    Authorization: `Bearer ${token}`
                },
                params: { search, filter },
                withCredentials: true
            });

            if ((response.data.data ? response.data.data : response.data.reservas.data.length) <= 0) {
                alert('Nenhuma reserva encontrada!');
                return;
            }

            changeTable((response.data.data ? response.data.data : response.data.reservas.data), 'reservas');
        } catch (e) {
            alert('Erro inesperado, tente novamente!');
            console.log(e);
        } finally {
            loadingDiv.remove();
        }
    });
}

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
                alert('Nenhum prato encontrado!');
                return
            }

            changeTable(response.data.data, 'pratos');
        } catch (e) {
            alert('Erro inesperado, tente novamente!');
        } finally {
            loadingDiv.remove();
        }
    });
}

function changeTable(data, type) {
    let tbody = document.querySelector('tbody');

    if (!tbody) return;

    tbody.innerHTML = '';

    if (!data || data.length === 0) {
        // let row = document.createElement('tr');
        // let cell = document.createElement('td');
        // cell.colSpan = type === 'reservas' ? 6 : 5; // 6 colunas pra reservas, 5 pra pratos
        // cell.textContent = type === 'reservas' ? 'Nenhuma reserva encontrada.' : 'Nenhum prato encontrado.';
        // cell.style.textAlign = 'center';
        // row.appendChild(cell);
        // tbody.appendChild(row);

        return;
    }

    data.forEach(item => {
        let row = document.createElement('tr');

        if (type === 'reservas') {
            row.innerHTML = `
                <td>${item.id}</td>
                ${item.user ? `<td><a href="/admin/users/${item.user.id}">${item.user.name}</a></td>` : `<td>${item.name}</td>`}
                <td>${formatDate(item.data)}</td>
                <td>${item.hora}</td>
                <td>${item.quantidade_cadeiras}</td>
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

function getRightEndpoint(actualPath) {
    let baseApiUrl = urlApi;

    const routes = {
        '/reservas': `${baseApiUrl}/reservas`,
        '/reservas/dia': `${baseApiUrl}/relatorios/reservas/dia`,
        '/reservas/semana': `${baseApiUrl}/relatorios/reservas/semana`,
        '/reservas/mes': `${baseApiUrl}/relatorios/reservas/mes`,
    };

    for (const path in routes) {
        if (actualPath.includes(path)) {
            baseApiUrl = routes[path];
            break;
        }
    }

    return baseApiUrl;
}

function formatDateToApi(date) {
    const [day, month, year] = date.split('/');
    return `${year}-${month}-${day}`;
}
