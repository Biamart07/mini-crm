<div id="edit-modal" class="fixed inset-0 bg-gray-600 bg-opacity-75 hidden flex items-center justify-center z-50 transition-opacity duration-300">
    <div class="bg-white rounded-lg shadow-xl max-w-lg w-full m-4 transform transition-all duration-300 scale-95 opacity-0" id="modal-content">
        
        <div class="px-6 py-4 border-b flex justify-between items-center">
            <h3 class="text-xl font-bold text-gray-800">
                Editar Cliente
            </h3>
            <button id="close-modal" class="text-gray-400 hover:text-gray-600 focus:outline-none" title="Fechar Modal">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div class="p-6">
            <form id="edit-form" action="clientes.php" method="POST" class="space-y-4">
                
                <input type="hidden" id="edit-id" name="id" value=""> 
                <input type="hidden" name="acao" value="atualizar_cliente"> <div>
                    <label for="edit-nome" class="block text-sm font-medium text-gray-700">Nome Completo</label>
                    <input type="text" id="edit-nome" name="nome" required 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div>
                    <label for="edit-email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="edit-email" name="email" required 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <div>
                    <label for="edit-telefone" class="block text-sm font-medium text-gray-700">Telefone</label>
                    <input type="tel" id="edit-telefone" name="telefone" 
                           class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <button type="submit" 
                        class="w-full flex justify-center py-2 px-4 border border-transparent 
                               rounded-md shadow-sm text-sm font-medium text-white bg-green-600 
                               hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Salvar Alterações
                </button>
            </form>
        </div>
    </div>
</div>