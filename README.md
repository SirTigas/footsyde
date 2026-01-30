# 👟 Footsyde – E-commerce de Tênis

Este é um projeto pessoal com o objetivo de desenvolver um e-commerce de tênis utilizando tecnologias modernas. A ideia é praticar e aprimorar minhas habilidades em desenvolvimento web, construindo um site completo com sistema de login, carrinho de compras 🛒 e filtro de produtos por categoria (masculino, feminino e unissex).

## 🧰 Tecnologias Utilizadas

- ⚙️ **PHP 8+**
- 🧱 **Laravel 12**
- 🐬 **MySQL**
- 🐳 **Docker** + **Laradock**
- 🟢 **Node.js v20+**
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

# 🖥️ Como rodar em sua máquina

Aqui estão os requisitos para rodar o projeto na sua máquina:
- Git
- Node.js v20+
- PHP 8+
- MySql
- Composer
- Wsl (recomendado caso o seu SO seja o Windows e for usar o docker)

## 📥 Clonar o repositório e configurando o .env

- Clone o repositório
```bash
git clone https://github.com/SirTigas/footsyde.git
```
- Entre na pasta footsyde
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
DB_HOST=localhost #altere para "mysql" se for usar o docker
DB_PORT=3306
DB_DATABASE=footsyde 
DB_USERNAME=root
DB_PASSWORD=root
```

## ⚙️ Instalando o laradock (somente de for usar o docker)
- É necessário a instalação do laradock, rode na sequência (deve estar dentro do diretório "footsyde"):
```bash
git clone https://github.com/laradock/laradock.git
cd laradock
cp .env.example .env
```

## 🐋 Suba os containers (somente se for usar o docker)

- Subindo os containers (dentro do diretório "laradock")
```bash
docker-compose up -d php-fpm workspace nginx phpmyadmin mysql
```

- Após subir os containers descubra o id do contianer workspace rodando o comando abaixo (saia do diretorio laradock)
```bash
cd ../
docker ps
```

- Entre no workspace (substitua {workspace-id} pelo id do container)
```bash
docker exec -it {workspace-id} bash
```

## 📍 Instale as dependências PHP (se estiver usando docker rode dentro do workspace)

- Rode
```bash
composer install
npm install
npm run build
```

- Gere a chave da aplicação
```bash
php artisan key:generate
```

## 🎲 Migrations e seeders (ainda dentro do workspace se estiver usando docker)

- Rode as migrations
```bash
php artisan migrate
```

- Rode a seeder
```bash
php artisan db:seed --class="CategorySeeder"
```

- Rode esse comando para as imagens ficarem acessíveis no navegador
```bash
php artisan storage:link
```

- Se quiser produtos fakes rode na sequência
```bash
php artisan db:seed --class="ProductSeeder"
php artisan db:seed --class="ProductVariantSeeder"
```

# ⭐ Como acessar a aplicação admin

Se voce tiver seguido o passo a passo vc já vai estar conseguindo visualizar o site, agora
basta seguir os seguintes passos para vc poder acessar a aplicação admin.

- Crie um usuário normalmente, acessando a rota "/register" ou aperte em login no navbar do site.

- OBS: É necessário ter o email verificado para acessar a aplicação admin, você pode usar um email temporário que também vai funcionar.

- Você pode reenviar o link de verificação do email acessando as configurações do seu perfil em "Meu perfil".

- Depois acesse o tinker rodando (rode no workspace se estiver usando docker)
```bash
php artisan tinker
```

-Descubra seu id de usuário rodando (isso vai retornar o registro de todos os usuários, procure pelo o seu id de usuário)
```bash
use App\Models\User;
$eu = User::all();
```

- na sequência rode (substitua $i pelo o seu id de usuário)
```bash
$eu = User::find($i);
$eu->role = "admin";
$eu->save();
exit
```
  
- Após isso, ao clicar no seu nome que fica localizado na navbar na aplicação irá exebir um dropdown com a opção "Dashboard" disponível.

## 📧 Envio de Emails

- Usa SMTP por padrão
- Você pode configurar o seu email do google para ser o remetente dos emails
- Por padrão vem um email que criei para este projeto exclusivamente

# 🌐 Acessar o projeto

- Docker: http://localhost
- php artisan serve: http://localhost:8000 
