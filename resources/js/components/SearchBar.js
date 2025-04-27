import createLoadingDiv from '../modules/utils/createLoadingDiv';
import formatDate from '../modules/utils/formatDate';

export function searchReservations() {
    let searchBtn = document.querySelector('.btnBusca');

    if (!searchBtn) return;

    searchBtn.addEventListener('click', async () => {
        let search = document.querySelector('input[name="search"]').value;
        let filter = document.querySelector('select[name="filter"]').value;
        const loadingDiv = createLoadingDiv(document.querySelector('.containerGerente'), 'Buscando reservas...');

        try{
            const response = await axios.get('http://localhost:3030/api/reservas', {
                params: { search, filter },
                withCredentials: true
            });

            changeTable(response.data.data, 'reservas');
        }catch (e){
            alert('Erro inesperado, tente novamente!');
            console.log(e)
        }finally{
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
        const loadingDiv = createLoadingDiv(document.querySelector('.containerGerente'), 'Buscando reservas...');

        try{
            const response = await axios.get('http://localhost:3030/api/cardapio', {
                params: { search, filter },
                withCredentials: true
            });

            changeTable(response.data.data, 'pratos');
        }catch (e){
            alert('Erro inesperado, tente novamente!');
            console.log(e)
        }finally{
            loadingDiv.remove();
        }
    });
}
function changeTable(data, type) {
    let tbody = document.querySelector('tbody');
    tbody.innerHTML = '';

    if (!data || data.length === 0) {
        let row = document.createElement('tr');
        let cell = document.createElement('td');
        cell.colSpan = type === 'reservas' ? 6 : 5; // 6 colunas pra reservas, 5 pra pratos
        cell.textContent = type === 'reservas' ? 'Nenhuma reserva encontrada.' : 'Nenhum prato encontrado.';
        cell.style.textAlign = 'center';
        row.appendChild(cell);
        tbody.appendChild(row);
        return;
    }

    data.forEach(item => {
        let row = document.createElement('tr');

        if (type === 'reservas') {
            row.innerHTML = `
                <td>${item.id}</td>
                <td><a href="/admin/users/${item.user.id}">${item.user.name}</a></td>
                <td>${formatDate(item.data)}</td>
                <td>${item.hora}</td>
                <td>${item.quantidade_cadeiras}</td>
                <td><a href="/admin/reservas/${item.id}/edit">Gerenciar reserva</a></td>
            `;
        } else if (type === 'pratos') {
            row.innerHTML = `
                <td><img src="http://localhost:3030/storage/${item.imagem}" alt="${item.nome}" width="50"></td>
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

