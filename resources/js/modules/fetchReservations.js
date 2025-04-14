export default function fetchSearch() {

    const clearFiltersBtn = document.querySelector('.clearFilters');

    clearFiltersBtn.addEventListener('click', e => {
        const searchInput = document.querySelector('.search');
        const filterSelect = document.querySelector('.filterSelect');

        searchInput.value = '';
        filterSelect.selectedIndex = 0;
    });
}
