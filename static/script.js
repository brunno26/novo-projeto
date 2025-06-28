document.addEventListener('DOMContentLoaded', function () {
    // Seleciona os blocos principais
    const seletorInicial = document.getElementById('seletor-inicial');
    const blocoFormulario = document.getElementById('bloco-formulario');
    
    // Seleciona os botões
    const btnReceita = document.getElementById('btn-receita');
    const btnDespesa = document.getElementById('btn-despesa');
    
    // Elementos internos do formulário
    const formTitle = document.getElementById('form-title');
    const tipoLancamentoInput = document.getElementById('tipo_lanc_hidden');
    const formaPagamentoContainer = document.getElementById('forma-pagamento-container');
    const formaPagamentoSelect = document.getElementById('forma_pag');
    const bancoContainer = document.getElementById('banco-container');
    const cartaoContainer = document.getElementById('cartao-container');

    function selecionarTipo(tipo) {
        // Ação principal: esconde o seletor e mostra o formulário
        seletorInicial.style.display = 'none';
        blocoFormulario.style.display = 'block';

        tipoLancamentoInput.value = tipo;
        
        if (tipo === 'receita') {
            formTitle.innerText = 'NOVA RECEITA';
            if(formaPagamentoContainer) formaPagamentoContainer.style.display = 'none';
        } else if (tipo === 'despesa') {
            formTitle.innerText = 'NOVA DESPESA';
            if(formaPagamentoContainer) formaPagamentoContainer.style.display = 'block';
        }
    }

    btnReceita.addEventListener('click', () => selecionarTipo('receita'));
    btnDespesa.addEventListener('click', () => selecionarTipo('despesa'));

    function atualizarVisibilidadePagamento() {
        if (!formaPagamentoSelect) return;
        const valorSelecionado = formaPagamentoSelect.value;
        bancoContainer.style.display = 'none';
        cartaoContainer.style.display = 'none';
        if (valorSelecionado === 'cartao_credito') {
            cartaoContainer.style.display = 'block';
        } else if (['pix', 'transferencia', 'cartao_debito'].includes(valorSelecionado)) {
            bancoContainer.style.display = 'block';
        }
    }
    if (formaPagamentoSelect) {
        formaPagamentoSelect.addEventListener('change', atualizarVisibilidadePagamento);
    }
    atualizarVisibilidadePagamento();
});