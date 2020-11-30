@extends('admin.master.master')
@section('content')
<section class="dash_content_app">

    <header class="dash_content_app_header">
        <h2 class="icon-search">Cadastrar Novo Contrato</h2>

        <div class="dash_content_app_header_actions">
            <nav class="dash_content_app_breadcrumb">
                <ul>
                    <li><a href="">Dashboard</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="">Contratos</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="" class="text-orange">Cadastrar Contrato</a></li>
                </ul>
            </nav>

            <button class="btn btn-green icon-search icon-notext ml-1 search_open"></button>
        </div>
    </header>

    @include('admin.contracts.filter')

    <div class="dash_content_app_box">

        <div class="nav">
            <ul class="nav_tabs">
                <li class="nav_tabs_item">
                    <a href="#parts" class="nav_tabs_item_link active">Das Partes</a>
                </li>
                <li class="nav_tabs_item">
                    <a href="#terms" class="nav_tabs_item_link">Termos</a>
                </li>
            </ul>

            <div class="nav_tabs_content">
                <div id="parts">
                    <form action="" method="post" class="app_form">

                        <div class="label_gc">
                            <span class="legend">Finalidade:</span>
                            <label class="label">
                                <input type="checkbox" name="sale"><span>Venda</span>
                            </label>

                            <label class="label">
                                <input type="checkbox" name="rent"><span>Locação</span>
                            </label>
                        </div>

                        <div class="app_collapse">
                            <div class="app_collapse_header mt-2 collapse">
                                <h3>Proprietário</h3>
                                <span class="icon-minus-circle icon-notext"></span>
                            </div>

                            <div class="app_collapse_content">
                                <div class="label_g2">
                                    <label class="label">
                                        <span class="legend">Proprietário:</span>
                                        <select class="select2" name="owner" data-action="{{ route('admin.contracts.getDataOwner') }}">
                                            <option value="">Informe um Cliente</option>
                                            @foreach ($lessors->get() as $lessor)
                                                <option value="{{ $lessor->id }}">{{ $lessor->name }} ({{ $lessor->document }})</option>
                                            @endforeach
                                        </select>
                                    </label>

                                    <label class="label">
                                        <span class="legend">Conjuge Proprietário:</span>
                                        <select class="select2" name="owner_spouse">
                                            <option value="" selected>Não informado</option>
                                        </select>
                                    </label>
                                </div>

                                <label class="label">
                                    <span class="legend">Empresa:</span>
                                    <select class="select2" name="owner_company">
                                        <option value="" selected>Não informado</option>
                                    </select>
                                </label>
                            </div>
                        </div>

                        <div class="app_collapse">
                            <div class="app_collapse_header mt-2 collapse">
                                <h3>Adquirente</h3>
                                <span class="icon-minus-circle icon-notext"></span>
                            </div>

                            <div class="app_collapse_content">
                                <div class="label_g2">
                                    <label class="label">
                                        <span class="legend">Adquirente:</span>
                                        <select name="acquirer" class="select2" data-action="{{ route('admin.contracts.getDataAcquirer') }}">
                                            <option value="" selected>Informe um Cliente</option>
                                            @foreach ($lessees->get() as $lessee)
                                                <option value="{{ $lessee->id }}">{{ $lessee->name }} ({{ $lessee->document }})</option>
                                            @endforeach
                                        </select>
                                    </label>

                                    <label class="label">
                                        <span class="legend">Conjuge Adquirente:</span>
                                        <select class="select2" name="acquirer_spouse">
                                            <option value="" selected>Não informado</option>
                                        </select>
                                    </label>
                                </div>

                                <label class="label">
                                    <span class="legend">Empresa:</span>
                                    <select name="acquirer_company" class="select2">
                                        <option value="" selected>Não informado</option>
                                    </select>
                                </label>
                            </div>
                        </div>

                        <div class="app_collapse">
                            <div class="app_collapse_header mt-2 collapse">
                                <h3>Parâmetros do Contrato</h3>
                                <span class="icon-minus-circle icon-notext"></span>
                            </div>

                            <div class="app_collapse_content">
                                <label class="label">
                                    <span class="legend">Imóvel:</span><!-- Adicionando um gatilho de property -->
                                    <select name="property" class="select2"
                                        data-action="{{ route('admin.contracts.getDataProperty') }}">
                                        <option value="">Não informado</option>
                                    </select>
                                </label>

                                <div class="label_g2">
                                    <label class="label">
                                        <span class="legend">Valor de Venda:</span>
                                        <input type="tel" name="sale_price" class="mask-money"
                                               placeholder="Valor de Venda" disabled/>
                                    </label>

                                    <label class="label">
                                        <span class="legend">Valor de Locação:</span>
                                        <input type="text" name="rent_price" class="mask-money"
                                               placeholder="Valor de Locação" disabled/>
                                    </label>
                                </div>

                                <div class="label_g2">
                                    <label class="label">
                                        <span class="legend">IPTU:</span>
                                        <input type="text" name="tribute" class="mask-money" placeholder="IPTU"
                                               value=""/>
                                    </label>

                                    <label class="label">
                                        <span class="legend">Condomínio:</span>
                                        <input type="text" name="condominium" class="mask-money"
                                               placeholder="Valor do Condomínio" value=""/>
                                    </label>
                                </div>

                                <div class="label_g2">
                                    <label class="label">
                                        <span class="legend">Dia de Vencimento:</span>
                                        <select name="due_date" class="select2">
                                            <option value="1">1º</option>
                                            <option value="2">2/mês</option>
                                            <option value="3">3/mês</option>
                                            <option value="4">4/mês</option>
                                            <option value="5">5/mês</option>
                                            <option value="6">6/mês</option>
                                            <option value="7">7/mês</option>
                                            <option value="8">8/mês</option>
                                            <option value="9">9/mês</option>
                                            <option value="10">10/mês</option>
                                            <option value="11">11/mês</option>
                                            <option value="12">12/mês</option>
                                            <option value="13">13/mês</option>
                                            <option value="14">14/mês</option>
                                            <option value="15">15/mês</option>
                                            <option value="16">16/mês</option>
                                            <option value="17">17/mês</option>
                                            <option value="18">18/mês</option>
                                            <option value="19">19/mês</option>
                                            <option value="20">20/mês</option>
                                            <option value="21">21/mês</option>
                                            <option value="22">22/mês</option>
                                            <option value="23">23/mês</option>
                                            <option value="24">24/mês</option>
                                            <option value="25">25/mês</option>
                                            <option value="26">26/mês</option>
                                            <option value="27">27/mês</option>
                                            <option value="28">28/mês</option>
                                        </select>
                                    </label>

                                    <label class="label">
                                        <span class="legend">Prazo do Contrato (Em meses)</span>
                                        <select name="deadline" class="select2">
                                            <option value="12">12 meses</option>
                                            <option value="24">24 meses</option>
                                            <option value="36">36 meses</option>
                                            <option value="48">48 meses</option>
                                        </select>
                                    </label>
                                </div>

                                <label class="label">
                                    <span class="legend">Data de Início:</span>
                                    <input type="tel" name="start_at" class="mask-date" placeholder="Data de Início"
                                           value=""/>
                                </label>
                            </div>
                        </div>

                        <div class="text-right mt-2">
                            <button class="btn btn-large btn-green icon-check-square-o">Salvar Contrato</button>
                        </div>
                    </form>
                </div>

                <div id="terms" class="d-none">
                    <h3 class="mb-2">Termos</h3>

                    <textarea name="terms" cols="30" rows="10" class="mce"></textarea>
                </div>
            </div>
        </div>
    </div>
