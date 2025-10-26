<form action="clientes.php" method="POST" class="space-y-4">

    <div>
        <label for="nome" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nome Completo</label>
        <input type="text" id="nome" name="nome" required
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
            focus:outline-none focus:ring-blue-800 focus:border-blue-800 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:focus:ring-blue-400 dark:focus:border-blue-400"
            placeholder="Seu nome é obrigatório"
            aria-required="true">
    </div>

    <div>
        <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
        <input type="email" id="email" name="email" required
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                focus:outline-none focus:ring-blue-800 focus:border-blue-800 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:focus:ring-blue-400 dark:focus:border-blue-400"
            placeholder="email@exemplo.com"
            aria-required="true">
    </div>

    <div>
        <label for="telefone" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Telefone (Opcional)</label>
        <input type="tel" id="telefone" name="telefone"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                focus:outline-none focus:ring-blue-800 focus:border-blue-800 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-100 dark:focus:ring-blue-400 dark:focus:border-blue-400"
            placeholder="(XX) XXXXX-XXXX">
    </div>

    <input type="hidden" name="acao" value="criar_cliente">

    <?php
    // Bloco de Mensagens de Feedback
    if (isset($_GET['status'])) {
        $status = $_GET['status'];
        $message = '';
        $class = '';

        // Mensagens de SUCESSO
        if ($status === 'updated') {
            $message = "Sucesso! O cliente foi atualizado com sucesso.";
            $class = "bg-emerald-100 border-emerald-400 text-emerald-700";
        } elseif ($status === 'deleted') {
            $message = "Sucesso! O cliente foi excluído permanentemente.";
            $class = "bg-red-100 border-red-400 text-red-700";
        } elseif ($status === 'success') {
            $message = "Sucesso! Novo cliente cadastrado com êxito.";
            $class = "bg-emerald-100 border-emerald-400 text-emerald-700";
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

    <button type="submit"
        class="w-full flex justify-center py-2 px-4 border border-transparent 
                rounded-md shadow-sm text-sm font-medium text-white bg-blue-800 
                 hover:bg-blue-500 focus:outline-none focus:ring-2 
                focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out
                dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-offset-gray-800">
        Salvar Cliente
    </button>
</form>