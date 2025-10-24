# 🗄️ Mini-CRM: Sistema de Gestão de Clientes (CRUD PHP + Frontend Moderno)

## 🎯 Objetivo do Projeto

Este projeto foi desenvolvido como um exercício prático para solidificar os conhecimentos em **Back-End com PHP e MySQL (Banco de Dados)**, focando na implementação completa de um sistema **CRUD (Create, Read, Update, Delete)** de forma segura e com atenção à experiência do usuário (UX).

**Principais Destaques para o Portfólio:**
1.  **Segurança e Integridade de Dados (Back-End):** Uso obrigatório do padrão **PDO** com *Prepared Statements* para prevenir **SQL Injection**.
2.  **Experiência de Usuário Otimizada (Front-End):** O recurso de **Edição (Update)** é implementado de forma assíncrona (via **AJAX / Fetch API**), preenchendo um Modal sem recarregar a página, resultando em uma navegação fluida.
3.  **Polimento da Interface:** Mensagens de sucesso/erro que **desaparecem automaticamente** após 5 segundos, garantindo uma UI limpa e moderna.

---

## 🛠️ Tecnologias Utilizadas

**Back-End/Lógica:**
* **PHP (Linguagem):** Lógica do servidor, roteamento e funções CRUD.
* **MySQL/PDO:** Banco de dados para persistência de dados, com uso de *Prepared Statements* para segurança contra SQL Injection.

**Front-End/Design & Interatividade:**
* **HTML5:** Estrutura semântica e acessível (A11y).
* **Tailwind CSS:** Framework utilitário para estilização **Mobile-First** e responsiva.
* **JavaScript (Puro / Fetch API):** Responsável por manipular o DOM, gerenciar o Modal de Edição e fazer a comunicação assíncrona (AJAX) para o UPDATE.

---

## ⚙️ Funcionalidades CRUD Implementadas

O Mini-CRM suporta todas as 4 operações fundamentais (**C-R-U-D**):

| Operação | Descrição | Implementação Técnica |
| :--- | :--- | :--- |
| **Criar (Create)** | Adiciona um novo registro de cliente. | `POST` para `clientes.php`. Usa `filter_input` e *Prepared Statements*. |
| **Ler (Read)** | Exibe a lista completa de clientes. | `SELECT` e laço `foreach` no `index.php`. Uso de `htmlspecialchars` para prevenção de XSS. |
| **Atualizar (Update)** | Edita os dados de um cliente existente. | Fluxo **AJAX (GET)** para buscar o JSON -> Preenchimento do Modal -> **POST** para salvar no `clientes.php`. |
| **Deletar (Delete)** | Remove um registro permanentemente. | Requisição `GET` com ID validado e `DELETE` seguro no Back-End. |

---

## ✨ Melhorias de UX e Boas Práticas

* **Validação em Camadas:** Validações de campos (`NOT NULL` e `UNIQUE`) no nível do banco de dados (MySQL) e no nível da aplicação (PHP).
* **Tratamento de Erros:** Captura de exceções PDO para tratamento de erros comuns, como a duplicação de e-mail.
* **Design Responsivo:** Layout totalmente funcional e otimizado para dispositivos móveis (`overflow-x-auto` para a tabela e classes de responsividade do Tailwind CSS).
* **Feedback Inteligente:** Mensagens de sucesso ou erro que **desaparecem automaticamente** após 5 segundos, usando `setTimeout` no JavaScript.

---

## 🚀 Como Executar o Projeto Localmente

### Pré-requisitos
* **XAMPP, WAMP, ou MAMP** (com Apache e MySQL em execução).

### Instalação e Configuração

1.  **Clone o Repositório:**
    ```bash
    git clone [LINK DO SEU REPOSITÓRIO] mini-crm
    ```
2.  **Mova para htdocs:** Copie a pasta `mini-crm` para o diretório `htdocs` do seu XAMPP.
3.  **Configuração do Banco (MySQL):**
    * Acesse o phpMyAdmin.
    * Crie o banco de dados chamado **`mini_crm`**.
    * Execute o SQL para criar a tabela `clientes`:
        ```sql
        CREATE TABLE clientes (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(100) NOT NULL,
            email VARCHAR(100) UNIQUE NOT NULL,
            telefone VARCHAR(20),
            data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );
        ```
4.  **Verifique a Conexão:** O arquivo `db_config.php` está configurado para o padrão do XAMPP (`user='root', pass=''`).

### Acessar a Aplicação

Abra seu navegador e acesse: `http://localhost/mini-crm/index.php`