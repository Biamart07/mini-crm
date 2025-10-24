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

<button type="submit" 
        class="w-full flex justify-center py-2 px-4 border border-transparent 
                rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 
                 hover:bg-indigo-700 focus:outline-none focus:ring-2 
                focus:ring-offset-2 focus:ring-indigo-500 transition duration-150 ease-in-out">
    Salvar Cliente
</button>
</form>