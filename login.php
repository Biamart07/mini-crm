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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="src/output.css">
    <script>
        // Script para aplicar o tema antes da página carregar e evitar o "flash"
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</head>

<body class="bg-blue-50 flex items-center justify-center h-screen font-[Roboto] transition-colors duration-500 dark:bg-gray-900 dark:text-gray-100">

    <div class="absolute top-4 right-4">
        <button id="theme-toggle" type="button"
            class="p-2 rounded-full text-blue-800 dark:text-yellow-300 hover:bg-blue-100 dark:hover:bg-gray-700 focus:outline-none transition-colors duration-500"
            title="Alternar Modo Escuro">
            <svg id="sun-icon" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <svg id="moon-icon" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
            </svg>
        </button>
    </div>

    <div class="max-w-md w-full">
        <div class="bg-white p-8 rounded-lg shadow-2xl border border-indigo-200 dark:bg-gray-800 dark:border-gray-700">
            <h2 class="text-3xl font-extrabold text-blue-900 text-center mb-6 font-[Montserrat] dark:text-blue-200">
                Mini-CRM
            </h2>


            <form action="auth.php" method="POST" class="space-y-6">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">E-mail</label>
                    <input type="email" id="email" name="email" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:focus:ring-blue-400 dark:focus:border-blue-400"
                        placeholder="seu.email@teste.com">
                </div>

                <div>
                    <label for="senha" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Senha</label>
                    <input type="password" id="senha" name="senha" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:focus:ring-blue-400 dark:focus:border-blue-400"
                        placeholder="minhasenha123">
                </div>

                <?php if (isset($_GET['erro']) && $_GET['erro'] === 'falha'): ?>
                    <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg border border-red-400 dark:bg-red-200 dark:text-red-800 dark:border-red-500">
                        Falha no login! E-mail ou senha incorretos.
                    </div>
                <?php endif; ?>

                <button type="submit"
                    class="w-full flex justify-center py-2 px-4 border border-transparent 
                               rounded-md shadow-sm text-sm font-medium text-white bg-blue-800
                               hover:bg-blue-700 focus:outline-none focus:ring-2 
                               focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out
                               dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-offset-gray-800">
                    Entrar no Sistema
                </button>
            </form>
        </div>
    </div>

    <script src="assets/js/script.js"></script>
</body>

</html>