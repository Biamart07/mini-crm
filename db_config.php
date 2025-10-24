<?php

// 1. Configurações de Conexão
$host = 'localhost';
$db = 'mini_crm'; // O nome do banco que criado no phpmyadmin
$user = 'root'; // Usuário padrão do XAMPP para MySQL
$pass = ''; // Senha padrão do XAMPP para MySQL

// 🔑 Boa Prática: O charset é crucial para suportar acentuação (utf8mb4)
$charset = 'utf8mb4';

// Data Source Name (DSN) - String de conexão
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

// 2. Opções do PDO (Melhores Práticas)
$options = [
    // Define como os erros serão tratados. Lança exceções que podemos capturar (try/catch)
    // Isso é muito melhor do que ter que checar erros manualmente.
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,

    // Define o estilo de retorno. PDO::FETCH_ASSOC retorna um array com nomes de colunas como chaves.
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,

    // Desativa a emulação de prepared statements (mais seguro para evitar bugs)
    PDO::ATTR_EMULATE_PREPARES => false,
];

// 3. Estabelecer a Conexão

try {
    //Variável para armazenar a conexão
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    // Se a conexão falhar (ex: MySQL não está rodando no XAMPP)
     
     // 🛑 MODO DE DESENVOLVIMENTO: 
     // A linha abaixo exibe o erro completo, o que é útil para você, Beatriz, em desenvolvimento.
     // Em um projeto real, NUNCA mostre isso para o usuário final, apenas registre em um log!
     echo "Erro de Conexão com o Banco de Dados: ";
     throw new \PDOException($e->getMessage(), (int)$e->getCode());
     
     // Em um sistema real, você faria apenas:
     // die("Erro no servidor. Tente novamente mais tarde.");
}
