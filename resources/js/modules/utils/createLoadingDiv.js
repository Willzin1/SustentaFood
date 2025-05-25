/**
 * Cria e retorna um elemento div de loading com texto personalizado.
 * 
 * @function createLoadingDiv
 * @param {HTMLElement} div - Elemento pai onde o div de loading será anexado
 * @param {string} texto - Texto a ser exibido no div de loading
 * @returns {HTMLElement} Elemento div de loading criado
 * 
 * @example
 * const container = document.querySelector('.container');
 * const loading = createLoadingDiv(container, 'Carregando...');
 */
export default function createLoadingDiv(div, texto) {
    let loadingDiv = document.createElement('div');

    loadingDiv.classList.add('loading');
    loadingDiv.textContent = texto;
    loadingDiv.style.display = 'block';

    div.appendChild(loadingDiv);

    return loadingDiv;
}
