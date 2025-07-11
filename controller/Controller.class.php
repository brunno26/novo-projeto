<?php
//classe de controle
class Controller
{

    //==============================REDIRECIONAR PÁGINA==============================

    public function redirecionar($pagina)
    {
        //iniciar sessao
        session_start();
        //incluir menu
        $menu = $this->menu();
        //incluir a view
        require_once 'view/' . $pagina . '.php';
    }

    //==============================VALIDAR LOGIN==============================

    public function validar_login($email, $senha)
    {
        //instanciar a classe Usuário
        $objUsuario = new Usuario();
        //validar usuario
        if ($objUsuario->validarLogin($email, $senha) == true) {
            //iniciar sessao
            session_start();
            //iniciar variaves de sessao
            $_SESSION['email'] = $email;
            // $_SESSION['perfil'] = $objUsuario->perfilUsuario($email);
            //menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/principal.php';
        } else {
            include_once 'login.php';
            $this->mostrarMensagem("Login ou senha inválidos!");
        }
    }

    //==============================VALIDAR SESSÃO==============================

    public function validarSessao()
    {
        //verificar variaveis de sessao
        if (! isset($_SESSION['email']) and ! isset($_SESSION['perfil'])) {
            //acesso negado
            header("location: login.php");
        }
    }

    //==============================RECUPERAR SENHA==============================

    public function recuperarSenha($email)
    {
        //instanciar a classe Usuário
        $objUsuario = new Usuario();
        //verificar se email existe
        if ($objUsuario->validarEmail($email) == true) {
            //gerar nova senha
            $senha = md5('12345678');
            //$senha = md5(substr(md5(date("YmdHis")), 1, 6));

            //atualizar senha
            $objUsuario->alterarSenha($email, $senha);

            //definir o servidor
            define('HOST', 'smtp.gmail.com');
            define('PORT', '587');
            define('USERNAME', 'senacdf.operadormicro@gmail.com');
            define('PASSWORD', 'uetz ezsn jjuy klyo');
            define('FROM', 'senacdf.operadormicro@gmail.com');

            //dados do envio
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = "TLS";
            $mail->Host       = HOST;
            $mail->Port       = PORT;
            $mail->Username   = USERNAME;
            $mail->Password   = PASSWORD;

            //dados do remetente
            $mail->setFrom(FROM, 'SISTEMA SGL');
            $mail->addAddress($email);

            //dados do email
            $mail->IsHTML(true);
            $mail->Subject = ('Recuperação de Senha - SGL');
            $mail->Body    = ('<br>Sua nova senha é: <b>12345678</b>');
            $mail->Charset = 'UTF-8';

            //eviar email
            if (! $mail->Send()) {
                include_once 'recuperar.php';
                $this->mostrarMensagem("Erro ao enviar e-mail! $mail->ErrorInfo");
            } else {
                include_once 'login.php';
                $this->mostrarMensagem("A nova senha foi enviada para o e-mail informado!");
            }
        } else {
            include_once 'recuperar.php';
            $this->mostrarMensagem("E-mail não cadastrado!");
        }
    }

    //==============================CONSULTAR GERAL==============================

    public function consultar_geral($palavra)
    {
        //instanciar a classe Livro
        $objLivro = new Livro();
        //iniciar sessao
        session_start();
        //invocar o método
        $_SESSION['resultado'] = $objLivro->consultarGeral($palavra);
        header("location: livro.php");
    }

    //==============================GERAR PDF==============================

    public function menu()
    {
        // DEPOIS
        echo '<ul class="navbar-nav sidebar-gradient sidebar sidebar-dark accordion" id="accordionSidebar">';

        // Logo
        echo '<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">';
        echo '  <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-coins"></i></div>';
        echo '  <div class="sidebar-brand-text mx-3">SFP-GZ</div>';
        echo '</a>';

        echo '<hr class="sidebar-divider my-0">'; // separador logo → dashboard

        // Dashboard
        echo '<li class="nav-item">';
        echo '  <a class="nav-link" href="index.php?principal">';
        echo '    <i class="fas fa-fw fa-tachometer-alt"></i>';
        echo '    <span>Dashboard</span>';
        echo '  </a>';
        echo '</li>';

        echo '<hr class="sidebar-divider">'; // separador dashboard → menu principal

        // Lançamentos
        // DENTRO DA SUA public function menu()
        echo '<li class="nav-item">';
        echo '  <a class="nav-link" href="#" data-toggle="modal" data-target="#modalEscolha">';
        echo '    <i class="fas fa-fw fa-money-check-alt"></i>';
        echo '    <span>Lançamentos</span>';
        echo '  </a>';
        echo '</li>';

        // Cadastros
        echo '<li class="nav-item">';
        echo '  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCadastros" aria-expanded="true" aria-controls="collapseCadastros">';
        echo '    <i class="fas fa-fw fa-folder-plus"></i>';
        echo '    <span>Cadastros</span>';
        echo '  </a>';
        echo '  <div id="collapseCadastros" class="collapse" data-parent="#accordionSidebar">';
        echo '    <div class="bg-white py-2 collapse-inner rounded">';
        echo '      <a class="collapse-item" href="index.php?inserir_banco">Bancos</a>';
        echo '      <a class="collapse-item" href="index.php?inserir_bandeira">Bandeiras</a>';
        echo '      <a class="collapse-item" href="index.php?inserir_cartao">Cartões</a>';
        echo '      <a class="collapse-item" href="index.php?inserir_forma">Formas de rec/pag</a>';
        echo '      <a class="collapse-item" href="index.php?inserir_plano">Plano de contas</a>';
        echo '    </div>';
        echo '  </div>';
        echo '</li>';

        // Consultas
        echo '<li class="nav-item">';
        echo '  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseConsultas" aria-expanded="true" aria-controls="collapseConsultas">';
        echo '    <i class="fas fa-fw fa-search"></i>';
        echo '    <span>Consultas</span>';
        echo '  </a>';
        echo '  <div id="collapseConsultas" class="collapse" data-parent="#accordionSidebar">';
        echo '    <div class="bg-white py-2 collapse-inner rounded">';
        echo '      <a class="collapse-item" href="index.php?consultar_lancamento">Lançamentos</a>';
        echo '      <div class="collapse-divider"></div>';
        echo '      <a class="collapse-item" href="index.php?consultar_banco">Bancos</a>';
        echo '      <a class="collapse-item" href="index.php?consultar_bandeira">Bandeiras</a>';
        echo '      <a class="collapse-item" href="index.php?consultar_cartao">Cartões</a>';
        echo '      <a class="collapse-item" href="index.php?consultar_forma">Formas de rec/pag</a>';
        echo '      <a class="collapse-item" href="index.php?consultar_plano">Plano de contas</a>';
        echo '    </div>';
        echo '  </div>';
        echo '</li>';

        // Relatórios
        echo '<li class="nav-item">';
        echo '  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRelatorios" aria-expanded="true" aria-controls="collapseRelatorios">';
        echo '    <i class="fas fa-fw fa-chart-line"></i>';
        echo '    <span>Relatórios</span>';
        echo '  </a>';
        echo '  <div id="collapseRelatorios" class="collapse" data-parent="#accordionSidebar">';
        echo '    <div class="bg-white py-2 collapse-inner rounded">';
        echo '      <a class="collapse-item" href="index.php?consultar_editora">Receitas/mês</a>';
        echo '      <a class="collapse-item" href="index.php?inserir_editora">Despesas/mês</a>';
        echo '      <a class="collapse-item" href="index.php?inserir_editora">Saldo/mês</a>';
        echo '    </div>';
        echo '  </div>';
        echo '</li>';

        echo '<hr class="sidebar-divider">';

        // Sair
        echo '<li class="nav-item">';
        echo '  <a class="nav-link" href="index.php?sair">';
        echo '    <i class="fas fa-fw fa-sign-out-alt"></i>';
        echo '    <span>Sair</span>';
        echo '  </a>';
        echo '</li>';

        echo '</ul>';
    }

