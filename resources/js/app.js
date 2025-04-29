import './bootstrap';

import './modules/utils/reservas/horas';
import './modules/utils/reservas/data';
import './components/Masks';
import './modules/validation/ValidaUserFormulario';
import './modules/validation/ValidarReservaForm';
import './modules/validation/ValidaPratoForm';
import'./modules/utils/resetSearchInput';
import './components/formattedPhone';
import scrollButtons from './components/scrollButtons';
import { searchReservations, searchDishes } from './components/SearchBar';

function init() {
    scrollButtons();
    searchReservations();
    searchDishes();
}

document.addEventListener("DOMContentLoaded", () => {
    init();
});
