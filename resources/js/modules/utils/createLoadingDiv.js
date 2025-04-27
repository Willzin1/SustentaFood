export default function createLoadingDiv(div, texto) {
    let loadingDiv = document.createElement('div');

    loadingDiv.classList.add('loading');
    loadingDiv.textContent = texto;
    loadingDiv.style.display = 'block';

    div.appendChild(loadingDiv);

    return loadingDiv;
}
