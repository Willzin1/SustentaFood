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
import initCancelModal, { modalMaxCapacity } from './components/modal';
import { getSettings, getMaxCapacity } from './components/settings';
import changeSearchInputType from './components/changeSearchInputType';

function init() {
    scrollButtons();
    searchReservations();
    searchDishes();
    relatorioReservas();
    initFavorite();
    favoriteDishes();
    initCancelModal();
    modalMaxCapacity();
    getSettings();
    getMaxCapacity();
    changeSearchInputType();
}

document.addEventListener("DOMContentLoaded", async () => {
    init();
});

if ('serviceworker' in navigator) {
    navigator.serviceWorker.register('/sw.js', {
        scope: '/'
    }).then(registration => {
        console.log('Service Worker registered with scope:', registration.scope);
    }).catch(error => {
        console.error('Service Worker registration failed:', error);
    });
}
