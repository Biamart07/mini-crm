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

//Efeito Fade-out para as mensagens de aviso
document.addEventListener('DOMContentLoaded', () => {
    
    // Pega o elemento da mensagem de feedback pelo ID
    const feedbackMessage = document.getElementById('feedback-message');
    
    // Verifica se a mensagem existe na página
    if (feedbackMessage) {
        
        // Define o tempo em milissegundos (ex: 5000ms = 5 segundos)
        const tempoParaDesaparecer = 5000; 

        // Usa setTimeout para executar uma função após o tempo definido
        setTimeout(() => {
            
            // 🔑 O que faz a mágica: Remove a classe 'p-4' e adiciona 'opacity-0' 
            // e 'transition-opacity' para iniciar um efeito de fade out suave.
            feedbackMessage.classList.remove('p-4');
            feedbackMessage.classList.add('opacity-0', 'transition-opacity', 'duration-500');

            // Depois do fade out (500ms), remove o elemento completamente para limpar o espaço
            setTimeout(() => {
                feedbackMessage.remove(); // Remove o elemento do HTML
            }, 500); // Espera 500ms para o efeito de transição terminar

        }, tempoParaDesaparecer);
    }

    // --- Lógica do Menu Hamburguer ---
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const hamburguerIcon = document.getElementById('hamburguer-icon');
    const closeIcon = document.getElementById('close-icon');

    if (mobileMenuButton) {
        mobileMenuButton.addEventListener('click', () => {
            
            // 1. Alterna a visibilidade do menu (adiciona/remove a classe 'hidden')
            mobileMenu.classList.toggle('hidden');
            
            // 2. Alterna os ícones
            const isMenuOpen = !mobileMenu.classList.contains('hidden');
            
            if (isMenuOpen) {
                // Menu está aberto: Mostra o ícone de 'fechar' (X)
                hamburguerIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
                mobileMenuButton.setAttribute('aria-expanded', 'true');
            } else {
                // Menu está fechado: Mostra o ícone 'hamburguer' (3 linhas)
                hamburguerIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
                mobileMenuButton.setAttribute('aria-expanded', 'false');
            }
        });
    }
});


//Lógica para Dark Mode

const html = document.documentElement;
const themeToggle = document.getElementById('theme-toggle');
const sunIcon = document.getElementById('sun-icon');
const moonIcon = document.getElementById('moon-icon');

// Função para aplicar o tema e alternar ícones
const switchTheme = (isDark) => {
    if (isDark) {
        html.classList.add('dark');
        sunIcon.classList.remove('hidden');
        moonIcon.classList.add('hidden');
        localStorage.setItem('theme', 'dark');
    } else {
        html.classList.remove('dark');
        sunIcon.classList.add('hidden');
        moonIcon.classList.remove('hidden');
        localStorage.setItem('theme', 'light');
    }
};

// 1. Aplicar o tema na carga (Leitura do localStorage)
const currentTheme = localStorage.getItem('theme');

// Verifica a preferência do sistema se não houver no localStorage (Melhor Prática!)
if (currentTheme === 'dark' || (!currentTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    switchTheme(true);
} else {
    switchTheme(false);
}

// 2. Listener do botão de toggle
if (themeToggle) {
    themeToggle.addEventListener('click', () => {
        // Pega o estado atual antes de alternar
        const isDark = html.classList.contains('dark');
        // Alterna para o estado oposto e salva
        switchTheme(!isDark);
    });
}