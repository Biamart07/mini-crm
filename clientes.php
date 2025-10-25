<?php

// Conexão com o Banco de Dados
// Sem este arquivo, não temos o objeto $pdo para salvar os dados.

require_once 'db_config.php';



// Função principal para criar um novo cliente (CREATE)


function criarCliente() {
    global $pdo; // Torna o objeto de conexão $pdo acessível dentro da função

  
    // COLETA E SANEAMENTO DOS DADOS
  

    // Boa Prática: usar filter_input para obter e limpar os dados de uma só vez.
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // VALIDAÇÃO BÁSICA
    if (!$nome || !$email) {
        // Encerra a execução e dá um feedback
        die("Erro: Nome e E-mail são obrigatórios.");
    }

    // VALIDAÇÃO DE FORMATO DE E-MAIL
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Erro: O formato do e-mail é inválido.");
    }

    
    // INSERÇÃO SEGURA NO BANCO (PREPARED STATEMENT)
    

    try {
        // SQL com placeholders nomeados (:nome, :email, :telefone)
        $sql = "INSERT INTO clientes (nome, email, telefone) VALUES (:nome, :email, :telefone)";

        // 5a. Prepara a query (separa a estrutura SQL dos dados)
        $stmt = $pdo->prepare($sql);

        //5b. Liga os valores aos placeholders
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':email', $email);
        // O telefone é opcional. Se for nulo/vazio, bindamos como NULL para o banco
        $stmt->bindValue(':telefone', $telefone ?: NULL);

        //5c. Executa a query
        $stmt->execute();

        // 6. SUCESSO E REDIRECIONAMENTO (PADRÃO PRG)
        // Redireciona de volta para a página principal. 
        // header("Location: index.php?status=success");
        header("Location: index.php");
        exit;
    } catch (\PDOException $e) {
        // 7. TRATAMENTO DE ERRO: Útil para erros como EMAIL DUPLICADO (UNIQUE KEY)
        //O código 23000 é o código SQL que significa "Integrity Constraint Violation", ou seja, um erro de regra, como a tentativa de inserir um e-mail duplicado
        if ($e->getCode() === '23000') {
            die("Erro de Inserção: O e-mail '{$email}' já está cadastrado. (Restrição UNIQUE do DB)");
        }
        // Para outros erros (conexão, sintaxe, etc.)
        die("Erro inesperado no banco de dados: " . $e->getMessage());
    }
}


// Função principal para listar todos os clientes (READ)

function listarClientes() {

    global $pdo; // Acessa o objeto de conexão PDO

    try {
        // 1. A Consulta SQL
        // Selecionamos todos os campos e ordenamos pelo nome (boa usabilidade)
        $sql = "SELECT id, nome, email, telefone, data_cadastro FROM clientes ORDER BY nome ASC";

        //2. Executa a query
        $stmt = $pdo->query($sql);

        //3. Retorna os dados com um array associativo
        return $stmt->fetchAll();

    } catch (\PDOException $e) {
        // Em caso de erro na consulta, retornamos um array vazio e registramos o erro
        error_log("Erro ao listar clientes: " . $e->getMessage());
        return []; // Retorna array vazio para não quebrar a aplicação
    
    }

}


// Função para deletar um cliente (DELETE)

function deletarCliente($id) {
    global $pdo;

    try {
        // 1. O SQL com PLACEHOLDERS. O '?' é o placeholder posicional.
        $sql = "DELETE FROM clientes WHERE id = ?";

        //2. Prepara a query
        $stmt = $pdo->prepare($sql);

        // 3. Executa a query, passando os dados separadamente (SEGURANÇA!)
        // O ID é o único parâmetro, então passamos ele em um array.
        return $stmt->execute([$id]);
    } catch (\PDOException $e) {
        // Boa Prática: Em caso de erro de banco, não quebra o sistema, apenas registra o erro
        error_log("Erro ao deletar cliente: com ID {$id}: " . $e->getMessage());
        return false;
    }
}


//Função para buscar um cliente pelo ID (Utilizada para carregar o modal de edição)

