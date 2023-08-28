# Projeto Laravel "DC Vendas" 👨‍💼📊

Bem-vindo ao projeto Laravel "DC Vendas"! Este é um sistema de gerenciamento de vendas, clientes e produtos, desenvolvido em Laravel para ajudar a administrar suas operações de vendas de maneira eficiente.

## Funcionalidades 🛍️📈

- Registro e autenticação de usuários.
- Cadastro, edição e exclusão de clientes.
- Cadastro, edição e exclusão de produtos.
- Registro de vendas, incluindo produtos, quantidades e detalhes de pagamento.
- Geração de relatórios em formato PDF para vendas.

## Requisitos 📋

Certifique-se de ter os seguintes requisitos instalados em seu ambiente de desenvolvimento:

- [Composer](https://getcomposer.org/)
- [PHP](https://www.php.net/) 7.4 ou superior
- [MySQL](https://www.mysql.com/) ou outro banco de dados compatível

## Instalação e Configuração 🚀

1. Clone o repositório para o seu ambiente local:

```bash
   git clone https://github.com/DaniloBronze/dcvendas.git
```

2. Instale as dependências usando o Composer:
```bash
    composer install
```

3. Configure as informações de banco de dados no arquivo .env:
   
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=seu_banco_de_dados
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```
4. Execute as migrações do banco de dados e tudo mais:

```bash
php artisan migrate
php artisan serve
npm run dev
```

5. Caso prefira, também disponibilizamos um banco de dados pré-configurado dentro do projeto, com o usuário e senha:
```bash
test@gmail.com:81165761
```

## Uso 💼🖥️
Acesse o aplicativo em seu navegador em http://localhost:8000. Você pode fazer login ou registrar-se como usuário para começar a usar as funcionalidades do sistema.

## Contribuição 🤝🚀
Contribuições são bem-vindas! Se você quiser melhorar este projeto, crie um fork e envie suas solicitações de pull.

