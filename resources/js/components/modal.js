export default function initCancelModal() {
    const modal = document.getElementById('cancelModal');
    const cancelButtons = document.querySelectorAll('.button-link');
    const closeBtn = document.querySelector('.close');
    const cancelBtn = document.querySelector('.btn-cancel');
    const cancelForm = document.getElementById('cancelForm');

    // Open modal when cancel button is clicked
    cancelButtons.forEach(button => {
        button.addEventListener('click', () => {
                // const form = button.closest('form');
                modal.style.display = 'block';
                // cancelForm.action = form.action;
        });
    });

    // Close modal when X is clicked
    closeBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    // Close modal when cancel button is clicked
    cancelBtn.addEventListener('click', () => {
        modal.style.display = 'none';
    });

    // Close modal when clicking outside
    window.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.style.display = 'none';
        }
    });

}
