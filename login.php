<?php 
// Inicia o sistema de sessão do PHP (fundamental para o login!)
session_start(); 

// Se o usuário já estiver logado, redireciona para a página principal
if (isset($_SESSION['usuario_logado']) && $_SESSION['usuario_logado'] === true) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini-CRM | Login</title>
    <link rel="stylesheet" href="src/output.css">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="max-w-md w-full">
        <div class="bg-white p-8 rounded-lg shadow-2xl border border-indigo-200">
            <h2 class="text-3xl font-extrabold text-gray-900 text-center mb-6">
                Acesso Restrito ao Mini-CRM
            </h2>
            
            <?php if (isset($_GET['erro']) && $_GET['erro'] === 'falha'): ?>
                <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg border border-red-400">
                    Falha no login! E-mail ou senha incorretos.
                </div>
            <?php endif; ?>

            <form action="auth.php" method="POST" class="space-y-6">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">E-mail</label>
                    <input type="email" id="email" name="email" required 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                           placeholder="seu.email@teste.com">
                </div>

                <div>
                    <label for="senha" class="block text-sm font-medium text-gray-700">Senha</label>
                    <input type="password" id="senha" name="senha" required 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                           placeholder="minhasenha123">
                </div>
                
                <button type="submit" 
                        class="w-full flex justify-center py-2 px-4 border border-transparent 
                               rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 
                               hover:bg-indigo-700 focus:outline-none focus:ring-2 
                               focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
                    Entrar no Sistema
                </button>
            </form>
        </div>
    </div>

</body>
</html>