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

- Configurar messages com barra: Aula: Tratando requisição de Login(11:00)

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

 - Alimentar item no menu: Parametrizar menu:

 - Criar Rotas: Parametrizar rotas: 

 - Criar Controlador [ php artisan make:controller Admin\CompanyController --resource] resource para os métodos e recursos do controlador

 - Criar Modelo: [ php artisan make:model Company -m ] no caso de -r =resources vai para o diretorio Http/Controllers deve-se copiar para a pasta correta(Admin e mudar o namespace) ou já informando o caminho correto, sem o resources vai para a pasta "app", usar -m para já criar o migrate de banco de dados.  

 - Criar Form Request
 - Fazer as validações
 - Traduzir parâmetros no arquivo de traduções (global)
 - Persistência no formulário: 
    criação(CSRF) e 
    edição (MÉTODO PUT, input "hidden" do id)

