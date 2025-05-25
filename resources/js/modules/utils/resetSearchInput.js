/**
 * Inicializa o comportamento do botão de limpar filtros.
 * Quando clicado, limpa o campo de busca e reseta o select de filtros.
 * 
 * @function resetSearchInput
 * @returns {void}
 * 
 * @example
 * // O botão deve ter a classe 'clearFilters'
 * // O input de busca deve ter a classe 'search'
 * // O select de filtros deve ter a classe 'filterSelect'
 * resetSearchInput();
 */
export default function resetSearchInput() {

    const clearFiltersBtn = document.querySelector('.clearFilters');

    if (!clearFiltersBtn) return;

    clearFiltersBtn.addEventListener('click', e => {
        const searchInput = document.querySelector('.search');
        const filterSelect = document.querySelector('.filterSelect');

        searchInput.value = '';
        filterSelect.selectedIndex = 0;
    });
}

resetSearchInput();
