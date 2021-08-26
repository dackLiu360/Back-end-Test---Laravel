## Sobre o projeto

Avaliação para vaga de desenvolvedor back-end para a empresa Mentes Notáveis (versão laravel)
## Requisitos

- Laravel 8.56.0
- PHP 8.0.10
- Mysql 8.0.26
- Composer 2.1.6

## Tutorial 

1. Fazer a configuração do mysql (com a versão utilizada) e rodar as seguintes queries. 

```sql
CREATE DATABASE db_test_mentes_pensantes;
CREATE USER 'user_test'@'localhost' IDENTIFIED BY '89152195';
GRANT ALL PRIVILEGES ON * . * TO 'user_test'@'localhost';
FLUSH PRIVILEGES;
```

2. Clonar o projeto 

3. Entrar na pasta do projeto e rodar composer install para instalar as dependencias do composer.json

4. Criar o arquivo ```.env``` na raiz do projeto e copiar o conteúdo do ```.env.example``` nele 

5. Rodar ```php artisan key:generate``` e ```php artisan migrate``` 

6. Executar o projeto com ```php artisan serve```