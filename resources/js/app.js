import './bootstrap';

import './modules/utils/reservas/horas';
import './modules/utils/reservas/data';
import './components/Masks';
import './modules/validation/ValidaUserFormulario';
import './modules/validation/ValidarReservaForm';
import './modules/validation/ValidaPratoForm';
import'./modules/utils/resetSearchInput';
import './modules/utils/formattedPhone';

import scrollButtons from './modules/utils/scrollButtons';
import { searchReservations, searchDishes } from './components/SearchBar';
import relatorioReservas from './components/relatorioReservas';
import initFavorite from './components/toggleFavorite';
import favoriteDishes from './components/favoriteDishes';

function init() {
    scrollButtons();
    searchReservations();
    searchDishes();
    relatorioReservas();
    initFavorite();
}

document.addEventListener("DOMContentLoaded", async () => {
    init();
    favoriteDishes();
});
