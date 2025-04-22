import './bootstrap';

import horas from './modules/reservas/horas';
import data from './modules/reservas/data';
import scrollButtons from './components/scrollButtons';
import './components/Masks';
import './modules/validation/ValidaUserFormulario';
import './modules/validation/ValidarReservaForm';
import './modules/validation/ValidaPratoForm';
import'./modules/utils/resetSearchInput';
import './components/formattedPhone';

function init() {
    scrollButtons();
    horas();
    data();
}

document.addEventListener("DOMContentLoaded", () => {
    init();
});