    //==============================MOSTRAR MENSAGEM==============================

    public function mostrarMensagem($mensagem)
    {
        //<!-- Modal -->
        echo '<div class="modal fade" id="mensagem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo '  <div class="modal-dialog">';
        echo '    <div class="modal-content">';
        echo '      <div class="modal-header">';
        echo '        <h5 class="modal-title" id="exampleModalLabel">Informação</h5>';
        echo '        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '      </div>';
        echo '      <div class="modal-body">';
        echo '        <div class="alert alert-warning" role="alert">';
        echo $mensagem;
        echo '        </div>';
        echo '      </div>';
        echo '      <div class="modal-footer">';
        echo '        <button type="button" class="btn btn-outline-info" data-bs-dismiss="modal">Fechar</button>';
        echo '      </div>';
        echo '    </div>';
        echo '  </div>';
        echo '</div>';

        //JS
        echo '<script>';
        echo '    document.addEventListener("DOMContentLoaded", function() {';
        echo '    var myModal = new bootstrap.Modal(document.getElementById("mensagem"));';
        echo '    myModal.show();});';
        echo '</script>';
    }

    //==============================BANCO==============================

    //inserir Banco
    public function inserir_banco($nome_banco, $num_agencia, $num_conta)
    {
        //instanciar a classe Banco
        $objBanco = new Banco();
        //invocar o método
        if ($objBanco->inserirBanco($nome_banco, $num_agencia, $num_conta) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu      = $this->menu();
            $resultado = $objBanco->consultarBanco(null);
            //incluir a view
            include_once 'view/consultar_banco.php';
            //mostrar mensagem
            $this->mostrarMensagem("Banco inserido com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_banco.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao inserir banco!");
        }
    }

