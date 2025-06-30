<!doctype html>
<html lang="pt-br">

<head>
  <title>Novo Lançamento</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

  <link rel="stylesheet" href="static/style.css">

</head>

<body>
  <!-- Modal 1: Escolha Receita ou Despesa -->
  <div class="modal fade" id="modalEscolha" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center p-4">
            <div class="modal-header">
                <h5 class="modal-title">Novo Lançamento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center mt-3">
                    <button type="button" class="btn-imagem btn btn-light mx-2" id="btn-receita">
                        <img src="images/receita.png" alt="Nova Receita">
                    </button>
                    <button type="button" class="btn-imagem btn btn-light mx-2" id="btn-despesa">
                        <img src="images/despesa.png" alt="Nova Despesa">
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalFormulario" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content p-4">
            <div class="modal-header">
                <h5 class="modal-title" id="form-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="row" method="post" action="index.php" id="lancamentoForm">
                
                    <input type="hidden" name="tipo_lanc" id="tipo_lanc_hidden">

                    <div class="form-group col-12 mb-3">
                        <label for="plano_contas" class="form-label">Plano de contas:</label>
                        <select class="form-control" name="plano_contas" id="plano_contas" required>
                            <option value="" disabled selected>Selecione o plano de contas</option>
                            <option value="salario">Salário</option>
                            <option value="aluguel">Aluguel</option>
                            <option value="supermercado">Supermercado</option>
                        </select>
                    </div>

                    <div class="form-group col-12 mb-3">
                        <label for="desc_lanc" class="form-label">Descrição do lançamento:</label>
                        <input type="text" required name="desc_lanc" class="form-control" id="desc_lanc" placeholder="Digite a descrição do recebimento ou pagamento...">
                    </div>

                    <div class="form-group col-12 mb-3">
                        <label for="data_venc" class="form-label">Data de vencimento:</label>
                        <input type="text" required name="data_venc" class="form-control" id="data_venc" placeholder="dd/mm/aaaa" onfocus="(this.type='date')" onblur="(this.type='text')">
                    </div>

                    <div class="form-group col-12 mb-3">
                        <label for="valor_lanc" class="form-label">Valor do lançamento:</label>
                        <input type="text" required name="valor_lanc" class="form-control" id="valor_lanc" placeholder="Digite o valor do lançamento...">
                    </div>

                    <div class="form-group col-12 mb-3">
                        <label for="forma_pag" class="form-label">Forma de Rec/Pag:</label>
                        <select class="form-control" name="forma_pag" id="forma_pag">
                            <option value="" disabled selected>Selecione a forma de rec/pag</option>
                            <option value="dinheiro">Dinheiro</option>
                            <option value="pix">PIX</option>
                            <option value="transferencia">Transferência Bancária</option>
                            <option value="cartao_credito">Cartão de Crédito</option>
                            <option value="cartao_debito">Cartão de Débito</option>
                        </select>
                    </div>

                    <div class="form-group col-12 mb-3">
                        <label for="banco" class="form-label">Banco:</label>
                        <select class="form-control" name="banco" id="banco">
                             <option value="" disabled selected>Selecione o banco</option>
                        </select>
                    </div>

                    <div class="form-group col-12 mb-3">
                        <label for="cartao" class="form-label">Cartão:</label>
                        <select class="form-control" name="cartao" id="cartao">
                             <option value="" disabled selected>Selecione o cartão</option>
                        </select>
                    </div>
                    
                    <div class="form-group col-12 mb-3">
                        <label for="data_rec_pag" class="form-label">Data de Rec/Pag:</label>
                        <input type="text" name="data_rec_pag" class="form-control" id="data_rec_pag" placeholder="dd/mm/aaaa" onfocus="(this.type='date')" onblur="(this.type='text')">
                    </div>

                </form> </div>
            <div class="modal-footer justify-content-center border-top pt-3 mt-3">
                <button type="reset" form="lancamentoForm" class="btn btn-outline-secondary">Apagar</button>
                 <button type="submit" form="lancamentoForm" class="btn btn-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg" viewBox="0 0 16 16" style="vertical-align: -0.125em;"><path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022z"/></svg>
                    Salvar
                </button>
            </div>
        </div>
    </div>
</div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <script src="static/script.js"></script>

</body>

</html>