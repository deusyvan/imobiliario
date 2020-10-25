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