    //consultar banco
    public function consultar_banco($nome_banco)
    {
        //instanciar a classe Autor
        $objBanco = new Banco();
        //invocar o método
        if ($objBanco->consultarBanco($nome_banco) == false) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_banco.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao consultar banco!");
        } else {
            //iniciar sessao
            session_start();
            //resultado da consulta
            $resultado = $objBanco->consultarBanco($nome_banco);
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_banco.php';
        }
    }

    //alterar banco
    public function alterar_banco($id_cad_banco, $nome_banco, $num_agencia, $num_conta)
    {
        //instanciar a classe plano
        $objBanco = new Banco();
        //invocar o método
        if ($objBanco->alterarBanco($id_cad_banco, $nome_banco, $num_agencia, $num_conta) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu      = $this->menu();
            $resultado = $objBanco->consultarBanco(null);
            //incluir a view
            include_once 'view/consultar_banco.php';
            //mostrar mensagem
            $this->mostrarMensagem("Banco alterado com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_banco.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao alterar Banco!");
        }
    }

    //excluir banco
    public function excluir_banco($id_cad_banco)
    {
        //instanciar a classe Plano
        $objBanco = new Banco();
        //invocar o método
        if ($objBanco->excluirBanco($id_cad_banco) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_banco.php';
            //mostrar mensagem
            $this->mostrarMensagem("Banco excluído com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_banco.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao excluir Banco!");
        }
    }

    //select de banco
    public function selectBanco($id_cad_banco_selecionado = null)
    {
        // Instanciar a classe Banco
        $objBanco = new Banco();

                                                      // Invocar o método para buscar os dados
        $resultado = $objBanco->consultarBanco(null); // Não precisa passar null aqui

        // Gerar a opção padrão (placeholder)
        echo '<option value="" disabled selected>Selecione o banco</option>';

        // Verificar se a consulta retornou resultados
        if ($resultado) {
            // Iterar sobre os resultados para criar cada opção
            foreach ($resultado as $banco) {

                // Lógica simplificada para pré-selecionar
                $selecionado = ($banco->id_cad_banco == $id_cad_banco_selecionado) ? 'selected' : '';

                // Impressão segura (com htmlspecialchars)
                echo '<option ' . $selecionado . ' value="' . htmlspecialchars($banco->id_cad_banco) . '">'
                . htmlspecialchars($banco->nome_banco)
                    . '</option>';
            }
        }
    }

    public function modal_alterar_banco($id_cad_banco, $nome_banco, $num_agencia, $num_conta)
    {
        echo '<!-- Modal -->';
        echo '<div class="modal fade" id="alterar_banco' . $id_cad_banco . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo ' <div class="modal-dialog">';
        echo '     <div class="modal-content">';
        echo '      <div class="modal-header">';
        echo '         <h5 class="modal-title" id="exampleModalLabel">Alterar Banco</h5>';
        echo '         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '      </div>';
        echo '<form method="post" action="index.php">';
        echo '  <div class="modal-body">';
        echo '     <label for="nome_banco" class="form-label">Banco:</label>';
        echo '     <input type="text" class="form-control mb-3" name="nome_banco" value="' . $nome_banco . '">';
        echo '     <label for="num_agencia" class="form-label">Agência:</label>';
        echo '     <input type="text" class="form-control mb-3" name="num_agencia" value="' . $num_agencia . '">';
        echo '     <label for="num_conta" class="form-label">Conta:</label>';
        echo '     <input type="text" class="form-control" name="num_conta" value="' . $num_conta . '">';
        echo '  </div>';
        echo '  <div class="modal-footer">';
        echo '    <input type="hidden" name="id_cad_banco" value="' . $id_cad_banco . '">';
        echo '    <button type="button" class="btn btn-outline-info" data-bs-dismiss="modal">Fechar</button>';
        echo '    <button type="submit" name="alterar_banco" class="btn btn-outline-info">Alterar</button>';
        echo '  </div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    public function modal_excluir_banco($id_cad_banco, $nome_banco)
    {
        echo '<!-- Modal -->';
        echo '<div class="modal fade" id="excluir_banco' . $id_cad_banco . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo ' <div class="modal-dialog">';
        echo '     <div class="modal-content">';
        echo '      <div class="modal-header">';
        echo '         <h5 class="modal-title" id="exampleModalLabel">Excluir Banco</h5>';
        echo '         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '      </div>';
        echo '  <div class="modal-body">';
        echo 'Deseja realmente excluir: ' . $nome_banco . ' ?';
        echo '  </div>';
        echo '<form method="post" action="index.php">';
        echo ' <div class="modal-footer">';
        echo '    <input type="hidden" name="id_cad_banco" value="' . $id_cad_banco . '">';
        echo '    <button type="button" class="btn btn-outline-info" data-bs-dismiss="modal">Fechar</button>';
        echo '    <button type="submit" name="excluir_banco" class="btn btn-outline-info">Excluir</button>';
        echo ' </div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    //==============================BANDEIRA==============================

    //inserir Bandeira
    public function inserir_bandeira($nome_bandeira)
    {
        //instanciar a classe Bandeira
        $objBandeira = new Bandeira();
        //invocar o método
        if ($objBandeira->inserirBandeira($nome_bandeira) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu      = $this->menu();
            $resultado = $objBandeira->consultarBandeira(null);
            //incluir a view
            include_once 'view/consultar_bandeira.php';
            //mostrar mensagem
            $this->mostrarMensagem("Bandeira inserida com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_bandeira.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao inserir bandeira!");
        }
    }

    //consultar bandeira
    public function consultar_bandeira($nome_bandeira)
    {
        //instanciar a classe Autor
        $objBandeira = new Bandeira();
        //invocar o método
        if ($objBandeira->consultarBandeira($nome_bandeira) == false) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_bandeira.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao consultar!");
        } else {
            //iniciar sessao
            session_start();
            //resultado da consulta
            $resultado = $objBandeira->consultarBandeira($nome_bandeira);
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_bandeira.php';
        }
    }

    //alterar bandeira
    public function alterar_bandeira($id_cad_band, $nome_band)
    {
        //instanciar a classe bandeira
        $objBandeira = new Bandeira();
        //invocar o método
        if ($objBandeira->alterarBandeira($id_cad_band, $nome_band) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu      = $this->menu();
            $resultado = $objBandeira->consultarBandeira(null);
            //incluir a view
            include_once 'view/consultar_bandeira.php';
            //mostrar mensagem
            $this->mostrarMensagem("Bandeira alterada com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_bandeira.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao alterar Bandeira!");
        }
    }

    //excluir bandeira
    public function excluir_bandeira($id_cad_band)
    {
        //instanciar a classe Bandeira
        $objBandeira = new Bandeira();
        //invocar o método
        if ($objBandeira->excluirBandeira($id_cad_band) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_bandeira.php';
            //mostrar mensagem
            $this->mostrarMensagem("Bandeira excluída com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_bandeira.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao excluir Bandeira!");
        }
    }

    //select de bandeira
    public function selectBandeira($id_cad_band = null)
    {
        //instanciar a classe Bandeira
        $objBandeira = new Bandeira();
        //invocar o método
        $resultado = $objBandeira->consultarBandeira(null);
        //montar o select dinamicamente
        echo '<label for="id_cad_band" class="form-label">Bandeira do cartão:</label>';
        echo '<select name="id_cad_band" class="form-select" aria-label="Default select example" required>';
        echo '    <option value="" selected>Selecione a bandeira do cartão</option>';
        foreach ($resultado as $key => $valor) {
            if ($valor->id_cad_band == $id_cad_band) {
                echo '<option selected value="' . $valor->id_cad_band . '">' . $valor->nome_band . '</option>';
            } else {
                echo '<option value="' . $valor->id_cad_band . '">' . $valor->nome_band . '</option>';
            }
        }
        echo '</select>';
    }

    public function modal_alterar_bandeira($id_cad_band, $nome_band)
    {
        echo '<!-- Modal -->';
        echo '<div class="modal fade" id="alterar_bandeira' . $id_cad_band . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo ' <div class="modal-dialog">';
        echo '     <div class="modal-content">';
        echo '      <div class="modal-header">';
        echo '         <h5 class="modal-title" id="exampleModalLabel">Alterar Bandeira</h5>';
        echo '         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '      </div>';
        echo '<form method="post" action="index.php">';
        echo '  <div class="modal-body">';
        echo '       <label for="nome_band" class="form-label">Bandeira do cartão:</label>';
        echo '      <input type="text" class="form-control" name="nome_band" value="' . $nome_band . '">';
        echo '  </div>';
        echo '  <div class="modal-footer">';
        echo '    <input type="hidden" name="id_cad_band" value="' . $id_cad_band . '">';
        echo '    <button type="button" class="btn btn-outline-info" data-bs-dismiss="modal">Fechar</button>';
        echo '    <button type="submit" name="alterar_bandeira" class="btn btn-outline-info">Alterar</button>';
        echo '  </div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    public function modal_excluir_bandeira($id_cad_band, $nome_band)
    {
        echo '<!-- Modal -->';
        echo '<div class="modal fade" id="excluir_bandeira' . $id_cad_band . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo ' <div class="modal-dialog">';
        echo '     <div class="modal-content">';
        echo '      <div class="modal-header">';
        echo '         <h5 class="modal-title" id="exampleModalLabel">Excluir Bandeira</h5>';
        echo '         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '      </div>';
        echo '  <div class="modal-body">';
        echo 'Deseja realmente excluir: ' . $nome_band . ' ?';
        echo '  </div>';
        echo '<form method="post" action="index.php">';
        echo ' <div class="modal-footer">';
        echo '    <input type="hidden" name="id_cad_band" value="' . $id_cad_band . '">';
        echo '    <button type="button" class="btn btn-outline-info" data-bs-dismiss="modal">Fechar</button>';
        echo '    <button type="submit" name="excluir_bandeira" class="btn btn-outline-info">Excluir</button>';
        echo ' </div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    //==============================CARTÃO==============================

    //inserir cartão
    public function inserir_cartao($id_cad_band, $nome_cartao, $num_cartao)
    {
        //instanciar a classe Cartão
        $objCartao = new Cartao();
        //invocar o método
        if ($objCartao->inserirCartao($id_cad_band, $nome_cartao, $num_cartao) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu      = $this->menu();
            $resultado = $objCartao->consultarCartao(null);
            //incluir a view
            include_once 'view/consultar_cartao.php';
            //mostrar mensagem
            $this->mostrarMensagem("Cartão inserido com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_cartao.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao inserir cartão!");
        }
    }

    //consultar cartão
    public function consultar_cartao($nome_cartao)
    {
        //instanciar a classe Cartão
        $objCartao = new Cartao();
        //invocar o método
        if ($objCartao->consultarCartao($nome_cartao) == false) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_cartao.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao consultar!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //resultado da consulta
            $resultado = $objCartao->consultarCartao($nome_cartao);
            //incluir a view
            include_once 'view/consultar_cartao.php';
        }
    }

    //alterar cartão
    public function alterar_cartao($id_cad_cartao, $id_cad_band, $nome_cartao, $num_cartao)
    {
        //instanciar a classe Cartão
        $objCartao = new Cartao();
        //invocar o método
        if ($objCartao->alterarCartao($id_cad_cartao, $id_cad_band, $nome_cartao, $num_cartao) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu      = $this->menu();
            $resultado = $objCartao->consultarCartao(null);
            //incluir a view
            include_once 'view/consultar_cartao.php';
            //mostrar mensagem
            $this->mostrarMensagem("Cartão alterado com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_cartao.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao alterar cartão!");
        }
    }

    //excluir cartão
    public function excluir_cartao($id_cad_cartao)
    {
        //instanciar a classe Cartão
        $objCartao = new Cartao();
        //invocar o método
        if ($objCartao->excluirCartao($id_cad_cartao) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_cartao.php';
            //mostrar mensagem
            $this->mostrarMensagem("Cartão excluído com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_cartao.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao excluir cartão!");
        }
    }

    public function selectCartao($id_cad_cartao_selecionado = null)
    {
        // Instanciar a classe Cartao
        $objCartao = new Cartao();
                                                        // Invocar o método para consultar os dados
        $resultado = $objCartao->consultarCartao(null); // O 'null' não é necessário se o método não o utiliza

        // Gerar a opção padrão (placeholder)
        echo '<option value="" disabled selected>Selecione o cartão</option>';

        // Verificar se a consulta retornou resultados antes de continuar
        if ($resultado) {
            // Iterar sobre os resultados para criar cada opção
            foreach ($resultado as $cartao) {

                // 1. Lógica simplificada para pré-selecionar
                $selecionado = ($cartao->id_cad_cartao == $id_cad_cartao_selecionado) ? 'selected' : '';

                // 2. Impressão segura (com htmlspecialchars) e limpa
                echo '<option ' . $selecionado . ' value="' . htmlspecialchars($cartao->id_cad_cartao) . '">'
                . htmlspecialchars($cartao->nome_cartao)
                    . '</option>';
            }
        }
    }

    public function modal_alterar_cartao($id_cad_cartao, $id_cad_band, $nome_cartao, $num_cartao)
    {
        echo '<!-- Modal -->';
        echo '<div class="modal fade" id="alterar_cartao' . $id_cad_cartao . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo ' <div class="modal-dialog">';
        echo '     <div class="modal-content">';
        echo '      <div class="modal-header">';
        echo '         <h5 class="modal-title" id="exampleModalLabel">Alterar Cartão</h5>';
        echo '         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '      </div>';
        echo '<form method="post" action="index.php">';
        echo '  <div class="modal-body">';
        $this->selectBandeira($id_cad_band);
        echo '     <label for="nome_cartao" class="form-label mt-3">Nome do cartão:</label>';
        echo '     <input type="text" class="form-control mb-3" name="nome_cartao" value="' . $nome_cartao . '">';
        echo '     <label for="num_cartao" class="form-label">Número do cartão:</label>';
        echo '     <input type="text" class="form-control mb-3" name="num_cartao" value="' . $num_cartao . '">';
        echo '  </div>';
        echo '  <div class="modal-footer">';
        echo '    <input type="hidden" name="id_cad_cartao" value="' . $id_cad_cartao . '">';
        echo '    <button type="button" class="btn btn-outline-info" data-bs-dismiss="modal">Fechar</button>';
        echo '    <button type="submit" name="alterar_cartao" class="btn btn-outline-info">Alterar</button>';
        echo '  </div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    public function modal_excluir_cartao($id_cad_cartao, $nome_cartao)
    {
        echo '<!-- Modal -->';
        echo '<div class="modal fade" id="excluir_cartao' . $id_cad_cartao . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo ' <div class="modal-dialog">';
        echo '     <div class="modal-content">';
        echo '      <div class="modal-header">';
        echo '         <h5 class="modal-title" id="exampleModalLabel">Excluir Cartão</h5>';
        echo '         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '      </div>';
        echo '  <div class="modal-body">';
        echo 'Deseja realmente excluir: ' . $nome_cartao . ' ?';
        echo '  </div>';
        echo '<form method="post" action="index.php">';
        echo ' <div class="modal-footer">';
        echo '    <input type="hidden" name="id_cad_cartao" value="' . $id_cad_cartao . '">';
        echo '    <button type="button" class="btn btn-outline-info" data-bs-dismiss="modal">Fechar</button>';
        echo '    <button type="submit" name="excluir_cartao" class="btn btn-outline-info">Excluir</button>';
        echo ' </div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    //==============================FORMA==============================

    //inserir forma
    public function inserir_forma($desc_forma)
    {
        //instanciar a classe forma
        $objForma = new Forma();
        //invocar o método
        if ($objForma->inserirForma($desc_forma) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu      = $this->menu();
            $resultado = $objForma->consultarForma(null);
            //incluir a view
            include_once 'view/consultar_forma.php';
            //mostrar mensagem
            $this->mostrarMensagem("Forma inserida com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_forma.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao inserir forma!");
        }
    }

    //consultar forma
    public function consultar_forma($desc_forma)
    {
        //instanciar a classe Autor
        $objForma = new Forma();
        //invocar o método
        if ($objForma->consultarForma($desc_forma) == false) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_forma.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao consultar forma!");
        } else {
            //iniciar sessao
            session_start();
            //resultado da consulta
            $resultado = $objForma->consultarForma($desc_forma);
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_forma.php';
        }
    }

    //alterar forma
    public function alterar_forma($id_cad_forma, $desc_forma)
    {
        //instanciar a classe forma
        $objForma = new Forma();
        //invocar o método
        if ($objForma->alterarForma($id_cad_forma, $desc_forma) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu      = $this->menu();
            $resultado = $objForma->consultarForma(null);
            //incluir a view
            include_once 'view/consultar_forma.php';
            //mostrar mensagem
            $this->mostrarMensagem("Forma alterada com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_forma.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao alterar forma!");
        }
    }

    //excluir forma
    public function excluir_forma($id_cad_forma)
    {
        //instanciar a classe Bandeira
        $objForma = new Forma();
        //invocar o método
        if ($objForma->excluirForma($id_cad_forma) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_forma.php';
            //mostrar mensagem
            $this->mostrarMensagem("Forma excluída com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_forma.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao excluir forma!");
        }
    }

    //select de forma
    public function selectForma($id_cad_forma_selecionada = null)
    {
        $objForma  = new Forma(); // Precisaremos criar a classe Forma
        $resultado = $objForma->consultarForma(null);

        echo '<option value="" disabled selected>Selecione a forma</option>';

        if ($resultado) {
            foreach ($resultado as $forma) {
                // A sua tabela tb_cad_forma tem as colunas id_cad_forma e desc_forma
                $selecionado = ($forma->id_cad_forma == $id_cad_forma_selecionada) ? 'selected' : '';
                echo '<option ' . $selecionado . ' value="' . htmlspecialchars($forma->id_cad_forma) . '">'
                . htmlspecialchars($forma->desc_forma)
                    . '</option>';
            }
        }
    }

    public function modal_alterar_forma($id_cad_forma, $desc_forma)
    {
        echo '<!-- Modal -->';
        echo '<div class="modal fade" id="alterar_forma' . $id_cad_forma . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo ' <div class="modal-dialog">';
        echo '     <div class="modal-content">';
        echo '      <div class="modal-header">';
        echo '         <h5 class="modal-title" id="exampleModalLabel">Alterar Forma</h5>';
        echo '         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '      </div>';
        echo '<form method="post" action="index.php">';
        echo '  <div class="modal-body">';
        echo '     <label for="desc_forma" class="form-label mt-3">Forma de Rec/Pag:</label>';
        echo '     <input type="text" class="form-control" name="desc_forma" value="' . $desc_forma . '">';
        echo '  </div>';
        echo '  <div class="modal-footer">';
        echo '    <input type="hidden" name="id_cad_forma" value="' . $id_cad_forma . '">';
        echo '    <button type="button" class="btn btn-outline-info" data-bs-dismiss="modal">Fechar</button>';
        echo '    <button type="submit" name="alterar_forma" class="btn btn-outline-info">Alterar</button>';
        echo '  </div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    public function modal_excluir_forma($id_cad_forma, $desc_forma)
    {
        echo '<!-- Modal -->';
        echo '<div class="modal fade" id="excluir_forma' . $id_cad_forma . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo ' <div class="modal-dialog">';
        echo '     <div class="modal-content">';
        echo '      <div class="modal-header">';
        echo '         <h5 class="modal-title" id="exampleModalLabel">Excluir Forma</h5>';
        echo '         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '      </div>';
        echo '  <div class="modal-body">';
        echo 'Deseja realmente excluir: ' . $desc_forma . ' ?';
        echo '  </div>';
        echo '<form method="post" action="index.php">';
        echo ' <div class="modal-footer">';
        echo '    <input type="hidden" name="id_cad_forma" value="' . $id_cad_forma . '">';
        echo '    <button type="button" class="btn btn-outline-info" data-bs-dismiss="modal">Fechar</button>';
        echo '    <button type="submit" name="excluir_forma" class="btn btn-outline-info">Excluir</button>';
        echo ' </div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    //==============================LANÇAMENTO==============================

    //inserir lançamento
    public function inserir_lancamento($id_cad_tipo, $id_cad_plano, $desc_lanc, $data_venc, $valor_lanc, $id_cad_forma, $id_cad_banco, $id_cad_cartao, $data_rec_pag)
    {
        //instanciar a classe Cartão
        $objLancamento = new Lancamento();
        //invocar o método
        if ($objLancamento->inserirLancamento($id_cad_tipo, $id_cad_plano, $desc_lanc, $data_venc, $valor_lanc, $id_cad_forma, $id_cad_banco, $id_cad_cartao, $data_rec_pag) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu      = $this->menu();
            $resultado = $objLancamento->consultarLancamento(null);
            //incluir a view
            include_once 'view/consultar_lancamento.php';
            //mostrar mensagem
            $this->mostrarMensagem("Lançamento inserido com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_lancamento.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao inserir lançamento!");
        }
    }

    //consultar lançamento
    public function consultar_lancamento($desc_lanc)
    {
        //instanciar a classe Cartão
        $objLancamento = new Lancamento();
        //invocar o método
        if ($objLancamento->consultarLancamento($desc_lanc) == false) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_lancamento.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao consultar!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //resultado da consulta
            $resultado = $objLancamento->consultarLancamento($desc_lanc);
            //incluir a view
            include_once 'view/consultar_lancamento.php';
        }
    }

    //alterar lançamento
    public function alterar_lancamento($id_lanc, $id_cad_tipo, $id_cad_plano, $desc_lanc, $data_venc, $valor_lanc, $id_cad_forma, $id_cad_banco, $id_cad_cartao, $data_rec_pag)
    {
        //instanciar a classe lançamento
        $objLancamento = new Lancamento();
        //invocar o método
        if ($objLancamento->alterarLancamento($id_lanc, $id_cad_tipo, $id_cad_plano, $desc_lanc, $data_venc, $valor_lanc, $id_cad_forma, $id_cad_banco, $id_cad_cartao, $data_rec_pag) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu      = $this->menu();
            $resultado = $objLancamento->consultarLancamento(null);
            //incluir a view
            include_once 'view/consultar_lancamento.php';
            //mostrar mensagem
            $this->mostrarMensagem("Lançamento alterado com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_lancamento.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao alterar lançamento!");
        }
    }

    //excluir lancamento
    public function excluir_lancamento($id_lanc)
    {
        //instanciar a classe lançamento
        $objLancamento = new Lancamento();
        //invocar o método
        if ($objLancamento->excluirLancamento($id_lanc) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_lancamento.php';
            //mostrar mensagem
            $this->mostrarMensagem("Lançamento excluído com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_lancamento.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao excluir lançamento!");
        }
    }

    public function modal_alterar_lancamento($id_lanc, $id_cad_tipo, $id_cad_plano, $desc_lanc, $data_venc, $valor_lanc, $id_cad_forma, $id_cad_banco, $id_cad_cartao, $data_rec_pag)
    {
        echo '<!-- Modal -->';
        echo '<div class="modal fade" id="alterar_lancamento' . $id_lanc . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo ' <div class="modal-dialog">';
        echo '     <div class="modal-content">';
        echo '      <div class="modal-header">';
        echo '         <h5 class="modal-title" id="exampleModalLabel">Alterar lançamento</h5>';
        echo '         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '      </div>';
        echo '<form method="post" action="index.php">';
        echo '  <div class="modal-body">';
        $this->selectTipo($id_cad_tipo);
        $this->selectPlano($id_cad_plano);
        echo '      <label for="desc_lanc" class="form-label">Descrição do lançamento:</label>';
        echo '      <input type="text" class="form-control mb-3" name="desc_lanc" value="' . $desc_lanc . '">';
        echo '      <label for="data_venc" class="form-label">Data de vencimento:</label>';
        echo '      <input type="date" class="form-control mb-3" name="data_venc" value="' . $data_venc . '">';
        echo '      <label for="valor_lanc" class="form-label">Valor:</label>';
        echo '      <input type="text" step="any" class="form-control mb-3" name="valor_lanc" value="' . $valor_lanc . '">';
        $this->selectForma($id_cad_forma);
        $this->selectBanco($id_cad_banco);
        $this->selectCartao($id_cad_cartao);
        echo '      <label for="data_rec_pag" class="form-label">Data rec/pag:</label>';
        echo '      <input type="date" class="form-control" name="data_rec_pag" value="' . $data_rec_pag . '">';
        echo '  </div>';
        echo '  <div class="modal-footer">';
        echo '    <input type="hidden" name="id_lanc" value="' . $id_lanc . '">';
        echo '    <button type="button" class="btn btn-outline-info" data-bs-dismiss="modal">Fechar</button>';
        echo '    <button type="submit" name="alterar_lancamento" class="btn btn-outline-info">Alterar</button>';
        echo '  </div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    public function modal_excluir_lancamento($id_lanc, $desc_lanc)
    {
        echo '<!-- Modal -->';
        echo '<div class="modal fade" id="excluir_lancamento' . $id_lanc . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo ' <div class="modal-dialog">';
        echo '     <div class="modal-content">';
        echo '      <div class="modal-header">';
        echo '         <h5 class="modal-title" id="exampleModalLabel">Excluir lançamento</h5>';
        echo '         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '      </div>';
        echo '  <div class="modal-body">';
        echo 'Deseja realmente excluir: ' . $desc_lanc . ' ?';
        echo '  </div>';
        echo '<form method="post" action="index.php">';
        echo ' <div class="modal-footer">';
        echo '    <input type="hidden" name="id_lanc" value="' . $id_lanc . '">';
        echo '    <button type="button" class="btn btn-outline-info" data-bs-dismiss="modal">Fechar</button>';
        echo '    <button type="submit" name="excluir_lancamento" class="btn btn-outline-info">Excluir</button>';
        echo ' </div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    //==============================PLANO==============================

    //inserir plano
    public function inserir_plano($desc_plano)
    {
        //instanciar a classe forma
        $objPlano = new Plano();
        //invocar o método
        if ($objPlano->inserirPlano($desc_plano) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu      = $this->menu();
            $resultado = $objPlano->consultarPlano(null);
            //incluir a view
            include_once 'view/consultar_plano.php';
            //mostrar mensagem
            $this->mostrarMensagem("Plano de contas inserido com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_plano.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao inserir plano de contas!");
        }
    }

    //consultar plano
    public function consultar_plano($desc_plano)
    {
        //instanciar a classe plano
        $objPlano = new Plano();
        //invocar o método
        if ($objPlano->consultarPlano($desc_plano) == false) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_plano.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao consultar plano de contas!");
        } else {
            //iniciar sessao
            session_start();
            //resultado da consulta
            $resultado = $objPlano->consultarPlano($desc_plano);
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_plano.php';
        }
    }

    //alterar plano
    public function alterar_plano($id_cad_plano, $desc_plano)
    {
        //instanciar a classe plano
        $objPlano = new Plano();
        //invocar o método
        if ($objPlano->alterarPlano($id_cad_plano, $desc_plano) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu      = $this->menu();
            $resultado = $objPlano->consultarPlano(null);
            //incluir a view
            include_once 'view/consultar_plano.php';
            //mostrar mensagem
            $this->mostrarMensagem("Plano de contas alterado com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_plano.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao alterar plano de contas!");
        }
    }

    //excluir plano
    public function excluir_plano($id_cad_plano)
    {
        //instanciar a classe Plano
        $objPlano = new Plano();
        //invocar o método
        if ($objPlano->excluirPlano($id_cad_plano) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_plano.php';
            //mostrar mensagem
            $this->mostrarMensagem("Plano de contas excluído com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_plano.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao excluir plano de contas!");
        }
    }

    //select de plano
    public function selectPlano($id_cad_plano_selecionado = null)
    {
        $objPlano  = new Plano(); // Precisaremos criar a classe Plano
        $resultado = $objPlano->consultarPlano(null);

        echo '<option value="" disabled selected>Selecione o plano de contas</option>';

        if ($resultado) {
            foreach ($resultado as $plano) {
                // A sua tabela tb_cad_plano tem as colunas id_cad_plano e desc_plano
                $selecionado = ($plano->id_cad_plano == $id_cad_plano_selecionado) ? 'selected' : '';
                echo '<option ' . $selecionado . ' value="' . htmlspecialchars($plano->id_cad_plano) . '">'
                . htmlspecialchars($plano->desc_plano)
                    . '</option>';
            }
        }
    }

    public function modal_alterar_plano($id_cad_plano, $desc_plano)
    {
        echo '<!-- Modal -->';
        echo '<div class="modal fade" id="alterar_plano' . $id_cad_plano . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo ' <div class="modal-dialog">';
        echo '     <div class="modal-content">';
        echo '      <div class="modal-header">';
        echo '         <h5 class="modal-title" id="exampleModalLabel">Alterar Plano</h5>';
        echo '         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '      </div>';
        echo '<form method="post" action="index.php">';
        echo '  <div class="modal-body">';
        echo '     <label for="desc_plano" class="form-label mt-3">Plano de contas:</label>';
        echo '     <input type="text" class="form-control" name="desc_plano" value="' . $desc_plano . '">';
        echo '  </div>';
        echo '  <div class="modal-footer">';
        echo '    <input type="hidden" name="id_cad_plano" value="' . $id_cad_plano . '">';
        echo '    <button type="button" class="btn btn-outline-info" data-bs-dismiss="modal">Fechar</button>';
        echo '    <button type="submit" name="alterar_plano" class="btn btn-outline-info">Alterar</button>';
        echo '  </div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    public function modal_excluir_plano($id_cad_plano, $desc_plano)
    {
        echo '<!-- Modal -->';
        echo '<div class="modal fade" id="excluir_plano' . $id_cad_plano . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo ' <div class="modal-dialog">';
        echo '     <div class="modal-content">';
        echo '      <div class="modal-header">';
        echo '         <h5 class="modal-title" id="exampleModalLabel">Excluir Plano</h5>';
        echo '         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '      </div>';
        echo '  <div class="modal-body">';
        echo 'Deseja realmente excluir: ' . $desc_plano . ' ?';
        echo '  </div>';
        echo '<form method="post" action="index.php">';
        echo ' <div class="modal-footer">';
        echo '    <input type="hidden" name="id_cad_plano" value="' . $id_cad_plano . '">';
        echo '    <button type="button" class="btn btn-outline-info" data-bs-dismiss="modal">Fechar</button>';
        echo '    <button type="submit" name="excluir_plano" class="btn btn-outline-info">Excluir</button>';
        echo ' </div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    //==============================TIPO==============================

    //select de tipo
    public function selectTipo($id_cad_tipo_selecionado = null)
    {
        $objTipo   = new Tipo(); // Precisaremos criar a classe Tipo
        $resultado = $objTipo->consultarTipo(null);

        echo '<option value="" disabled selected>Selecione o tipo</option>';

        if ($resultado) {
            foreach ($resultado as $tipo) {
                // A sua tabela tb_cad_tipo tem as colunas id_cad_tipo e desc_tipo
                $selecionado = ($tipo->id_cad_tipo == $id_cad_tipo_selecionado) ? 'selected' : '';
                echo '<option ' . $selecionado . ' value="' . htmlspecialchars($tipo->id_cad_tipo) . '">'
                . htmlspecialchars($tipo->desc_tipo)
                    . '</option>';
            }
        }
    }

    //==============================USUÁRIO==============================

    //inserir usuário
    public function inserir_usuario($nome_usuario, $email, $senha)
    {
        //instanciar a classe Autor
        $objUsuario = new Usuario();
        //invocar o método
        if ($objUsuario->inserirUsuario($nome_usuario, $email, $senha) == true) {
            //iniciar sessao
            session_start();
            $resultado = $objUsuario->consultarUsuario(null);

            $this->redirecionar('login.php');
            //incluir a view
            // include_once 'view/consultar_usuario.php';
            //mostrar mensagem
            $this->mostrarMensagem("Usuário inserido com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            // include_once 'view/consultar_usuario.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao inserir Usuário!");
        }
    }

    //consultar usuario
    public function consultar_usuario($nome_usuario)
    {
        //instanciar a classe Usuario
        $objUsuario = new Usuario();
        //invocar o método
        if ($objUsuario->consultarUsuario($nome_usuario) == false) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_usuario.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao consultar banco!");
        } else {
            //iniciar sessao
            session_start();
            //resultado da consulta
            $resultado = $objUsuario->consultarUsuario($nome_usuario);
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_usuario.php';
        }
    }

    //alterar usuario
    public function alterar_usuario($id_cad_usuario, $nome_usuario, $email, $senha)
    {
        //instanciar a classe usuario
        $objUsuario = new Usuario();
        //invocar o método
        if ($objUsuario->alterarUsuario($id_cad_usuario, $nome_usuario, $email, $senha) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu      = $this->menu();
            $resultado = $objUsuario->consultarUsuario(null);
            //incluir a view
            include_once 'view/consultar_usuario.php';
            //mostrar mensagem
            $this->mostrarMensagem("Usuario alterado com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_usuariophp';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao alterar Usuario!");
        }
    }

    //excluir usuario
    public function excluir_usuario($id_cad_usuario)
    {
        //instanciar a classe Plano
        $objUsuario = new Usuario();
        //invocar o método
        if ($objUsuario->excluirUsuario($id_cad_usuario) == true) {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_usuario.php';
            //mostrar mensagem
            $this->mostrarMensagem("Usuário excluído com sucesso!");
        } else {
            //iniciar sessao
            session_start();
            //inserir menu
            $menu = $this->menu();
            //incluir a view
            include_once 'view/consultar_usuario.php';
            //mostrar mensagem
            $this->mostrarMensagem("Erro ao excluir usuário!");
        }
    }

    public function modal_alterar_usuario($id_cad_usuario, $nome_usuario, $email, $senha)
    {
        echo '<!-- Modal -->';
        echo '<div class="modal fade" id="alterar_usuario' . $id_cad_usuario . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo ' <div class="modal-dialog">';
        echo '     <div class="modal-content">';
        echo '      <div class="modal-header">';
        echo '         <h5 class="modal-title" id="exampleModalLabel">Alterar Usuário</h5>';
        echo '         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '      </div>';
        echo '<form method="post" action="index.php">';
        echo '  <div class="modal-body">';
        echo '     <label for="nome_usuario" class="form-label">Usuário:</label>';
        echo '     <input type="text" class="form-control" name="nome_usuario" value="' . $nome_usuario . '">';
        echo '     <label for="email" class="form-label">E-mail:</label>';
        echo '     <input type="email" class="form-control" name="email" value="' . $email . '">';
        echo '     <label for="senha" class="form-label">Senha:</label>';
        echo '     <input type="password" class="form-control" name="password" value="' . $senha . '">';
        echo '  </div>';
        echo '  <div class="modal-footer">';
        echo '    <input type="hidden" name="id_cad_usuario" value="' . $id_cad_usuario . '">';
        echo '    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>';
        echo '    <button type="submit" name="alterar_usuario" class="btn btn-primary">Alterar</button>';
        echo '  </div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    public function modal_excluir_usuario($id_cad_usuario, $nome_usuario)
    {
        echo '<!-- Modal -->';
        echo '<div class="modal fade" id="excluir_usuario' . $id_cad_usuario . '" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">';
        echo ' <div class="modal-dialog">';
        echo '     <div class="modal-content">';
        echo '      <div class="modal-header">';
        echo '         <h5 class="modal-title" id="exampleModalLabel">Excluir Usuario</h5>';
        echo '         <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        echo '      </div>';
        echo '  <div class="modal-body">';
        echo $nome_usuario;
        echo '  </div>';
        echo '<form method="post" action="index.php">';
        echo ' <div class="modal-footer">';
        echo '    <input type="hidden" name="id_cad_usuario" value="' . $id_cad_usuario . '">';
        echo '    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>';
        echo '    <button type="submit" name="excluir_usuario" class="btn btn-danger">Excluir</button>';
        echo ' </div>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }

    public function renderizarBotoesTipo()
{
    $objTipo = new Tipo();
    $tipos   = $objTipo->listarTodos();

    if ($tipos) {
        foreach ($tipos as $tipo) {
            $id_botao = '';
            $imagem   = '';
            $alt_text = '';

            $desc = strtolower($tipo->desc_tipo);

            if (strpos($desc, 'recebimento') !== false) {
                $id_botao = 'btn-receita';
                $imagem   = 'images/receita.png';
                // Usaremos este texto para o tooltip
                $alt_text = 'Novo Recebimento';
            } elseif (strpos($desc, 'pagamento') !== false) {
                $id_botao = 'btn-despesa';
                $imagem   = 'images/despesa.png';
                // Usaremos este texto para o tooltip
                $alt_text = 'Novo Pagamento';
            }

            if ($id_botao) {
                // ===== CÓDIGO ATUALIZADO AQUI =====
                // Removida a classe 'btn-light'. Deixamos apenas 'btn'.
                echo '<button type="button" class="btn btn-imagem mx-2"
                            id="' . $id_botao . '"
                            data-tipo-id="' . htmlspecialchars($tipo->id_cad_tipo) . '"
                            data-bs-toggle="tooltip"
                            data-bs-placement="top"
                            data-bs-title="' . htmlspecialchars($alt_text) . '">';

                echo '     <img src="' . $imagem . '" alt="' . htmlspecialchars($alt_text) . '">';
                echo '</button>';
            }
        }
    }
}

    public function viewReceita()
    {
        //instanciar a classe Saldo
        $objLancamento = new Lancamento();
        //invocar o método
        $resultado = $objLancamento->viewReceita();
        foreach ($resultado as $total_recebimento) {
            $recebimentoMes = 'Receitas Mês Atual <br><br> R$ ' . number_format($total_recebimento->total_recebimento, 2, ',', '.');
        }

        return $recebimentoMes;
    }

        public function viewDespesa()
    {
        //instanciar a classe Saldo
        $objLancamento = new Lancamento();
        //invocar o método
        $resultado = $objLancamento->viewDespesa();
        foreach ($resultado as $total_pagamento) {
            $pagamentoMes = 'Despesas Mês Atual <br><br> R$ ' . number_format($total_pagamento->total_pagamento, 2, ',', '.');
        }

        return $pagamentoMes;
    }

    public function viewSaldo()
    {
        //instanciar a classe Saldo
        $objLancamento = new Lancamento();
        //invocar o método
        $resultado = $objLancamento->viewSaldo();
        foreach ($resultado as $saldo) {
            $saldoMes = 'Saldo Mês Atual <br><br> R$ ' . number_format($saldo->saldo, 2, ',', '.');
        }

        return $saldoMes;
    }
}
