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
    initCancelModal();
}

document.addEventListener("DOMContentLoaded", async () => {
    init();
    favoriteDishes();
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



function initCancelModal() {
    const modal = document.getElementById('cancelModal');
    const cancelButtons = document.querySelectorAll('.button-link');
    const closeBtn = document.querySelector('.close');
    const cancelBtn = document.querySelector('.btn-cancel');
    const cancelForm = document.getElementById('cancelForm');

    // Open modal when cancel button is clicked
    cancelButtons.forEach(button => {
        button.addEventListener('click', () => {
                // const form = button.closest('form');
                modal.style.display = 'block';
                // cancelForm.action = form.action;
        });
    });

    // Close modal when X is clicked
    closeBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    // Close modal when cancel button is clicked
    cancelBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    // Close modal when clicking outside
    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });

}
