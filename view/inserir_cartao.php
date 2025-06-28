<!doctype html>
<html lang="pt-br">
    <head>
        <title>Cadastro de cartões</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <!-- Bootstrap CSS v5.3.3 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <!-- meu css estilizdo -->
        <link rel="stylesheet" href="static/style.css">
    </head>

    <body>
        <header>
            <!-- place navbar here -->
        </header>
        <main>
            <div class="container d-flex justify-content-center mt-5">
                <form class="row p-3 m-3 border border-info rounded shadow-lg" method="post" action="index.php">
                    <div class="container text-center pb-2">
                        <h6>CADASTRO DE CARTÕES</h6>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                        <?php $this->selectBandeira(); ?>
                        </div>
                        <div class="mb-3">
                            <label for="nome_cartao" class="form-label">Nome do cartão:</label>
                            <input type="text" required name="nome_cartao" class="form-control" id="nome_cartao" placeholder="Cadastre o nome do cartão...">
                        </div>
                        <div class="mb-3">
                            <label for="num_cartao" class="form-label">Número do cartão:</label>
                            <input type="text" name="num_cartao" class="form-control" id="num_cartao" placeholder="Cadastre o número do cartão...">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="reset" class="btn btn-outline-info"><i class="bi bi-eraser"></i> Apagar</button>
                        <button type="submit" name="inserir_cartao" class="btn btn-outline-info"><i class="bi bi-check-lg"></i> Salvar</button>
                    </div>
                </form>
            </div>
        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
