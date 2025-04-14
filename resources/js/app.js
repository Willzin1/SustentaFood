import './bootstrap';

import horas from './modules/reservas/horas';
import data from './modules/reservas/data';
import scrollButtons from './components/scrollButtons';
import './modules/validation/ValidaUserFormulario';
import './modules/validation/ValidarReservaForm';
import './modules/validation/ValidaPratoForm';
import fetchSearch from './modules/fetchReservations';

function init() {
    scrollButtons();
    horas();
    data();
    fetchSearch();

}

document.addEventListener("DOMContentLoaded", () => {
    init();
});
