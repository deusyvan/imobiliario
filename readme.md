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
  - 

