
# Yahp Cursos - Laravel Website

### Passo a passo

Crie o Arquivo .env
```sh
cp .env.example .env
```


Atualize as variáveis de ambiente do arquivo .env
```dosini
APP_NAME=Laravel
APP_URL=http://localhost:8080

DB_PASSWORD=root
```


Suba os containers do projeto
```sh
docker compose up -d
```


Acessar o container
```sh
docker compose exec app bash
```


Instalar as dependências do projeto
```sh
composer install
```


Gerar a key do projeto Laravel
```sh
php artisan key:generate
```
Inicializar a database
```
php artisan migrate
```
Colocar Dados Prontos na Database
```
php artisan db:seed
```

## Usuário admin:
Usuário de acesso padrão: Admin

Senha padrão: adminadmin

## Usuário secretaria:

Usuário de acesso padrão: Secretaria

Senha padrão: 12345678



## Acesse o projeto
[http://localhost:8080](http://localhost:8080)

Acesse o phpmyadmin
[http://localhost:8081](http://localhost:8081)




