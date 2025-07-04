<!doctype html>
<html lang="pt-br">
    <head>
        <title>Consulta de bandeiras de cartões</title>
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

        <link rel="stylesheet" href="static/style.css"> 
    </head>

    <body>
        <header>
            </header>
        <main>
            <div class="main-content-wrapper">
                <div class="container d-flex justify-content-center align-items-center form-container"> 
                    <form class="row p-3 m-3 rounded shadow-lg" method="post" action="index.php">
                        <div class="container text-center pb-2">
                            <h6>CONSULTA DE BANDEIRAS DE CARTÕES</h6>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="nome_band" class="form-label">Bandeira do cartão:</label>
                                    <input type="text" name="nome_band" class="form-control" id="nome_band" placeholder="Digite o nome da bandeira de cartão...">
                                </div>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" name="consultar_bandeira" class="btn"><i class="bi bi-search"></i> Consultar</button>
                        </div>
                    </form>
                </div>
                <div class="container table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-info">
                            <tr class="text-center">
                                <th>CÓDIGO</th>
                                <th>NOME DA BANDEIRA</th>
                                <th>AÇÃO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                //mostrar os resultados
                                foreach ($resultado as $key => $valor) {
                                    echo '<tr class="text-center">';
                                    echo '  <th scope="row">' . $valor->id_cad_band . '</th>';
                                    echo '  <td class="text-start">' . $valor->nome_band . '</td>';
                                    echo '  <td>
                                                <button type="button" class="btn" title = "Alterar" data-bs-toggle="modal" data-bs-target="#alterar_bandeira' . $valor->id_cad_band . '"><i class="bi bi-pencil"></i></button>
                                                <button type="button" class="btn" title = "Excluir" data-bs-toggle="modal" data-bs-target="#excluir_bandeira' . $valor->id_cad_band . '"><i class="bi bi-trash"></i></button>
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
                        $this->modal_excluir_bandeira($valor->id_cad_band, $valor->nome_band);
                        $this->modal_alterar_bandeira($valor->id_cad_band, $valor->nome_band);
                    }
                ?>
            </div> </main>
        <footer>
            </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>