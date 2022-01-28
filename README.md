## Instalação
Já com o composer instalado, vamos baixar algumas depedêcias do projeto.
```bash
composer update
```
Inicie o servidor de desenvolvimento do Laravel digitando em seu terminal `php artisan serve`.

## Banco de dados MySQL
Crie uma base de dados no meu banco de dados MySQL e altere os dados no arquivo **.env.example**, dados prontos, agora renomeei para **.env** e faça a migração do banco de dados usando `php artisan migrate`

## Recursos visuais
É necessário ter npm para instalar o front-end da aplicação.
Execute os comandos:
```bash
npm install
npm run dev
```
Se tudo ocorreu bem, [clique aqui](http://localhost:8000) e acesse o website.
