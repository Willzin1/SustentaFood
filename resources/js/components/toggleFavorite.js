import { token, urlApi } from "../global/globalVariables";

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

export default function initFavorites() {
    loadFavorites();
    
    window.toggleFavorite = handleToggleFavorite;
}