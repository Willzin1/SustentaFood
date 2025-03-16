@extends('templates.master')
@section('content')
    <section id="menu">
        <h2 class="section-title">Cardápio</h2>
        <h3 class="section-subtitle">Entrada</h3>
        <div id="dishes">
            <div class="dish">
                <img src="{{ asset('assets/images/cremedepepino.png') }}" class="dish-image" alt="E  rro">
                <h3 class="dish-title">Creme de pepino e couve-flor</h3>
                <span class="dish-description">
                    Delicie-se com este creme de pepino e couve-flor, uma entrada leve e saudável,
                        ideal para promover saciedade sem abrir mão de sabor.
                </span>
            </div>

            <div class="dish">
                <img src="{{ asset('assets/images/legumes-salteados1.png') }}" class="dish-image" alt="">
                <h3 class="dish-title">Legumes Salteados</h3>
                <span class="dish-description">
                Esses legumes salteados tornam-se o acompanhamento ideal para qualquer refeição.
                </span>
            </div>

            <div class="dish">
                <img src="{{ asset('assets/images/salada-de-bagos-com-camarao1.png') }}" class="dish-image" alt="">
                <h3 class="dish-title">Salado de Bagos com Camarão</h3>
                <span class="dish-description">
                Uma salada de bagos com camarão repleta de sabores frescos.
                Uma opção deliciosa e nutritiva para quem busca uma alimentação equilibrada.
                </span>
            </div>

            <div class="dish">
                <img src="{{ asset('assets/images/gaspacho-de-pepino1.png') }}" class="dish-image" alt="">
                <h3 class="dish-title">Gaspacho de Pepino</h3>
                <span class="dish-description">
                Gaspacho de pepino é uma sopa fria refrescante,
                com pepino, rúcula e hortelã fresca. Ideal para dias quentes,
                é leve, nutritiva e saudável.
                </span>
            </div>
            <!--------- Adicionr mais pratos --------->
        </div>
    </section>

    <!-- Segunda parte menu -->
    <section id="menu">
        <h3 class="section-subtitle">Prato principal</h3>
        <div id="dishes">
            <div class="dish">
                <img src="{{ asset('assets/images/hamburguer-de-salmao-com-salada.png') }}" class="dish-image" alt="">
                <h3 class="dish-title">Hambúrguer de Salmão com Salada</h3>
                <span class="dish-description">
                    Experimente um hambúrguer de salmão com abacaxi caramelizado e salada de quinoa.
                    Uma refeição saudávele deliciosa.
                </span>
            </div>

            <div class="dish">
                <img src="{{ asset('assets/images/one-pot-pasta-a-marinheira1.png') }}" class="dish-image" alt="">
                <h3 class="dish-title">Linguine negro com amêijoas</h3>
                <span class="dish-description">
                Um prato de comida reconfortante e de aspecto original, linguine negro com amêijoas
                </span>
            </div>

            <div class="dish">
                <img src="{{ asset('assets/images/polvo-guisado-com-arroz1.png') }}" class="dish-image" alt="">
                <h3 class="dish-title">Polvo Guisado com Arroz</h3>
                <span class="dish-description">
                O queridinho da casa, o polvo guisado com arroz vai ser a estrela da refeição. Sabores tradicionais à sua mesa!
                </span>
            </div>

            <div class="dish">
                <img src="{{ asset('assets/images/bacalhau-a-enterro1.png') }}" class="dish-image" alt="">
                <h3 class="dish-title">Bacalhau à Enterro</h3>
                <span class="dish-description">
                O Bacalhau à Enterro, um clássico da Páscoa em Portugal,
                    combina tradição e sabor numa receita simples, com bacalhau, batatas e nabiças
                </span>
            </div>
            <!--------- Adicionr mais pratos --------->
        </div>
    </section>

    <section id="menu">
        <h2 class="section-title">Cardápio Infantil</h2>
        <h3 class="section-subtitle">Entrada</h3>
        <div id="dishes">
            <div class="dish">
                <img src="{{ asset('assets/images/lanche.png') }}" class="dish-image" alt="Hambúrguer de Frango">
                <h3 class="dish-title">Hambúrguer de Frango</h3>
                <span class="dish-description">
                    Delicioso hambúrguer de frango grelhado, servido com molho especial e batatas fritas crocantes.
                </span>
            </div>

            <div class="dish">
                <img src="{{ asset('assets/images/macarrao-com-almondegas.jpg') }}" class="dish-image" alt="Macarrão com Almôndegas">
                <h3 class="dish-title">Macarrão com Almôndegas</h3>
                <span class="dish-description">
                    Massa macia com almôndegas de carne, coberta com molho de tomate caseiro, perfeita para os pequenos.
                </span>
            </div>

            <div class="dish">
                <img src="{{ asset('assets/images/pizza-de-frango.jpg') }}" class="dish-image" alt="Pizza de Frango">
                <h3 class="dish-title">Pizza de Frango</h3>
                <span class="dish-description">
                    Pizza pequena com frango desfiado, queijo derretido e molho tomate. Ideal para as crianças que amam pizza!
                </span>
            </div>

            <div class="dish">
                <img src="{{ asset('assets/images/nuggets-de-frango.jpeg') }}" class="dish-image" alt="Nuggets de Frango">
                <h3 class="dish-title">Nuggets de Frango</h3>
                <span class="dish-description">
                    Nuggets crocantes de frango, acompanhados de molho barbecue ou ketchup, para uma refeição divertida.
                </span>
            </div>

            <div class="dish">
                <img src="{{ asset('assets/images/sanduiche-com-queijo.jpg') }}" class="dish-image" alt="Sanduíche de Queijo">
                <h3 class="dish-title">Sanduíche de Queijo</h3>
                <span class="dish-description">
                    Sanduíche simples e saboroso de queijo derretido, uma opção deliciosa e reconfortante para as crianças.
                </span>
            </div>
        </div>
    </section>

    <!-- Terceira parte menu -->
    <section id="menu">
        <h3 class="section-subtitle">Sobremesas</h3>
        <div id="dishes">
            <div class="dish">
                <img src="{{ asset('assets/images/tarte-de-tres-frutos1.png') }}" class="dish-image" alt="">
                <h3 class="dish-title">Tarte de três frutos</h3>
                <span class="dish-description">
                A tarte de três frutos combina pêssegos, ameixas e nectarinas numa base crocante,
                criando uma sobremesa equilibrada, doce e refrescante.
                </span>
            </div>

            <div class="dish">
                <img src="{{ asset('assets/images/tarte-de-chocolate1.png') }}" class="dish-image" alt="">
                <h3 class="dish-title">Tarte de Chocolate Branco e Frutos vermelhos</h3>
                <span class="dish-description">
                Se a sua perdição é o chocolate, seguramente esta tarte de chocolate branco
                e frutos vermelhos é uma deliciosa proposta de doce.
                </span>
            </div>

            <div class="dish">
                <img src="{{ asset('assets/images/geladochocolate-1.png') }}" class="dish-image" alt="">
                <h3 class="dish-title">Gelato de Chocolate Branco</h3>
                <span class="dish-description">
                Este gelado de chocolate com calda de framboesa é uma deliciosa alternativa para quem tem problemas com a ingestão de produtos lácteos.
                </span>
            </div>

            <div class="dish">
                <img src="{{ asset('assets/images/pudimCaramelo1.png') }}" class="dish-image" alt="">
                <h3 class="dish-title">Pudim de Caramelo</h3>
                <span class="dish-description">
                O pudim de caramelo com framboesas é uma deliciosa sobremesa
                    que une a riqueza do caramelo à vivacidade das framboesas.

                </span>
            </div>
            <!--------- Adicionr mais pratos --------->
        </div>
    </section>

    <section id="menu">
        <h3 class="section-subtitle">Bebidas</h3>
        <div id="dishes">
            <div class="dish">
                <img src="{{ asset('assets/images/sumo-de-abacaxi-espinafres-e-pepino2.png') }}" class="dish-image" alt="">
                <h3 class="dish-title">Granizado de Limão</h3>
                <span class="dish-description">
                Descubra este granizado de limão, com limoncello e hortelã e espinafre. Garantimos que não vai sobrar um gole
                </span>
            </div>


            <div class="dish">
                <img src="{{ asset('assets/images/sumo-de-cascas-de-abacaxi1.png') }}" class="dish-image" alt="">
                <h3 class="dish-title">Pina Colada</h3>
                <span class="dish-description">
                Explore uma refrescante e tropical piña colada,
                o famoso coquetel de abacaxi com leite de coco e rum.
                </span>
            </div>

            <div class="dish">
                <img src="{{ asset('assets/images/Cidreira1.png') }}" class="dish-image" alt="">
                <h3 class="dish-title">Changria de Cidreira, Laranja e Vinho Branco</h3>
                <span class="dish-description">
                Uma fusão diferente, entre o chá (que vem do Oriente)
                e o vinho (predominante sobretudo no Mediterrânico).
                </span>
            </div>

            <div class="dish">
                <img src="{{ asset('assets/images/caipirinha-de-melancia1.png') }}" class="dish-image" alt="">
                <h3 class="dish-title">Suco de Melancia</h3>
                <span class="dish-description">
                Sugerimos este suco de melância com um toque de lima e maple syrup,
                    uma opção refrescante e leve.
                </span>
            </div>
            <!--------- Adicionr mais pratos --------->
        </div>
    </section>
@endsection
