document.addEventListener('DOMContentLoaded', () => {
    const editModal = document.getElementById('edit-modal');
    const modalContent = document.getElementById('modal-content');
    const closeModalButton = document.getElementById('close-modal');

    // Inputs do formulário de edição
    const editIdInput = document.getElementById('edit-id');
    const editNomeInput = document.getElementById('edit-nome');
    const editEmailInput = document.getElementById('edit-email');
    const editTelefoneInput = document.getElementById('edit-telefone');

    // --- 1. Lógica para Abrir/Fechar Modal ---

    //Função para fechar o modal
    const fecharModal = () => {
        modalContent.classList.remove('scale-100', 'opacity-100');
        modalContent.classList.add('scale-95', 'opacity-0');
        //Oculta completamente após transição
        setTimeout(() => {
            editModal.classList.add('hidden');
        }, 300);
    };

    closeModalButton.addEventListener('click', fecharModal);

    //Fechar ao clicar fora do modal
    editModal.addEventListener('click', (e) => {
        if (e.target.id === 'edit-modal') {
            fecharModal();
        }
    });

    // --- 2. Lógica Principal: Intercepta o clique no botão 'Editar' ---

    document.body.addEventListener('click', async (e) => {
        if (e.target.classList.contains('btn-editar')) {
            const clienteId = e.target.getAttribute('data-id');

            try {
                const response = await fetch(`clientes.php?acao=buscar&id=${clienteId}`);

                if(!response.ok) {
                    throw new Error(`Erro no servidor! Status: ${response.status}`);
                }

                const result = await response.json();

                if (result.success) {
                    const cliente = result.data;

                    // Preencher o Formulário do Modal com os dados retornados
                    editIdInput.value = cliente.id;
                    editNomeInput.value = cliente.nome;
                    editEmailInput.value = cliente.email;
                    // Telefone é opcional, garantimos que não é 'null' no Front-End
                    editTelefoneInput.value = cliente.telefone || '';

                    // Exibir o Modal (com animação)
                    editModal.classList.remove('hidden');
                    // Timeout para garantir que a transição seja animada
                    setTimeout(() => {
                        modalContent.classList.remove('scale-95', 'opacity-0');
                        modalContent.classList.add('scale-100', 'opacity-100');
                    }, 10);
                } else {
                    alert(`Erro ao carregar dados do cliente: ${result.message}`);
                }
            } catch (error) {
                console.error('Falha na requisição de busca:', error);
                alert('Ocorreu um erro ao tentar buscar os dados do cliente.');
            }
        }
    });

});