Permissões de pastas:

Olá Deusyvan Ferreira, tenta executar essa linha no seu terminal na pasta "html" 

find * -type d -exec chmod 2755 {} \;
assim terá permissão nas pastas

- Criando AuthController não é resource
php artisan make:controller Admin\AuthController

- Instalando os plugins do npm
npm install

- Aplicação fica em standby pois toda alteração sendo feito já é levada para public
npm run dev -watch 
npm run watch 

- Autoload para o composer fazer o laravel reconhecer nosso novo helpers
composer dump-autoload

- Gerando controller:
php artisan make:controller Admin\UserController --resource

- Gerando o Request
php artisan make:request Admin\User

- Configurar messages com barra: Aula: Tratando requisição de Login

Criados:
- Rotas
- Visões
- Controladores
- Modelos
- Form Request
- Migrations : php artisan make:migration alter_users_table --table=users 

- Atualizando o npm 
npm run dev

- Replicar ações para criação de recurso "Company":
 - Alimentar item no menu: Parametrizar menu na view: master.blade.php 

 - Criar Rotas: Parametrizar rotas: [Route::resource('companies', 'CompanyController');] e testa as rotas para verificar se não existe algum erro: [php artisan route:list]

 - Criar Controlador [ php artisan make:controller Admin\CompanyController --resource] resource para os métodos e recursos do controlador, parametrizando o controller com as views: create,filter e index

 - Criar Modelo: [ php artisan make:model Company -m ] no caso de -r =resources vai para o diretorio Http/Controllers deve-se copiar para a pasta correta(Admin e mudar o namespace) ou já informando o caminho correto, sem o resources vai para a pasta "app", usar -m para já criar o migrate de banco de dados.  Após criação do migrate rodar comando: php artisan migrate vai atualizar o banco de dados

 - Criar Form Request
 - Fazer as validações
 - Traduzir parâmetros no arquivo de traduções (global)
 - Persistência no formulário: 
    criação(CSRF) e 
    edição (MÉTODO PUT, input "hidden" do id)

- Desenvolvendo recursos: Imóvel
  - Criar Rotas (php artisan route:list) - Lista e reconhecimento do controllador e realização de todos os binds dos parametros
  - Criar Modelo (php artisan make:model Property -m)
  - Criar Controlador (php artisan make:controller Admin\PropertyController --resource)
  - Criar Form Request (php artisan make:request Admin\Property)
  - Criar Migration (php artisan make:model Property -m)
    *Parametrizar o form com o fillable e realizar a migração: php artisan migrate
  - Popular Banco de dados (Não é o imóvel que possui o proprietário e sim o proprietário que possui o imóvel = relacionamento: apartir do usuário fazer o relacionamento de ida e de volta)
  - Colocar menu(imóveis) pra funcionar
  - Parametrizar as visões

- Desenvolvendo Recursos [Imagens]
  - Criar modelo e migration (php artisan make:model PropertyImage -m)
  - Executar a migrate aplicando no banco de dados (php artisan migrate):
    Se for o caso e precisar fazer um rollback: php artisan migrate:rollback --step=1 (desfaz o ultimo passo)
  - Desenvolver o modelo PropertyImage: Update e Create
  - Listando as imagens com a criação de um mutate
  - Ambiente para realizar as ações de definir cover e remover imagens:
    - href="javascript:void(0)" = para não realizar nenhuma ação no sistema
    - data-action=" {{ }}" = modalidade usada para trabalhar com ajax 
  - Estrutura para testar a function na route do php e retornar um json:
    Aponta pra onde vai o ajax no controller, tornando uma url dinâmica = 'action'
     {} Pelo post vamos informar um id
     Function que será dispara
     'json' = o tipo do retorno
     $.post(button.data('action'), {}, function(response){
      alert(response); //Testando para verificar se o que foi escrito no php vai retornar aqui no response
      }, 'json');
    *Se por acaso retornar um 419 é um bloqueio ocorrido porque esqueceu de informar o CSRF Token, pois toda requisição dentro do sistema precisa de um token, método de segurança na aplicação
    *Se por acaso retornar um erro 500 deixou de renderizar a página
  - Estrutura para testar gatilho de delete na action de imagens:
    $('.image-remove').click(function(event) {
        event.preventDefault();
        var button = $(this);
        //Para disparar um delete através de um javascript
        $.ajax({
            url:button.data('action'),
            type:'DELETE',
            dataType: 'json',
            success: function(response) {
                alert(response); 
            }
        });
    });
  
  - Desenvolver a regra de negócio da gestão de mídia
    -Buscando os parametros via request (id)
    -Salva no banco de dados a capa como true do imóvel e mostrando via javascript através do css
    -Exclui dos diretorios (cache e properties) e do banco de dados a imagem
    -Exclui da visão (html)
    -Identificar quem é a capa do imóvel na visão de usuarios(Locador)
    -Caso não tenha nenhuma imagem mostrar a imagem padrão do sistema
    -Transforma o path em uma url do storage

  - Desenvolver recursos [Contrato]
    - Criar modelo e migration (php artisan make:model Contract -m)
    - Criar Rotas de contrato
    - Criando Controller
    - Confere rotas, métodos, classes : php artisan route:list
    - Colocar parametros da ligacao: Identificar os campos (parametrizar Controller com a view)
    - Editar visões (view)
    - Alterar a migration incluindo os campos e relacionamentos e migrar (php artisan migrate)
    - Alterar modelo incluindo o fillable para validações

  - Complexidades Ajax:
    * Gatilhos Proprietario:
      - Alimentar os lessers e lessees, através de um escopo
      - Na mudança do select buscar via ajax e preencher outras informações. Essa mudança dispara uma função
      que efetua um post em uma determinada rota que retorna os parametros nescessários.
      - Coloca-se um action no atributo do select para ser disparado a rota quando efetuar o post
      - A função da rota é disparada dependendo de civilStatusSpouseRequired que deve ser 'married' ou 'separated'
    * Gatilhos Adquirente:
      - Duplicar as ações
      - Duplicar rota
      - Duplicar método no controlador
      - Duplicar gatilho dentro do javascript
      - Duplicar o data-action, elemento que fica dentro do adquirente

  - Contratos
    - Alimentar os imóveis pelo change de seleção de proprietário
    - no script js: Dispara um post pra dentro da rota, seus parametros, disparando uma função com retorno(response) do tipo json:
      $.post(property.data('action'), {}, function (response) {}, 'json');
    - Estrutura de script pronta para properties:
      $.post(property.data('action'), {property: property.val()}, function (response) {
              }, 'json');
    - Alimenta as posições e retorna o json para response
    - Passando via js as posições passadas no response e populando-as na view 
    - Disponibilizar em toda a aplicação o preenchimento dos checkbox de venda e locação, lembrando de re-compilar o js:
      npm run dev
    - Aplicando disabled em toda a aplicação para o nosso checkbox de rent
    - Persistência das informações via ajax através do request e colocando as validacções:
    php artisan make:request Admin\Contract
    - Colocando as mensagens de erro na validação
    - Fazendo as validações passarem pelo request e se dar erro enviar para msg de erro na página
    - Mudar a requisição de dependência no controlador para que seja o form request e se encontrar erro faça o redirect pack juntamente com as mensagens
    - Para evitar conflito mas dar um apelido ao nosso request ContractRequest



