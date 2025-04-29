export default (function() {
    const horaInput = document.getElementById('hora');

    if (!horaInput) return;

    for (let h = 10; h <= 22; h++) { // Hora de 9h até 20h30
        // for (let m = 0; m <= 30; m += 30) {
            let m = 0;
            const timeOption = `${h}:${m.toString().padStart(2, '0')}`;
            const option = document.createElement('option');
            option.value = timeOption;
            option.textContent = timeOption;
            horaInput.classList.add('validar');
            horaInput.classList.add('horaRes');
            horaInput.appendChild(option);
        // }
    }
})();
