document.addEventListener("DOMContentLoaded", function () {
    const modalEscolha = new bootstrap.Modal(document.getElementById("modalEscolha"));
    const modalFormulario = new bootstrap.Modal(document.getElementById("modalFormulario"));
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

    const btnReceita = document.getElementById("btn-receita");
    const btnDespesa = document.getElementById("btn-despesa");

    // Lógica para o botão de Receita
    if (btnReceita) {
        btnReceita.addEventListener("click", function () {
            document.getElementById("form-title").textContent = "Nova Receita";
            
            // ===== CORREÇÃO AQUI =====
            // Pega o ID do atributo "data-tipo-id" do botão clicado
            document.getElementById("tipo_lanc_hidden").value = this.dataset.tipoId; 

            modalEscolha.hide();
            modalFormulario.show();
        });
    }

    // Lógica para o botão de Despesa
    if (btnDespesa) {
        btnDespesa.addEventListener("click", function () {
            document.getElementById("form-title").textContent = "Nova Despesa";
            
            // ===== CORREÇÃO AQUI =====
            // Pega o ID do atributo "data-tipo-id" do botão clicado
            document.getElementById("tipo_lanc_hidden").value = this.dataset.tipoId;

            modalEscolha.hide();
            modalFormulario.show();
        });
    }

    // O restante do seu código para abrir o modal de escolha
    const btnAbrirLancamento = document.getElementById("abrir-lancamento");
    if (btnAbrirLancamento) {
        btnAbrirLancamento.addEventListener("click", function (e) {
            e.preventDefault(); 
            modalEscolha.show();
        });
    }
});