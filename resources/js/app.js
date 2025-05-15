import dotenv from 'dotenv';

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
import relatorioReservas from './components/RelatorioReservas';

function init() {
    scrollButtons();
    searchReservations();
    searchDishes();
    relatorioReservas();
}

document.addEventListener("DOMContentLoaded", async () => {
    init();
});
