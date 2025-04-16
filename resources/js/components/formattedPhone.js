export default function formattedPhone() {
    const phoneUser = document.querySelector('.phoneUser');

    if (!phoneUser) return;

    const text = phoneUser.textContent.replace(/\D/g, '');
    const formattedPhone = text.replace(
        /^(\d{2})(\d{5})(\d{4})$/,
        '($1) $2-$3'
    )

    phoneUser.innerHTML = `<strong>Telefone: </strong>${formattedPhone}`;
}

formattedPhone();
