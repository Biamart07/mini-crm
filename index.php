<?php 
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


    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">
            Gestão de Clientes (CRUD PHP)
        </h1>

        <?php 
            // Bloco de Mensagens de Feedback
            if (isset($_GET['status'])) {
                $status = $_GET['status'];
                $message = '';
                $class = '';

                // Mensagens de SUCESSO
                if ($status === 'updated') {
                    $message = "Sucesso! O cliente foi atualizado com sucesso.";
                    $class = "bg-green-100 border-green-400 text-green-700";
                } elseif ($status === 'deleted') {
                    $message = "Sucesso! O cliente foi excluído permanentemente.";
                    $class = "bg-red-100 border-red-400 text-red-700";
                } elseif ($status === 'success') {
                    $message = "Sucesso! Novo cliente cadastrado com êxito.";
                    $class = "bg-blue-100 border-blue-400 text-blue-700";
                } 
                
                // Mensagens de ERRO
                elseif ($status === 'update_error_duplicate_email') {
                    $message = "Falha na Edição: O e-mail que você tentou usar já está cadastrado em outro cliente. E-mail deve ser único.";
                    $class = "bg-yellow-100 border-yellow-400 text-yellow-700";
                } elseif (strpos($status, 'error') !== false) {
                    $message = "Ocorreu um erro na operação. Por favor, tente novamente ou contate o suporte.";
                    $class = "bg-red-100 border-red-400 text-red-700";
                }

                if ($message): // Se houver mensagem para exibir
            ?>
                <div id="feedback-message" class="p-4 mb-4 border-l-4 <?= $class ?> rounded-md" role="alert">
                    <p class="font-bold">Aviso do Sistema</p>
                    <p><?= htmlspecialchars($message) ?></p>
                </div>
            <?php 
                endif;
            }
            ?>

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
            <div class="overflow-x-auto"> <table class="min-w-full divide-y divide-gray-200">
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