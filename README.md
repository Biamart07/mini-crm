# 🗄️ Mini-CRM: Sistema de Gestão de Clientes (CRUD PHP + Frontend Completo)

## 🎯 Objetivo do Projeto

Este projeto foi desenvolvido como um sistema de gestão de clientes completo, focado na prática do **Full-Stack (PHP/MySQL)** para persistência de dados e na criação de uma interface de usuário moderna e segura com **Tailwind CSS e JavaScript**.

O objetivo principal foi demonstrar domínio sobre:
1.  **Ciclo de Vida CRUD:** Implementação completa das quatro operações básicas de manipulação de dados.
2.  **Segurança e Autenticação:** Proteção de rotas com login seguro e hashing de senhas.
3.  **Design e Arquitetura:** Desenvolvimento responsivo (*Mobile-First*) e uso de comunicação assíncrona (AJAX).

---

## 🛡️ Destaques Técnicos e Segurança

Este projeto incorpora as seguintes melhores práticas, que são essenciais para um ambiente de produção:

* **Autenticação Segura (Login/Logout):**
    * Uso de **Sessões PHP** para controle de acesso e proteção da página principal (`index.php`).
    * Armazenamento de senhas via **`password_hash()`** e verificação via **`password_verify()`**, prevenindo a exposição de senhas em caso de vazamento do banco de dados.
* **Prevenção contra SQL Injection:** Todas as interações com o banco de dados (CREATE, UPDATE, DELETE) utilizam **Prepared Statements (PDO)**, garantindo que dados de entrada do usuário sejam tratados separadamente dos comandos SQL.
* **Estrutura da Aplicação:** Separação lógica entre a Conexão (`db_config.php`), o Controlador (`auth.php`, `clientes.php`) e as Views (`index.php`, `login.php`).

---

## 🎨 Funcionalidades Front-End (UX/Design)

* **CRUD Completo e Fluido:** Implementação das operações C.R.U.D.
* **Edição (Update) com Modal AJAX:** O preenchimento do formulário de edição no Modal é feito de forma assíncrona via **Fetch API (JSON)**, proporcionando uma experiência de usuário sem recarregamento de página.
* **Design Responsivo e Navbar:**
    * Estilização **Mobile-First** utilizando **Tailwind CSS**.
    * Inclusão de um **Menu Hamburguer** totalmente funcional (via JavaScript) para navegação intuitiva em dispositivos móveis.
* **Feedback Inteligente:** Mensagens de sucesso ou erro (após criar, editar ou deletar) são exibidas e **desaparecem automaticamente** após 5 segundos, garantindo que a UI se mantenha limpa.

---

## ⚙️ Tecnologias Utilizadas

| Camada | Tecnologia | Propósito |
| :--- | :--- | :--- |
| **Back-End** | PHP | Lógica de autenticação e controle de fluxo. |
| **Banco de Dados** | MySQL/PDO | Persistência de dados segura. |
| **Estilização** | Tailwind CSS | Desenvolvimento rápido e responsivo da interface. |
| **Interatividade** | JavaScript (Puro) | Modal, Menu Hamburguer e Requisições AJAX. |

---

## 🚀 Como Iniciar o Projeto

### Pré-requisitos
* Ambiente **XAMPP/WAMP/MAMP** (com Apache e MySQL ativos).

### 1. Configuração do Banco de Dados

1.  Crie um banco de dados chamado **`mini_crm`** no phpMyAdmin.
2.  Execute as instruções SQL para criar as duas tabelas necessárias:

    ```sql
    -- Tabela de Clientes (Dados da Aplicação)
    CREATE TABLE clientes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(100) NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        telefone VARCHAR(20),
        data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );

    -- Tabela de Usuários (Autenticação)
    CREATE TABLE usuarios (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(100) NOT NULL,
        email VARCHAR(100) UNIQUE NOT NULL,
        senha VARCHAR(255) NOT NULL, -- Para o hash seguro
        data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
    ```

3.  **Crie um Usuário de Teste:**
    * Use um script PHP temporário para gerar o hash da senha (ex: `password_hash("suasenha", PASSWORD_DEFAULT)`).
    * Insira o registro diretamente na tabela `usuarios` no phpMyAdmin, usando o **hash** gerado no campo `senha`.
    
### 2. Acessar a Aplicação

1.  Coloque a pasta `mini-crm` no diretório `htdocs` do seu servidor local.
2.  Acesse: `http://localhost/mini-crm/login.php`
3.  Faça login com o e-mail e senha do usuário que você criou (a senha que você usou para gerar o hash).

