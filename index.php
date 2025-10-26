<?php

//PROTEÇÃO DA PÁGINA PRINCIPAL COM SISTEMA DE LOGIN

//Inicia o sistema da sessão do PHP.
session_start();

//Verificação de autenticação
//Verifica se a váriavel de sessão "usuario_logado" existe e é verdadeira
if (!isset($_SESSION['usuario_logado']) || $_SESSION['usuario_logado'] !== true) {
    //Se o usuário não estiver logado, redireciona para a página de login
    header("Location: login.php");
    exit; //Termina a execução para que o conteúdo da página não seja carregado.
}

//Acesso concedido
$nome_usuario = $_SESSION['usuario_nome'] ?? 'Usuário';



// 1. INCLUSÃO DO CONTROLADOR: Precisamos dele para a função listarClientes()
require_once 'clientes.php';

// 2. CHAMADA DA FUNÇÃO: Busca todos os clientes e armazena no array $clientes
$clientes = listarClientes();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini-CRM | Cadastro</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@700&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="src/output.css">
</head>

<body class="bg-gray-100 p-8 md:p-4 font-[Roboto] transition-colors duration-500 dark:bg-gray-900 dark:text-gray-100">
    <nav class="bg-blue-800 shadow-lg sticky top-0 z-10 mb-10 dark:bg-gray-950 transition-colors duration-500">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="shrink-0 flex items-center">
                        <a href="index.php" class="text-blue-50 text-xl font-extrabold tracking-wider font-[Montserrat]">
                            Mini-CRM
                        </a>
                    </div>

                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8 font-[Montserrat]">
                        <a href="index.php" class="border-b-2 border-transparent text-blue-50 hover:border-white px-3 py-5 text-sm font-medium transition duration-150">
                            Clientes (Atual)
                        </a>
                        <a href="#" class="border-b-2 border-transparent text-gray-300 hover:border-gray-300 hover:text-white px-3 py-5 text-sm font-medium cursor-not-allowed">
                            Relatórios (Futuro)
                        </a>
                        <a href="#" class="border-b-2 border-transparent text-gray-300 hover:border-gray-300 hover:text-white px-3 py-5 text-sm font-medium cursor-not-allowed">
                            Configurações (Futuro)
                        </a>
                    </div>
                </div>

                <div class="hidden sm:ml-6 sm:flex sm:items-center">
                    <span class="text-gray-200 text-sm mr-4">
                        Bem-vindo(a), <span class="font-semibold"><?= htmlspecialchars($nome_usuario) ?></span>
                    </span>

                    <a href="logout.php"
                        class="py-2 px-4 border border-transparent rounded-md shadow-sm 
                              text-sm font-medium text-indigo-100 bg-red-700 
                              hover:bg-red-800 transition duration-150 ease-in-out font-[Montserrat]">
                        Logout
                    </a>
                </div>

                <div class="flex items-center sm:hidden">
                    <button id="mobile-menu-button" type="button"
                        class="inline-flex items-center justify-center p-2 rounded-md 
                                   text-indigo-200 hover:text-white hover:bg-blue-800 
                                   focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
                        aria-controls="mobile-menu" aria-expanded="false">
                        <span class="sr-only">Abrir menu principal</span>
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path id="hamburguer-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            <path id="close-icon" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <button id="theme-toggle" type="button"
                    class="p-2 rounded-full text-blue-100 hover:text-white dark:text-yellow-300 dark:hover:text-yellow-400 focus:outline-none transition-colors duration-500"
                    title="Alternar Modo Escuro">

                    <svg id="sun-icon" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <svg id="moon-icon" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z" />
                    </svg>
                </button>
            </div>
        </div>

        <div id="mobile-menu" class="hidden sm:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 font-[Montserrat]">
                <a href="index.php" class="bg-blue-900 text-white block px-3 py-2 rounded-md text-base font-medium">
                    Clientes
                </a>
                <a href="#" class="text-gray-300 hover:bg-indigo-500 hover:text-white block px-3 py-2 rounded-md text-base font-medium cursor-not-allowed">
                    Relatórios (Futuro)
                </a>
                <a href="#" class="text-gray-300 hover:bg-indigo-500 hover:text-white block px-3 py-2 rounded-md text-base font-medium cursor-not-allowed">
                    Configurações (Futuro)
                </a>

                <div class="border-t border-indigo-700 pt-3">
                    <span class="text-gray-300 block px-3 py-2 text-sm font-medium">Logado como: <?= htmlspecialchars($nome_usuario) ?></span>
                    <a href="logout.php"
                        class="mt-1 w-full flex justify-center py-2 px-4 border border-transparent 
                              rounded-md text-base font-medium text-white bg-red-600 hover:bg-red-700">
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto">

        <section class="bg-white shadow-lg rounded-xl p-6 mb-10 border border-indigo-200 dark:bg-gray-800 dark:border-gray-700 transition-colors duration-500">
            <h2 class="text-2xl font-semibold text-blue-800 mb-6 border-b pb-2 dark:text-blue-300 dark:border-gray-700">
                Cadastrar Novo Cliente
            </h2>

            <?php include 'create_form.php'; ?>

        </section>
        <section class="bg-white shadow-lg rounded-xl p-6 border border-gray-300 dark:bg-gray-800 dark:border-gray-700 transition-colors duration-500">
            <h2 class="text-2xl font-semibold text-gray-700 mb-6 border-b pb-2 dark:text-blue-50">
                Clientes Cadastrados (<?php echo count($clientes); ?>)
            </h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-blue-50 uppercase tracking-wider">
                                Nome
                            </th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-blue-50 uppercase tracking-wider hidden sm:table-cell">
                                Email
                            </th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-blue-50 uppercase tracking-wider hidden md:table-cell">
                                Telefone
                            </th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-blue-50 uppercase tracking-wider hidden md:table-cell">
                                Cadastro
                            </th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 dark:text-blue-50 uppercase tracking-wider">
                                Ações
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">

                        <?php if (empty($clientes)): ?>
                            <tr>
                                <td colspan="5" class="py-4 whitespace-nowrap text-center text-sm font-medium text-gray-500 dark:text-blue-50">
                                    Nenhum cliente cadastrado ainda. Comece a criar!
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($clientes as $cliente): ?>
                                <tr class="hover:bg-indigo-50 dark:hover:bg-gray-600">
                                    <td class="px-3 py-2 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-blue-200">
                                        <?= htmlspecialchars($cliente['nome']) ?>
                                    </td>
                                    <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500 dark:text-blue-50 hidden sm:table-cell">
                                        <?= htmlspecialchars($cliente['email']) ?>
                                    </td>
                                    <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500 dark:text-blue-50 hidden md:table-cell">
                                        <?= htmlspecialchars($cliente['telefone']) ?>
                                    </td>
                                    <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-400 dark:text-blue-100 hidden md:table-cell">
                                        <?= date('d/m/Y', strtotime($cliente['data_cadastro'])) ?>
                                    </td>
                                    <td class="px-3 py-2 whitespace-nowrap text-sm font-medium">
                                        <button type="button" class="btn-editar text-blue-800 dark:text-blue-500 hover:text-blue-600 dark:hover:text-blue-100 mr-2" data-id="<?= $cliente['id'] ?>">
                                            Editar
                                        </button>
                                        <a href="clientes.php?acao=deletar&id=<?= $cliente['id'] ?>" onclick="return confirm('Tem certeza que deseja excluir?')" class="text-red-600 hover:text-red-900">Excluir</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <?php include 'edit_modal.php'; ?>

    <script src="assets/js/script.js"></script>
</body>

</html>