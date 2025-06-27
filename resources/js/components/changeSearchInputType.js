export default function changeSearchInputType() {
    document.addEventListener('change', function() {
        const filterSelect = document.getElementById('filter');
        let searchInput = document.getElementById('searchInput');

        updateInputType(filterSelect, searchInput);
    });

    function updateInputType(filterSelect, searchInput) {
        if (filterSelect.value === 'Data') {
            searchInput.type = 'date';
        } else {
            searchInput.type = 'search';
            searchInput.placeholder = 'Busque uma reserva (ex: ID, Nome cliente, Data, Hora)';
        }
    }
}

changeSearchInputType();
