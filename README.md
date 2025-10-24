# 🗄️ Mini-CRM: Sistema de Gestão de Clientes (CRUD PHP + Frontend Moderno)

## 🎯 Objetivo do Projeto

Este projeto foi desenvolvido como um exercício prático para solidificar os conhecimentos em **Back-End com PHP e MySQL (Banco de Dados)**, focando na implementação completa de um sistema **CRUD (Create, Read, Update, Delete)**.

**Principal Destaque (Diferencial Técnico):** A interface utiliza um front-end moderno (Tailwind CSS) e implementa a função de **Edição (Update)** através de um **Modal assíncrono (AJAX / JavaScript puro)**. Isso demonstra a capacidade de comunicar o Front-End com o Back-End de forma otimizada e sem a necessidade de recarregar a página.

---

## 🛠️ Tecnologias Utilizadas

**Back-End/Lógica:**
* **PHP (Linguagem):** Lógica do servidor, roteamento e funções CRUD.
* **MySQL/PDO:** Banco de dados para persistência de dados, com uso de *Prepared Statements* para segurança contra SQL Injection.

**Front-End/Design:**
* **HTML5:** Estrutura semântica e acessível.
* **Tailwind CSS:** Framework utilitário para a estilização rápida e responsiva.
* **JavaScript (Puro):** Responsável por manipular o DOM, exibir o modal de edição e gerenciar a comunicação assíncrona (AJAX / Fetch API) com o Back-End.

---

## ⚙️ Funcionalidades

O Mini-CRM suporta as 4 operações fundamentais de persistência de dados:

1.  **Criar (Create):** Formulário de adição de novos clientes com validação de campos obrigatórios (`NOT NULL` e `UNIQUE` para e-mail no DB).
2.  **Ler (Read):** Exibição de todos os clientes em uma tabela responsiva com ordenação.
3.  **Atualizar (Update) - Destaque!:** Edição dos dados de um cliente através de um Modal. O preenchimento do formulário no modal é feito via requisição **AJAX (JSON)** para melhor experiência do usuário (sem recarregar a página).
4.  **Deletar (Delete):** Remoção instantânea de um cliente com confirmação via Front-End.

---

## 🚀 Como Executar o Projeto Localmente

Siga os passos abaixo para colocar o Mini-CRM em funcionamento na sua máquina.

### Pré-requisitos
Você precisa ter um ambiente de desenvolvimento PHP instalado, como:
* **XAMPP, WAMP, ou MAMP.**

### 1. Configuração da Base de Dados

1.  Inicie o Apache e o MySQL no seu painel de controle do XAMPP.
2.  Acesse o **phpMyAdmin** (geralmente em `http://localhost/phpmyadmin`).
3.  Crie um novo banco de dados chamado **`mini_crm`**.
4.  Execute a seguinte instrução SQL na aba SQL do banco `mini_crm`:

```sql
CREATE TABLE clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    telefone VARCHAR(20),
    data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);