<!doctype html>
<html lang="pt-br">
    <head>
        <title>Consulta de usuarios</title>
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
                <form class="row p-3 m-3 border shadow-lg" method="post" action="index.php">
                    <div class="container text-center pb-2">
                        <h6>CONSULTA DE USUARIOS</h6>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="nome_usuario" class="form-label">Nome</label>
                                <input type="text" name="nome_usuario" class="form-control" id="nome_usuario" placeholder="Digite o nome do usuário...">
                            </div>
                        </div>
                    </div>
                    <div>
                        <button button type="submit" name="consultar_usuario" class="btn btn-primary"><i class="bi bi-search"></i> Consultar</button>
                    </div>
                </form>
            </div>
            <div class="container table-responsive">
                <table class="table table-striped table-hover">
                    <thead class="table-secondary">
                        <tr class="text-center">
                            <th>CÓDIGO</th>
                            <th>NOME DO USUÁRIO</th>
                            <th>E-MAIL</th>
                            <th>AÇÃO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            //mostrar os resultados
                            foreach ($resultado as $key => $valor) {
                                echo '<tr class="text-center">';
                                echo '  <th scope="row">' . $valor->id_cad_usuario . '</th>';
                                echo '  <td>' . $valor->nome_usuario . '</td>';
                                echo '  <td class="text-start">' . $valor->email . '</td>';
                                echo '  <td>
                                            <button type="button" class="btn btn-secondary" title = "Alterar" data-bs-toggle="modal" data-bs-target="#alterar_usuario' . $valor->id_cad_usuario . '"><i class="bi bi-pencil"></i></button>
                                            <button type="button" class="btn btn-secondary" title = "Excluir" data-bs-toggle="modal" data-bs-target="#excluir_usuario' . $valor->id_cad_usuario . '"><i class="bi bi-trash"></i></button>
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
                    $this->modal_excluir_usuario($valor->id_cad_usuario, $valor->nome_usuario);
                    $this->modal_alterar_usuario($valor->id_cad_usuario, $valor->nome_usuario, $valor->email, $valor->senha);
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