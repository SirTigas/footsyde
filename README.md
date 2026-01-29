# 👟 Footsyde – E-commerce de Tênis

Este é um projeto pessoal com o objetivo de desenvolver um e-commerce de tênis utilizando tecnologias modernas. A ideia é praticar e aprimorar minhas habilidades em desenvolvimento web, construindo um site completo com sistema de login, carrinho de compras 🛒 e filtro de produtos por categoria (masculino, feminino e unissex).

## 🧰 Tecnologias Utilizadas

- ⚙️ **PHP 8+**
- 🧱 **Laravel 12**
- 🐬 **MySQL**
- 🐳 **Docker** + **Laradock**
- 🎨 **HTML & CSS**
- 💻 **WSL (Ubuntu)** para ambiente de desenvolvimento

## 🔧 Funcionalidades do Projeto

- Catálogo de calçados com filtros por gênero
- Sistema de autenticação (login)
- Carrinho de compras
- Lista de favoritos
- Barra de pesquisa
- Envio de emails após registro e compras
- Comentários e avaliações
- Checkout
- Aplicação admin

## 🚧 Status

Projeto em desenvolvimento 🛠️

## 📝 Licença

Este projeto está licenciado sob a **MIT License**.  
Sinta-se livre para estudar, adaptar e evoluir o código como desejar.

# 🖥️ Como rodar

Aqui estão os requisitos para rodar o projeto na sua máquina:
- Git
- Docker
- Wsl (recomendado caso o seu SO seja o Windows)

## 📥 Clonar o repositório e configurando o .env

- Clone o repositório
```bash
git clone https://github.com/SirTigas/footsyde.git
```
- Entre na pasta
```bash
cd footsyde
```
- Copie o .env.example
```bash
cp .env.example .env
```

- Configure o banco de dados
```bash
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=footsyde
DB_USERNAME=root
DB_PASSWORD=root
```

## 🐋 Suba os containers

```bash
docker-compose up -d nginx mysql php-fpm workspace
```
- Entre no workspace
```bash
docker-compose exec -it [workspace-id] bash
```

## 📍 Instale as dependências PHP

- Dentro do workspace rode
```bash
composer install
```

- Gere a chave da aplicação
```bash
php artisan key:generate
```

## 🎲 Migrations e seeders

- Rode as migrations
```bash
php artisan migrate
```

- Rode a seeder
```bash
php artisan db:seed --class="CategorySeeder"
```

- Se quiser produtos fakes rode na sequencia
```bash
php artisan db:seed --class="ProductSeeder"
php artisan db:seed --class="ProductVariantSeeder"
```

## 📧 Envio de Emails

- Usa SMTP
- Você pode configurar o seu email do google para ser o remetente dos emails
- Por padrão vem um email que criei para este projeto exclusivamente

# 🌐 Acessar o projeto

- Acesse: http://localhost
