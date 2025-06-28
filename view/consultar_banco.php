<!doctype html>
<html lang="pt-br">
    <head>
        <title>Consulta de bancos</title>
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
            <div class="container d-flex justify-content-center mt-1">
                <form class="row p-3 m-3 border border-info rounded shadow-lg" method="post" action="index.php">
                    <div class="container text-center pb-2">
                        <h6>CONSULTA DE BANCOS</h6>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="nome_banco" class="form-label">Nome banco:</label>
                                <input type="text" name="nome_banco" class="form-control" id="nome_banco" placeholder="Digite o nome do banco...">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button button type="submit" name="consultar_banco" class="btn btn-outline-info"><i class="bi bi-search"></i> Consultar</button>
                    </div>
                </form>
            </div>
            <div class="container table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-info">
                        <tr class="text-center">
                            <th>CÓDIGO</th>
                            <th>NOME DO BANCO</th>
                            <th>NÚMERO DA AGÊNCIA</th>
                            <th>NÚMERO DA CONTA</th>
                            <th>AÇÃO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            //mostrar os resultados
                            foreach ($resultado as $key => $valor) {
                                echo '<tr class="text-center">';
                                echo '  <th scope="row">' . $valor->id_cad_banco . '</th>';
                                echo '  <td class="text-start">' . $valor->nome_banco . '</td>';
                                echo '  <td>' . $valor->num_agencia . '</td>';
                                echo '  <td>' . $valor->num_conta . '</td>';
                                echo '  <td>
                                            <button type="button" class="btn btn-outline-info" title = "Alterar" data-bs-toggle="modal" data-bs-target="#alterar_banco' . $valor->id_cad_banco . '"><i class="bi bi-pencil"></i></button>
                                            <button type="button" class="btn btn-outline-info" title = "Excluir" data-bs-toggle="modal" data-bs-target="#excluir_banco' . $valor->id_cad_banco . '"><i class="bi bi-trash"></i></button>
                                        </td>';
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php
                //criar os Modais de excluir e alterar
                foreach ($resultado as $key => $valor) {
                    $this->modal_excluir_banco($valor->id_cad_banco, $valor->nome_banco);
                    $this->modal_alterar_banco($valor->id_cad_banco, $valor->nome_banco, $valor->num_agencia, $valor->num_conta);
                }
            ?>
        </main>
            <footer>
                <!-- place footer here -->
            </footer>
            <!-- Bootstrap JavaScript Libraries -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>

</html>