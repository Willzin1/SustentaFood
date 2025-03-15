$(document).ready(function() {
    $('#mobile_btn').on('click', function () {
        $('#mobile_menu').toggleClass('active');
        $('#mobile_btn').find('i').toggleClass('fa-x');
    });

    const sections = $('section');
    const navItems = $('.nav-item');

    $(window).on('scroll', function () {
        const header = $('header');
        const scrollPosition = $(window).scrollTop() - header.outerHeight();

        let activeSectionIndex = 0;

        if (scrollPosition <= 0) {
            header.css('box-shadow', 'none');
        } else {
            header.css('box-shadow', '5px 1px 5px rgba(0, 0, 0, 0.1');
        }

        sections.each(function(i) {
            const section = $(this);
            const sectionTop = section.offset().top - 96;
            const sectionBottom = sectionTop+ section.outerHeight();

            if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
                activeSectionIndex = i;
                return false;
            }
        })

        navItems.removeClass('active');
        $(navItems[activeSectionIndex]).addClass('active');
    });

    ScrollReveal().reveal('#cta', {
        origin: 'left',
        duration: 2000,
        distance: '20%'
    });

    ScrollReveal().reveal('.prato', {
        origin: 'left',
        duration: 2000,
        distance: '20%'
    });

    ScrollReveal().reveal('#testimonial_chef', {
        origin: 'left',
        duration: 1000,
        distance: '20%'
    })

    ScrollReveal().reveal('.feedback', {
        origin: 'right',
        duration: 1000,
        distance: '20%'
    })
});

$(document).ready(function() { /* FUNÇÃO DE GIRO DOS CARDS DE FAVORITO, FAVOR, NÃO MEXER*/
    $('.prato').click(function() {
        $(this).toggleClass('active'); // Ativa ou desativa a rotação
    });
});


// SEPARAR

let totalAssentos = 90;
let reservas = [];

document.addEventListener('DOMContentLoaded', function() {
    flatpickr("#data", {
        locale: "pt", // Define o idioma como português
        disable: [
            function(date) {
                return (date.getDay() === 1); // Desabilita segundas-feiras
            }
        ],
        minDate: "today"
    });

    // Configura o campo de hora
    const horaInput = document.getElementById('hora');
    for (let h = 9; h <= 20; h++) { // Hora de 9h até 20h30
        for (let m = 0; m <= 30; m += 30) {
            const timeOption = `${h}:${m.toString().padStart(2, '0')}`;
            const option = document.createElement('option');
            option.value = timeOption;
            option.textContent = timeOption;
            horaInput.appendChild(option);
        }
    }
});

export function validarReserva() {
    const dataInput = document.getElementById('data').value;
    const horaInput = document.getElementById('hora').value;
    const quantidadeCadeirasInput = document.getElementById('quantidade_cadeiras').value;

    const reservasDataHora = reservas.filter(reserva => reserva.data === dataInput && reserva.hora === horaInput);
    const cadeirasOcupadas = reservasDataHora.reduce((total, reserva) => total + reserva.quantidade_cadeiras, 0);

    const quantidadeSolicitada = quantidadeCadeirasInput === 'mais' ? parseInt(document.getElementById('custom_assentos').value) : parseInt(quantidadeCadeirasInput);

    if (quantidadeSolicitada + cadeirasOcupadas > totalAssentos) {
        alert('Número total de assentos excede a disponibilidade.');
        return false;
    }

    return true;
}

export function adicionarReserva() {
    const dataInput = document.getElementById('data').value;
    const horaInput = document.getElementById('hora').value;
    const quantidadeCadeirasInput = document.getElementById('quantidade_cadeiras').value;

    const quantidadeSolicitada = quantidadeCadeirasInput === 'mais' ? parseInt(document.getElementById('custom_assentos').value) : parseInt(quantidadeCadeirasInput);

    reservas.push({
        data: dataInput,
        hora: horaInput,
        quantidade_cadeiras: quantidadeSolicitada
    });
}

export function mostrarInputCustomizado() {
    const quantidadeCadeirasSelect = document.getElementById('quantidade_cadeiras');
    const customInput = document.getElementById('custom_assentos');

    if (quantidadeCadeirasSelect.value === 'mais') {
        customInput.classList.remove('hidden');  // Torna o input visível
        customInput.setAttribute("name", "quantidade_cadeiras"); // Permite que o valor seja enviado no formulário
        quantidadeCadeirasSelect.removeAttribute("name"); // Remove o nome do select para evitar duplicidade
    } else {
        customInput.classList.add('hidden'); // Oculta o input
        customInput.value = ""; // Limpa o campo
        customInput.removeAttribute("name"); // Remove o nome do input personalizado
        quantidadeCadeirasSelect.setAttribute("name", "quantidade_cadeiras"); // Restaura o nome do select
    }
}

// Garante que a função seja chamada ao mudar o select
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('quantidade_cadeiras').addEventListener('change', mostrarInputCustomizado);
});
