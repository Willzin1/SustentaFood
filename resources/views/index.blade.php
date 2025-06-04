@extends('templates.master')

@section('title')
SustentaFood
@endsection

@section('content')
    <main id="content">
        <section id="home">
            <div class="shape"></div>
            <div id="cta">
                <h1 class="title">O sabor que vai de ponta a <span>ponta</span></h1>
                <p class="description">Nossa proposta é oferecer uma experiência gastronômica consciente, aproveitando ingredientes de forma integral e sustentável</p>
                <div id="cta_buttons">
<a href="{{ route('cardapio.index') }}" class="btn-default btn-cta">Ver cardápio</a>
                    <!-- <a href="tel:+55555555555" id="phone_button">
                        <i class="fa-solid fa-phone"></i>
                        (11) 94002-8922
                    </a> -->
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
            <h2 class="section-title">{{ isset($pratosFavoritos) && !empty($pratosFavoritos) ? 'Favoritos da Galera' : 'Pratos de destaque' }}</h2>
            <!-- <h3 class="section-subtitle">OS MAIS PEDIDOS</h3> -->
            <div id="pratos">
                @if(isset($pratosFavoritos) && !empty($pratosFavoritos))
                    @foreach($pratosFavoritos as $prato)
                        <div class="prato">
                            <div class="prato-inner">
                                <div class="prato-front">
                                    <img src="{{ env('API_URL_STORAGE') }}/{{ $prato['prato']['imagem'] }}" class="prato-image" alt="{{ $prato['prato']['nome'] }}">
                                    <h3 class="prato-title">{{ $prato['prato']['nome'] }}</h3>
                                    <span class="prato-description">{{ $prato['prato']['descricao'] }}</span>
                                    <div class="prato-rate">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <span>({{ $prato['total_favoritos'] }})</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="prato">
                        <div class="prato-inner">
                            <div class="prato-front">
                                <!-- <div class="prato-heart"><i class="fa-solid fa-heart"></i></div> -->
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
                        </div>
                    </div>
                @endif
            </div>
        </section>

        <!-- <section id="testimonials">
            <img src="{{ asset('assets/images/chef.png') }}" id="testimonial_chef" alt=""> -->
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
                <!-- <button class="btn-default"><a href="#top">VOLTAR AO TOPO</a></button> -->
            </div>
        </section>
    </main>
@endsection
