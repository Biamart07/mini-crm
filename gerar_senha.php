<?php

// Defina a senha que você deseja usar
$senha_plana = 'beatriz'; //  <-- TROQUE PARA A SENHA DESEJADA

// Gera o hash da senha
$hash = password_hash($senha_plana, PASSWORD_DEFAULT);

// Exibe o hash gerado
echo "Senha Plana: " . $senha_plana . "<br>";
echo "Hash Gerado: " . $hash;

?>