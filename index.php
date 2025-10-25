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
    <link rel="stylesheet" href="src/output.css">
</head>

<body class="bg-gray-100 p-8 md:p-4">
    <nav class="bg-indigo-600 shadow-lg sticky top-0 z-10 mb-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="shrink-0 flex items-center">
                        <a href="index.php" class="text-white text-xl font-extrabold tracking-wider">
                            Mini-CRM
                        </a>
                    </div>

                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8">
                        <a href="index.php" class="border-b-2 border-transparent text-white hover:border-white px-3 py-5 text-sm font-medium transition duration-150">
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
                        Olá, <span class="font-semibold"><?= htmlspecialchars($nome_usuario) ?></span>
                    </span>

                    <a href="logout.php"
                        class="py-2 px-4 border border-transparent rounded-md shadow-sm 
                              text-sm font-medium text-indigo-100 bg-red-600 
                              hover:bg-red-700 transition duration-150 ease-in-out">
                        Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto">

        <section class="bg-white shadow-lg rounded-xl p-6 mb-10 border border-indigo-200">
            <h2 class="text-2xl font-semibold text-indigo-600 mb-6 border-b pb-2">
                Cadastrar Novo Cliente
            </h2>

            <?php include 'create_form.php'; ?>

        </section>
        <section class="bg-white shadow-lg rounded-xl p-6 border border-gray-300">
            <h2 class="text-2xl font-semibold text-gray-700 mb-6 border-b pb-2">
                Clientes Cadastrados (<?php echo count($clientes); ?>)
            </h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nome
                            </th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden sm:table-cell">
                                Email
                            </th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">
                                Telefone
                            </th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">
                                Cadastro
                            </th>
                            <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Ações
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                        <?php if (empty($clientes)): ?>
                            <tr>
                                <td colspan="5" class="py-4 whitespace-nowrap text-center text-sm font-medium text-gray-500">
                                    Nenhum cliente cadastrado ainda. Comece a criar!
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($clientes as $cliente): ?>
                                <tr class="hover:bg-indigo-50">
                                    <td class="px-3 py-2 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <?= htmlspecialchars($cliente['nome']) ?>
                                    </td>
                                    <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500 hidden sm:table-cell">
                                        <?= htmlspecialchars($cliente['email']) ?>
                                    </td>
                                    <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-500 hidden md:table-cell">
                                        <?= htmlspecialchars($cliente['telefone']) ?>
                                    </td>
                                    <td class="px-3 py-2 whitespace-nowrap text-sm text-gray-400 hidden md:table-cell">
                                        <?= date('d/m/Y', strtotime($cliente['data_cadastro'])) ?>
                                    </td>
                                    <td class="px-3 py-2 whitespace-nowrap text-sm font-medium">
                                        <button type="button" class="btn-editar text-indigo-600 hover:text-indigo-900 mr-2" data-id="<?= $cliente['id'] ?>">
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