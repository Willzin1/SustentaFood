@extends('templates.master')
@section('content')
    <main id="content">
        <section id="home">
            <div class="shape"></div>
            <div id="cta">
                <h1 class="title">O sabor que vai de ponta a <span>ponta</span></h1>
                <p class="description">Nossa proposta é oferecer uma experiência gastronômica consciente, aproveitando ingredientes de forma integral e sustentável</p>
                <div id="cta_buttons">
                    <a href="" class="btn-default">Ver cardápio</a>
                    <a href="tel:+55555555555" id="phone_button">
                        <button class="btn-default"><i class="fa-solid fa-phone"></i></button>
                        (11) 94002-8922
                    </a>
                </div>
                <div class="social-media-buttons">
                    <a href=""><i class="fa-brands fa-whatsapp"></i></a>
                    <a href=""><i class="fa-brands fa-instagram"></i></a>
                    <a href=""><i class="fa-brands fa-facebook"></i></a>
                </div>
            </div>
            <div id="banner">
                <img src="{{ asset('assets/images/hero.png') }}" alt="">
            </div>
        </section>
        <section id="menu">
            <h2 class="section-title">Favoritos da Galera</h2>
            <h3 class="section-subtitle">OS MAIS PEDIDOS</h3>
            <div id="pratos">
                <div class="prato">
                    <div class="prato-inner">
                        <div class="prato-front">
                            <div class="prato-heart"><i class="fa-solid fa-heart"></i></div>
                            <img src="{{ asset('assets/images/dish.png') }}" class="prato-image" alt="">
                            <h3 class="prato-title">Bolo de Abacaxi</h3>
                            <span class="prato-description">Experimente este irresistível bolo de abacaxi! Além de fofo e delicioso, é rico em vitamina C</span>
                            <div class="prato-rate">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <span>(100+)</span>
                            </div>
                        </div>
                        <div class="prato-back">
                            <div class="prato-details">
                                <!-- <p>Descubra o sabor do aproveitamento total com nosso Bolo de Abacaxi, onde cada pedaço conta uma história de sustentabilidade. Utilizando as cascas do abacaxi, transformamos um ingrediente muitas vezes descartado em uma deliciosa base que exalta o frescor tropical.</p> -->
                                <!-- <button class="btn-default"><h4>VOLTA</h4></button> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="prato">
                    <div class="prato-inner">
                        <div class="prato-front">
                            <div class="prato-heart"><i class="fa-solid fa-heart"></i></div>
                            <img src="{{ asset('assets/images/cremedepepino.png') }}" class="prato-image" alt="">
                            <h3 class="prato-title">Creme de pepino e couve-flor</h3>
                            <span class="prato-description">Nossa refrescante Sopa Fria de Pepino e Couve-Flor, uma combinação perfeita de sabores leves e aromáticos</span>
                            <div class="prato-rate">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <span>(50+)</span>
                            </div>

                        </div>
                        <div class="prato-back">
                            <div class="prato-details">
                                <!-- <p>Uma sopa que celebra a leveza e a simplicidade dos ingredientes, perfeita para dias quentes e momentos de descontração</p> -->
                                <!-- <button class="btn-default"><h4>VOLTA</h4></button> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="prato">
                    <div class="prato-inner">
                        <div class="prato-front">
                            <div class="prato-heart"><i class="fa-solid fa-heart"></i></div>
                            <img src="{{ asset('assets/images/dish3.png') }}" class="prato-image" alt="">
                            <h3 class="prato-title">Espaguete com pesto e burrata</h3>
                            <span class="prato-description">Uma refeição sem glúten, simples e saborosa</span>
                            <div class="prato-rate">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <span>(20+)</span>
                            </div>

                        </div>
                        <div class="prato-back">
                            <div class="prato-details">
                                <!-- <p>Desperte os seus sentidos com este vibrante prato de Esparguete ao Pesto, onde a simplicidade encontra a sofisticação. O esparguete, cozido à perfeição, é envolto em um pesto aromático, complementado por tomates frescos e uma generosa porção de rúcula, que adiciona um toque de frescor e crocância</p> -->
                                <!-- <button class="btn-default"><h4>VOLTA</h4></button> -->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="prato">
                    <div class="prato-inner">
                        <div class="prato-front">
                            <div class="prato-heart"><i class="fa-solid fa-heart"></i></div>
                            <img src="{{ asset('assets/images/dish4.png') }}" class="prato-image" alt="">
                            <h3 class="prato-title">Pizza de frigideira com requeijão e legumes</h3>
                            <span class="prato-description">Uma pizza sem glúten ideal para as crianças</span>
                            <div class="prato-rate">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <span>(10+)</span>
                            </div>

                        </div>
                        <div class="prato-back">
                            <div class="prato-details">
                                <!-- <p>Descubra a deliciosa harmonia de sabores da nossa Pizza de Legumes Grelhados! Começamos com uma base de massa perfeitamente dourada, pincelada com uma mistura aromática de azeite, orégãos, tomilho e alho, que proporciona um sabor irresistível.</p> -->
                                <!-- <button class="btn-default"><h4>VOLTA</h4></button> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="testimonials">
            <img src="{{ asset('assets/images/chef.png') }}" id="testimonial_chef" alt="">
            <div id="testimonials_content">
                <h2 class="section-title">Depoimentos</h2>
                <h3 class="section-subtitle">O que os clientes falam sobre nós</h3>
                <div id="feedbacks">
                    <div class="feedback">
                        <img src="{{ asset('assets/images/avatar2.jfif') }}" class="feedback-avatar" alt="">
                        <div class="feedback-content">
                            <p><b>Felipe Dutra</b>
                                <span>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </span>
                            </p>
                            <p>"Estive no local recentemente e o que posso dizer é que a mistura de sabores é indescritível, com certeza voltarei mais vezes."</p>
                        </div>
                    </div>
                    <div class="feedback">
                        <img src="{{ asset('assets/images/avatar3.jfif') }}" class="feedback-avatar" alt="">
                        <div class="feedback-content">
                            <p><b>Henrique Silva</b>
                                <span>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </span>
                            </p>
                            <p>"Ambiente acolhedor, fomos em família e nos sentimos muito bem. Fora a diversidade de sabores e as opções bem coloridas para a criançada."</p>
                        </div>
                    </div>
                </div>
                <button class="btn-default"><a href="#top">VOLTAR AO TOPO</a></button>
            </div>
        </section>
    </main>
@endsection
