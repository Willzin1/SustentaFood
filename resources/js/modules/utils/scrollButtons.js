/**
 * Inicializa funcionalidades de scroll e animações da página.
 * Inclui:
 * - Controle do menu mobile
 * - Sombra do header baseada no scroll
 * - Navegação ativa baseada na seção visível
 * - Animações de reveal dos elementos
 * 
 * @function initScrollAndAnimations
 * @requires jQuery
 * @requires ScrollReveal
 * @returns {void}
 */
export default function() {
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
}

// $(document).ready(function() { /* FUNÇÃO DE GIRO DOS CARDS DE FAVORITO, FAVOR, NÃO MEXER*/
//     $('.prato').click(function() {
//         $(this).toggleClass('active'); // Ativa ou desativa a rotação
//     });
// });
