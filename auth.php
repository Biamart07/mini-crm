<?php

//1. Incicialização da sessão e conexão com o banco de dados

session_start(); //Inicia o sistema de sessões PHP
require_once 'db_config.php'; //Inclui a conexão $pdo

echo $_SERVER['REQUEST_METHOD'];
//2. Verificação do método e dados
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: login.php");
    exit;
}

//3. Coleta e saneamento dos dados de login
//filter_input usado para "limpar" o email e senha
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$senha_pura = filter_input(INPUT_POST, 'senha', FILTER_DEFAULT);

//4. Preaparação e execução da busca

try {
    //SQL: Seleciona o ID, nome e o HASH da senha usando o email fornecido.
    //// Buscamos apenas pelo email, pois ele é UNIQUE e é o campo de login.
    $sql = "SELECT id, nome, email, senha FROM usuarios WHERE email = :email";
    $stmt = $pdo->prepare($sql);

    //Bindar email para segurança
    $stmt->bindValue(':email', $email);
    $stmt->execute();

    $usuario = $stmt->fetch();

    // LÓGICA DE AUTENTICAÇÃO

    if ($usuario) {
        //Usuário existe. Agora verificamos a senha

        //Melhor prática: password_verify()
        // Compara a senha PURA (digitada no form) com o HASH armazenado no DB.
        if (password_verify($senha_pura, $usuario['senha'])) {
            //Sucesso no login: cria a sessão
            $_SESSION['usuario_logado'] = true;
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];

            //Redireciona para a página principal
            header("Location: index.php");
            exit;
        }
    }
    //Falha no login: redireciona de volta a tela de login com uma flag de erro
    header("Location: login.php?erro=falha");
    exit;

} catch (\PDOException $e) {
    // Em caso de erro de banco (ex: problema na query ou conexão)
    error_log("Erro de Autenticação: " . $e->getMessage());
    header("Location: login.php?erro=falha_servidor");
    exit;
}

?>