</section> 
@endsection
@section('js')
    <script>
        //Carregando o token na página para o ajax, para funcionamento em qualquer requisição abaixo deste script
        $.ajaxSetup({
            headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"').attr('content')
            }
        });

        //Chama a função ao selecionar um proprietario para carregar dados e prencher outros select
        $(function() {
            /**Proprietário */
            $('select[name="owner"]').change(function() {
                var owner = $(this);
                $.post(owner.data('action'),{user: owner.val()},function (response) {
                    //Spouse - Com os dados em response vamos popular select de conjuge
                    $('select[name="owner_spouse"]').html('');//Limpando o select de qualquer dado que existir
                    //Se existir vamos preencher o select com o conteúdo
                    if(response.spouse){
                       $('select[name="owner_spouse"]').append($('<option>',{
                          value: 0,
                          text: 'Não informar'
                       }));

                       $('select[name="owner_spouse"]').append($('<option>',{
                          value: 1,
                          text: response.spouse.spouse_name + '(' + response.spouse.spouse_document + ')'
                       }));
                    }else{
                        $('select[name="owner_spouse"]').append($('<option>',{
                          value: 0,
                          text: 'Não informado'
                       }));
                    }

                    //Companies - Com os dados em response vamos popular select de empresas
                    $('select[name="owner_company"]').html('');//Limpando o select de qualquer dado que existir
                    //Se existir vamos preencher o select com o conteúdo
                    if(response.companies != null && response.companies.length){
                       $('select[name="owner_company"]').append($('<option>',{
                          value: 0,
                          text: 'Não informar'
                       }));

                       //Fazer um foreach no jquery para passar em todas as empresas, dados que vem do controller em companies
                       $.each(response.companies, function(key, value){
                           $('select[name="owner_company"]').append($('<option>',{
                              value: value.id,
                              text: value.alias_name + '(' + value.document_company + ')'
                           }));
                       });

                    }else{
                        $('select[name="owner_company"]').append($('<option>',{
                          value: 0,
                          text: 'Não informado'
                       }));
                    }

                     //Properties - Com os dados em response vamos popular select de propriedades
                     $('select[name="property"]').html('');//Limpando o select de qualquer dado que existir
                    //Se existir vamos preencher o select com o conteúdo
                    if(response.properties != null && response.properties.length){
                       $('select[name="property"]').append($('<option>',{
                          value: 0,
                          text: 'Não informar'
                       }));

                       //Fazer um foreach no jquery para passar em todas as prpriedades, dados que vem do controller em properties
                       $.each(response.properties, function(key, value){
                           $('select[name="property"]').append($('<option>',{
                              value: value.id,
                              text: value.description
                           }));
                       });

                    }else{
                        $('select[name="property"]').append($('<option>',{
                          value: 0,
                          text: 'Não informado'
                       }));
                    }

                },'json');
            });

            /**Adquirente */
            $('select[name="acquirer"]').change(function() {
                var acquirer = $(this);
                $.post(acquirer.data('action'),{user: acquirer.val()},function (response) {
                    //Spouse - Com os dados em response vamos popular select de conjuge
                    $('select[name="acquirer_spouse"]').html('');//Limpando o select de qualquer dado que existir
                    //Se existir vamos preencher o select com o conteúdo
                    if(response.spouse){
                       $('select[name="acquirer_spouse"]').append($('<option>',{
                          value: 0,
                          text: 'Não informar'
                       }));

                       $('select[name="acquirer_spouse"]').append($('<option>',{
                          value: 1,
                          text: response.spouse.spouse_name + '(' + response.spouse.spouse_document + ')'
                       }));
                    }else{
                        $('select[name="acquirer_spouse"]').append($('<option>',{
                          value: 0,
                          text: 'Não informado'
                       }));
                    }

                    //Companies - Com os dados em response vamos popular select de empresas
                    $('select[name="acquirer_company"]').html('');//Limpando o select de qualquer dado que existir
                    //Se existir vamos preencher o select com o conteúdo
                    if(response.companies != null && response.companies.length){
                       $('select[name="acquirer_company"]').append($('<option>',{
                          value: 0,
                          text: 'Não informar'
                       }));

                       //Fazer um foreach no jquery para passar em todas as empresas, dados que vem do controller em companies
                       $.each(response.companies, function(key, value){
                           $('select[name="acquirer_company"]').append($('<option>',{
                              value: value.id,
                              text: value.alias_name + '(' + value.document_company + ')'
                           }));
                       });

                    }else{
                        $('select[name="acquirer_company"]').append($('<option>',{
                          value: 0,
                          text: 'Não informado'
                       }));
                    }

                },'json');
            });

            //Estrutura do gatilho de properties
            //encapsular o seletor e disparar a ação de change:
            $('select[name="property"').change(function () {
                var property = $(this);//Havendo ação em change dispara uma função que define tud para var property
                //Dispara um post pra dentro da rota, seus parametros, disparando uma função com retorno(response) do tipo json
                $.post(property.data('action'), {property: property.val()}, function (response) {
                    //Preenchendo os inputs pelo response recuperado
                    //encapsulando o imput sale_price recebe como valor o response, na posicao property(que é devolvido pelo php) 
                    //retornando o valor do nosso input: sale_price
                    if(response.property != null){
                        $('input[name="sale_price"]').val(response.property.sale_price);
                    } else {//Seta valor caso o response venha a ser nulo
                        $('input[name="sale_price"]').val('0,00');
                    }


                }, 'json');
            });

        });
    </script>
@endsection