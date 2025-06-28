<!doctype html>
<html lang="pt-br">
<head>
    <title>Novo Lançamento</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="stylesheet" href="static/style.css">

</head>

<body>

<div class="container-central">

        <div id="seletor-inicial" class="text-center">
            <div class="d-flex justify-content-center">
                <button type="button" class="btn-imagem mx-2" id="btn-receita">
                    <img src="images/receita.png" alt="Nova Receita" id="img-receita" style="width: 300px;">
                </button>
                <button type="button" class="btn-imagem mx-2" id="btn-despesa">
                    <img src="images/despesa.png" alt="Nova Despesa" id="img-despesa" style="width: 300px;">
                </button>
            </div>
        </div>

        <div id="bloco-formulario" style="display: none;">
            <form class="row p-4 bg-white rounded shadow-lg" method="post" action="index.php" style="width: 100%; max-width: 550px;">
                
                <div class="col-12 text-center pb-2">
                    <h6 id="form-title"></h6> </div>
                
                <input type="hidden" name="tipo_lanc" id="tipo_lanc_hidden">
                
                <div id="form-container" style="display: block;"> 
                    <div class="col text-start">
                        <div class="mb-3">
                            <label for="plano_contas" class="form-label">Plano de Contas:</label>
                            <select class="form-select" name="plano_contas" id="plano_contas" required>
                                <option value="" disabled selected>Selecione um plano</option>
                                <option value="salario">Salário</option>
                                <option value="aluguel">Aluguel</option>
                                <option value="supermercado">Supermercado</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="desc_lanc" class="form-label">Descrição do lançamento:</label>
                            <input type="text" required name="desc_lanc" class="form-control" id="desc_lanc" placeholder="Ex: Compra do mês...">
                        </div>
                        <div class="mb-3">
                            <label for="data_venc" class="form-label">Data de vencimento:</label>
                            <input type="date" required name="data_venc" class="form-control" id="data_venc">
                        </div>
                        <div class="mb-3">
                            <label for="valor_lanc" class="form-label">Valor do lançamento:</label>
                            <input type="text" required name="valor_lanc" class="form-control" id="valor_lanc" placeholder="R$ 0,00">
                        </div>

                        <div id="forma-pagamento-container">
                            <div class="mb-3">
                                <label for="forma_pag" class="form-label">Forma de Pagamento:</label>
                                <select class="form-select" name="forma_pag" id="forma_pag">
                                    <option value="" selected>Selecione...</option>
                                    <option value="dinheiro">Dinheiro</option>
                                    <option value="pix">PIX</option>
                                    <option value="transferencia">Transferência Bancária</option>
                                    <option value="cartao_credito">Cartão de Crédito</option>
                                    <option value="cartao_debito">Cartão de Débito</option>
                                </select>
                            </div>
                            <div class="mb-3" id="banco-container">
                                <label for="banco" class="form-label">Selecione o Banco:</label>
                                <select class="form-select" name="banco" id="banco">
                                    <option value="banco_a">Banco do Brasil</option>
                                    <option value="banco_b">Itaú</option>
                                </select>
                            </div>
                            <div class="mb-3" id="cartao-container">
                                <label for="cartao" class="form-label">Selecione o Cartão:</label>
                                <select class="form-select" name="cartao" id="cartao">
                                    <option value="cartao_x">Visa Final 1234</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="data_rec_pag" class="form-label">Data de Liquidação:</label>
                            <input type="date" name="data_rec_pag" class="form-control" id="data_rec_pag">
                        </div>

                        <div class="d-flex justify-content-center border-top pt-3 mt-3">
                            <button type="submit" name="inserir_lancamento" class="btn btn-primary btn-lg">
                                <i class="bi bi-check-lg"></i> Salvar Lançamento
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="static/script.js"></script>

</body>
</html>