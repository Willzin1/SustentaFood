import { token, urlApi } from "../global/globalVariables";

export async function getSettings() {

    if (!token) return;

    const res = await axios.get(`${urlApi}/settings`, {
        headers: { 'Authorization': `Bearer ${token}` }
    });

    return res.data;
}

export async function getMaxCapacity() {

    if (!token) return;

    const res = await axios.get(`${urlApi}/settings/max-capacity`, {
        headers: { 'Authorization': `Bearer ${token}` }
    });

    return res.data;
}

export async function getReservationStatus() {

    if (!token) return;

    const res = await axios.get(`${urlApi}/settings/reservation-status`, {
        headers: { 'Authorization': `Bearer ${token}` }
    });

    return res.data;
}

export async function pauseReservations() {

    if (!token) return;

    const res = await axios.post(`${urlApi}/settings/pause-reservations`, {}, {
        headers: { 'Authorization': `Bearer ${token}` }
    });

    toastr.success('Reservas pausadas com sucesso');
    updateReservationButton(true);
    // window.location.reload();
    return res.data;
}

export async function unpauseReservations() {
    const res = await axios.post(`${urlApi}/settings/unpause-reservations`, {}, {
        headers: { 'Authorization': `Bearer ${token}` }
    });

    toastr.success('Reservas retomadas com sucesso');
    updateReservationButton(false);
    // window.location.reload();
    return res.data;
}

function updateReservationButton(isPaused) {

    if (!token) return;

    const button = document.querySelector('.reservation-status-btn');
    if (button) {
        if (isPaused) {
            button.textContent = 'Retomar novas reservas';
            button.onclick = unpauseReservations;
            button.classList.add('paused');
        } else {
            button.textContent = 'Pausar novas reservas';
            button.onclick = pauseReservations;
            button.classList.remove('paused');
        }
    }
}

// Initialize button state when page loads
export async function initReservationButton() {
    try {
        const status = await getSettings();
        updateReservationButton(status.reservas_pausadas);
    } catch (error) {
        console.error('Error getting reservation status:', error);
    }
}

window.pauseReservations = pauseReservations;
window.unpauseReservations = unpauseReservations;
window.initReservationButton = initReservationButton;
