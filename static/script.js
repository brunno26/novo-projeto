document.addEventListener("DOMContentLoaded", function () {
    const modalEscolha = new bootstrap.Modal(document.getElementById("modalEscolha"));
    const modalFormulario = new bootstrap.Modal(document.getElementById("modalFormulario"));

    const btnReceita = document.getElementById("btn-receita");
    const btnDespesa = document.getElementById("btn-despesa");

    btnReceita.addEventListener("click", function () {
      document.getElementById("form-title").textContent = "Nova Receita";
      document.getElementById("tipo_lanc_hidden").value = "receita";
      modalEscolha.hide();
      modalFormulario.show();
    });

    btnDespesa.addEventListener("click", function () {
      document.getElementById("form-title").textContent = "Nova Despesa";
      document.getElementById("tipo_lanc_hidden").value = "despesa";
      modalEscolha.hide();
      modalFormulario.show();
    });

    const btnAbrirLancamento = document.getElementById("abrir-lancamento");
    if (btnAbrirLancamento) {
      btnAbrirLancamento.addEventListener("click", function (e) {
        e.preventDefault(); // previne o redirecionamento
        modalEscolha.show();
      });
    }
  });