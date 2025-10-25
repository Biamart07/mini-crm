<?php

session_start(); // Inicia a sessão para garantir que ela pode ser manipulada

// 1. Destrói todas as variáveis de sessão
$_SESSION = array();

// 2. Se for necessário destruir o cookie de sessão (para fechar completamente)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 3. Destrói a sessão
session_destroy();

// 4. Redireciona o usuário para a tela de login
header("Location: login.php");
exit;
?>