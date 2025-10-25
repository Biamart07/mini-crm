<form action="clientes.php" method="POST" class="space-y-4">

<div>
   <label for="nome" class="block text-sm font-medium text-gray-700">Nome Completo</label>
   <input type="text" id="nome" name="nome" required
        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
            focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
        placeholder="Seu nome é obrigatório"
        aria-required="true">
</div>

<div>
    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
    <input type="email" id="email" name="email" required 
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            placeholder="email@exemplo.com"
            aria-required="true">
</div>

<div>
    <label for="telefone" class="block text-sm font-medium text-gray-700">Telefone (Opcional)</label>
    <input type="tel" id="telefone" name="telefone" 
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm 
                focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
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
                $class = "bg-green-100 border-green-400 text-green-700";
            } elseif ($status === 'deleted') {
                $message = "Sucesso! O cliente foi excluído permanentemente.";
                $class = "bg-red-100 border-red-400 text-red-700";
            } elseif ($status === 'success') {
                $message = "Sucesso! Novo cliente cadastrado com êxito.";
                $class = "bg-green-100 border-green-400 text-green-700";
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
                rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 
                 hover:bg-indigo-700 focus:outline-none focus:ring-2 
                focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
    Salvar Cliente
</button>
</form>