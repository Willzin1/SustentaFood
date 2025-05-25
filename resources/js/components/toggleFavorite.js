import { token, urlApi } from "../global/globalVariables";

/**
 * Carrega os pratos favoritos do usuário autenticado e marca os ícones de coração como "ativos".
 *
 * Requisição GET ao endpoint /favoritos, usando o token de autenticação.
 * Os pratos encontrados terão seus ícones atualizados com a classe `active`.
 *
 * @async
 * @function loadFavorites
 * @returns {Promise<void>}
 */
async function loadFavorites() {
    if (!token) return;

    try {
        const response = await axios.get(`${urlApi}/favoritos`, {
            headers: {
                'Authorization': `Bearer ${token}`
            }
        });

        const favorites = response.data.favorites;

        favorites.forEach(favorite => {
            const heartIcon = document.querySelector(`.dish-heart[data-prato-id="${favorite.prato_id}"]`);
            if (heartIcon) {
                heartIcon.classList.add('active');
            }
        });
    } catch (error) {
        toastr.error('Erro ao carregar favoritos');
    }
}

/**
 * Alterna o status de favorito de um prato (favoritar ou desfavoritar).
 *
 * - Se já for favorito, envia requisição DELETE e remove classe `active`.
 * - Se ainda não for favorito, envia requisição POST e adiciona classe `active`.
 *
 * Também trata erros de autenticação (redireciona para login se necessário).
 *
 * @async
 * @function handleToggleFavorite
 * @param {number} pratoId - ID do prato a ser favoritado/desfavoritado
 * @returns {Promise<void>}
 */
async function handleToggleFavorite(pratoId) {
    try {
        const heartIcon = document.querySelector(`.dish-heart[data-prato-id="${pratoId}"]`);
        const isFavorited = heartIcon?.classList.contains('active');

        let response;

        if (isFavorited) {
            response = await axios.delete(`${urlApi}/favoritos/${pratoId}`, {
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            });

            toastr.warning('Prato removido dos favoritos');
        } else {
            response = await axios.post(`${urlApi}/favoritos/${pratoId}`, {}, {
                headers: {
                    'Authorization': `Bearer ${token}`
                }
            });
        }

        if (response.status === 200 || response.status === 201) {
            if (heartIcon) {
                heartIcon.classList.toggle('active');
                toastr.success(isFavorited ? 'Prato removido dos favoritos' : 'Prato adicionado aos favoritos');
            }
        }
    } catch (error) {
        if (error.response?.status === 401) {
            toastr.error('Faça login para favoritar um prato');
            window.location.href = '/login';
            return;
        }

        toastr.error('Erro ao favoritar prato');
    }
}

/**
 * Inicializa o sistema de favoritos.
 *
 * - Carrega pratos favoritos do usuário autenticado.
 * - Expõe a função `toggleFavorite` globalmente para ser usada em eventos onclick nos ícones.
 *
 * @function initFavorites
 * @returns {void}
 */
export default function initFavorites() {
    loadFavorites();
    window.toggleFavorite = handleToggleFavorite;
}
