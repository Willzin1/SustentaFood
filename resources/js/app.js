import './bootstrap';

import inputCustom from './modules/reservas/customInput';
import horas from './modules/reservas/horas';
import data from './modules/reservas/data';
import scrollButtons from './components/scrollButtons';
import './modules/validation/formUserValidator';

function init() {
    scrollButtons();
    horas();
    data();

    document.getElementById('quantidade_cadeiras')
        ?.addEventListener('change', inputCustom);
}

document.addEventListener("DOMContentLoaded", () => {
    init();
});