function buscarClientePorId($id) {
    global $pdo;

    try {
        $sql = "SELECT id, nome, email, telefone FROM clientes WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        // fetch() retorna a primeira (e única) linha como um array associativo
        return $stmt->fetch();
    } catch (\PDOException $e) {
        error_log("Erro ao buscar cliente por ID {$id}:" . $e->getMessage());
        return false;
    }
}


// Função para atualizar um cliente (UPDATE)

function atualizarCliente() {
    global $pdo;

    //COLETA E SANEAMENTO DOS DADOS
    // O ID é o mais importante aqui, ele garante que estamos editando o registro certo.
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT); 
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $telefone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // VALIDAÇÃO ESSENCIAL
    if (!$id || !$nome || !$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Se a validação falhar, redireciona com um status de erro
        header("Location: index.php?status=update_error_validation");
        exit;
    }

    // ATUALIZAÇÃO SEGURA NO BANCO (PREPARED STATEMENT)
    try {
        // SQL com placeholders nomeados
        // A cláusula WHERE id = :id é CRÍTICA, pois diz ao banco qual linha atualizar.
        $sql = "UPDATE clientes SET nome = :nome, email = :email, telefone = :telefone WHERE id = :id";
        
        $stmt = $pdo->prepare($sql);
        
        // Liga os valores aos placeholders
        $stmt->bindValue(':id', $id, PDO::PARAM_INT); // ID é um número (INT)
        $stmt->bindValue(':nome', $nome);
        $stmt->bindValue(':email', $email);
        // Se o telefone for vazio, o PHP insere NULL, o que é o ideal para campos opcionais no DB
        $stmt->bindValue(':telefone', $telefone ?: NULL); 
        
        $stmt->execute();
        
        // SUCESSO: Redireciona com um status de sucesso (PRG Pattern)
        header("Location: index.php?status=updated");
        exit;

    } catch (\PDOException $e) {
        // TRATAMENTO DE ERRO: E-mail Duplicado
        if ($e->getCode() === '23000') {
             header("Location: index.php?status=update_error_duplicate_email");
             exit;
        }
        // Outros erros
        error_log("Erro no UPDATE: " . $e->getMessage());
        header("Location: index.php?status=update_error_db");
        exit;
    }
}


// CONTROLADOR PRINCIPAL: Processa as Requisições


// 1. Processa Requisições POST (Criação e Edição)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    if (isset($_POST['acao'])) {
        
        // Ação 1: CRIAÇÃO (CREATE)
        if ($_POST['acao'] === 'criar_cliente') {
            criarCliente();
        }
        
        // Ação 2: ATUALIZAÇÃO (UPDATE)
        if ($_POST['acao'] === 'atualizar_cliente') {
            atualizarCliente(); // <--- CHAMA A NOVA FUNÇÃO
        }
    }
}

// 2. Processa Requisições GET
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['acao'])) {
    
   
    // Lógica 1: DELETAR

    if ($_GET['acao'] === 'deletar') {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if ($id && deletarCliente($id)) {
            header("Location: index.php?status=deleted");
            exit;
        } else {
            // Em caso de erro de deleção
            header("Location: index.php?status=delete_error");
            exit;
        }
    }


    // Lógica 2: BUSCAR DADOS PARA EDIÇÃO
    
    if ($_GET['acao'] === 'buscar') {
        // 🔑 ESSENCIAL: Diz ao navegador que a resposta é um objeto de dados (JSON)
        header('Content-Type: application/json');
        
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        
        if (!$id) {
            echo json_encode(['success' => false, 'message' => 'ID inválido ou ausente.']);
            http_response_code(400); // Bad Request
            exit;
        }
        
        $cliente = buscarClientePorId($id);
        
        if ($cliente) {
            echo json_encode(['success' => true, 'data' => $cliente]);
            exit;
        } else {
            echo json_encode(['success' => false, 'message' => 'Cliente não encontrado.']);
            http_response_code(404); // Not Found
            exit;
        }
    }
}


?>