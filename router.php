<?php

//==============================PEGAR A URL==============================

$url = explode('?', $_SERVER['REQUEST_URI']);
//escolher na variável $url do link desejado
$pagina = $url[1];

//==============================ROTAS DE DIRECIONAMENTO==============================

//redirecionar para a página informada
if (isset($pagina)) {
    $objController = new Controller();
    $objController->redirecionar($pagina);
}

//==============================ROTAS DE AÇÃO==============================

//verificar se o botão login foi acionado
if (isset($_POST['login'])) {
    //instânciar controller
    $objController = new Controller();
    //dados
    $email = htmlspecialchars($_POST['email']);
    $senha = htmlspecialchars($_POST['senha']);
    //invocar o método de validar login
    $objController->validar_login($email, $senha);
}

//recuperar senha
if (isset($_POST['recuperar_senha'])) {
    //instânciar controller
    $objController = new Controller();
    //dados
    $email = htmlspecialchars($_POST['email']);
    //invocar o método recuperar senha
    $objController->recuperarSenha($email);
}

//consultar geral
if (isset($_POST['consultar_geral'])) {
    //instânciar controller
    $objController = new Controller();
    //dados
    $palavra = htmlspecialchars($_POST['palavra']);
    //invocar o método consultar geral
    $objController->consultar_geral($palavra);
}

//gerar pdf
if (isset($_POST['gerar_pdf'])) {
    //instânciar controller
    $objController = new Controller();
    //invocar o método gerar pdf
    $objController->gerar_pdf();
}

//==============================BANCO==============================

//inserir banco
if (isset($_POST['inserir_banco'])) {
    //instânciar controller
    $objController = new Controller();
    //dados
    $nome_banco = htmlspecialchars($_POST['nome_banco']);
    $num_agencia = htmlspecialchars($_POST['num_agencia']);
    $num_conta= htmlspecialchars($_POST['num_conta']);
    //invocar o método de inserir banco
    $objController->inserir_banco($nome_banco, $num_agencia, $num_conta);
}

//consultar banco
if (isset($_POST['consultar_banco'])) {
    //instânciar controller
    $objController = new Controller();
    //dados
    $nome_banco = htmlspecialchars($_POST['nome_banco']);
    //invocar o método de consultar banco
    $objController->consultar_banco($nome_banco);
}

//alterar banco
if (isset($_POST['alterar_banco'])) {
    //instânciar controller
    $objController = new Controller();
    //dados
    $id_cad_banco = htmlspecialchars($_POST['id_cad_banco']);
    $nome_banco = htmlspecialchars($_POST['nome_banco']);
    $num_agencia = htmlspecialchars($_POST['num_agencia']);
    $num_conta = htmlspecialchars($_POST['num_conta']);
    //invocar o método de alterar banco
    $objController->alterar_banco($id_cad_banco, $nome_banco, $num_agencia, $num_conta);
}

//excluir banco
if (isset($_POST['excluir_banco'])) {
    //instânciar controller
    $objController = new Controller();
    //dados
    $id_cad_banco = htmlspecialchars($_POST['id_cad_banco']);
    //invocar o método de excluir banco
    $objController->excluir_banco($id_cad_banco);
}

//==============================BANDEIRA==============================

//inserir bandeira
if (isset($_POST['inserir_bandeira'])) {
    //instânciar controller
    $objController = new Controller();
    //dados
    $nome_band = htmlspecialchars($_POST['nome_band']);
    //invocar o método de inserir bandeira
    $objController->inserir_bandeira($nome_band);
}

//consultar bandeira
if (isset($_POST['consultar_bandeira'])) {
    //instânciar controller
    $objController = new Controller();
    //dados
    $nome_band = htmlspecialchars($_POST['nome_band']);
    //invocar o método de consultar bandeira
    $objController->consultar_bandeira($nome_band);
}

//alterar bandeira
if (isset($_POST['alterar_bandeira'])) {
    //instânciar controller
    $objController = new Controller();
    //dados
    $id_cad_band = htmlspecialchars($_POST['id_cad_band']);
    $nome_band = htmlspecialchars($_POST['nome_band']);
    //invocar o método de alterar bandeira
    $objController->alterar_bandeira($id_cad_band, $nome_band);
}

//excluir bandeira
if (isset($_POST['excluir_bandeira'])) {
    //instânciar controller
    $objController = new Controller();
    //dados
    $id_cad_band = htmlspecialchars($_POST['id_cad_band']);
    //invocar o método de excluir bandeira
    $objController->excluir_bandeira($id_cad_band);
}

//==============================CARTÃO==============================

//inserir cartão
if (isset($_POST['inserir_cartao'])) {
    //instânciar controller
    $objController = new Controller();
    //dados
    $id_cad_band = htmlspecialchars($_POST['id_cad_band']);
    $nome_cartao = htmlspecialchars($_POST['nome_cartao']);
    $num_cartao = htmlspecialchars($_POST['num_cartao']);
    //invocar o método de inserir cartão
    $objController->inserir_cartao($id_cad_band, $nome_cartao, $num_cartao);
}

//consultar cartão
if (isset($_POST['consultar_cartao'])) {
    //instânciar controller
    $objController = new Controller();
    //dados
    $nome_cartao = htmlspecialchars($_POST['nome_cartao']);
    //invocar o método de consultar cartão
    $objController->consultar_cartao($nome_cartao);
}

//alterar cartão
if (isset($_POST['alterar_cartao'])) {
    //instânciar controller
    $objController = new Controller();
    //dados
    $id_cad_cartao = htmlspecialchars($_POST['id_cad_cartao']);
    $id_cad_band = htmlspecialchars($_POST['id_cad_band']);
    $nome_cartao = htmlspecialchars($_POST['nome_cartao']);
    $num_cartao = htmlspecialchars($_POST['num_cartao']);
    //invocar o método de alterar cartão
    $objController->alterar_cartao($id_cad_cartao, $id_cad_band, $nome_cartao, $num_cartao);
}

//excluir cartão
if (isset($_POST['excluir_cartao'])) {
    //instânciar controller
    $objController = new Controller();
    //dados
    $id_cad_cartao = htmlspecialchars($_POST['id_cad_cartao']);
    //invocar o método de excluir cartão
    $objController->excluir_cartao($id_cad_cartao);
}

//==============================FORMA==============================

//inserir forma
if (isset($_POST['inserir_forma'])) {
    //instânciar controller
    $objController = new Controller();
    //dados
    $desc_forma = htmlspecialchars($_POST['desc_forma']);
    //invocar o método de inserir forma
    $objController->inserir_forma($desc_forma);
}

//consultar forma
if (isset($_POST['consultar_forma'])) {
    //instânciar controller
    $objController = new Controller();
    //dados
    $desc_forma = htmlspecialchars($_POST['desc_forma']);
    //invocar o método de consultar forma
    $objController->consultar_forma($desc_forma);
}

//alterar forma
if (isset($_POST['alterar_forma'])) {
    //instânciar controller
    $objController = new Controller();
    //dados
    $id_cad_forma = htmlspecialchars($_POST['id_cad_forma']);
    $desc_forma = htmlspecialchars($_POST['desc_forma']);
    //invocar o método de alterar forma
    $objController->alterar_forma($id_cad_forma, $desc_forma);
}

//excluir forma
if (isset($_POST['excluir_forma'])) {
    //instânciar controller
    $objController = new Controller();
    //dados
    $id_cad_forma = htmlspecialchars($_POST['id_cad_forma']);
    //invocar o método de excluir forma
    $objController->excluir_forma($id_cad_forma);
}

//==============================LANÇAMENTO==============================

//inserir lançamento
if (isset($_POST['inserir_lancamento'])) {
    //instânciar controller
    $objController = new Controller();
    //dados
    $id_cad_tipo = htmlspecialchars($_POST['id_cad_tipo']);
    $id_cad_plano = htmlspecialchars($_POST['id_cad_plano']);
    $desc_lanc = htmlspecialchars($_POST['desc_lanc']);
    $data_venc = htmlspecialchars($_POST['data_venc']);
    $valor_lanc = htmlspecialchars($_POST['valor_lanc']);
    $id_cad_forma = htmlspecialchars($_POST['id_cad_forma']);
    $id_cad_banco = htmlspecialchars($_POST['id_cad_banco']);
    $id_cad_cartao = htmlspecialchars($_POST['id_cad_cartao']);
    $data_rec_pag = htmlspecialchars($_POST['data_rec_pag']);
    //invocar o método de inserir lançamento
    $objController->inserir_lancamento($id_cad_tipo, $id_cad_plano, $desc_lanc, $data_venc, $valor_lanc, $id_cad_forma, $id_cad_banco, $id_cad_cartao, $data_rec_pag);
}

//consultar lançamento
if (isset($_POST['consultar_lancamento'])) {
    //instânciar controller
    $objController = new Controller();
    //dados
    $desc_lanc = htmlspecialchars($_POST['desc_lanc']);
    //invocar o método de consultar lançamento
    $objController->consultar_lancamento($desc_lanc);
}

//alterar lançamento
if (isset($_POST['alterar_lancamento'])) {
    //instânciar controller
    $objController = new Controller();
    //dados
    $id_lanc = htmlspecialchars($_POST['id_lanc']);
    $id_cad_tipo = htmlspecialchars($_POST['id_cad_tipo']);
    $id_cad_plano = htmlspecialchars($_POST['id_cad_plano']);
    $desc_lanc = htmlspecialchars($_POST['desc_lanc']);
    $data_venc = htmlspecialchars($_POST['data_venc']);
    $valor_lanc = htmlspecialchars($_POST['valor_lanc']);
    $id_cad_forma = htmlspecialchars($_POST['id_cad_forma']);
    $id_cad_banco = htmlspecialchars($_POST['id_cad_banco']);
    $id_cad_cartao = htmlspecialchars($_POST['id_cad_cartao']);
    $data_rec_pag = htmlspecialchars($_POST['data_rec_pag']);
    //invocar o método de alterar lançamento
    $objController->alterar_lancamento($id_lanc, $id_cad_tipo, $id_cad_plano, $desc_lanc, $data_venc, $valor_lanc, $id_cad_forma, $id_cad_banco, $id_cad_cartao, $data_rec_pag);
}

//excluir lançamento
if (isset($_POST['excluir_lancamento'])) {
    //instânciar controller
    $objController = new Controller();
    //dados
    $id_lanc = htmlspecialchars($_POST['id_lanc']);
    //invocar o método de excluir lançamento
    $objController->excluir_lancamento($id_lanc);
}

//==============================PLANO==============================

//inserir plano
if (isset($_POST['inserir_plano'])) {
    //instânciar controller
    $objController = new Controller();
    //dados
    $desc_plano = htmlspecialchars($_POST['desc_plano']);
    //invocar o método de inserir plano
    $objController->inserir_plano($desc_plano);
}

//consultar plano
if (isset($_POST['consultar_plano'])) {
    //instânciar controller
    $objController = new Controller();
    //dados
    $desc_plano = htmlspecialchars($_POST['desc_plano']);
    //invocar o método de consultar plano
    $objController->consultar_plano($desc_plano);
}

//alterar plano
if (isset($_POST['alterar_plano'])) {
    //instânciar controller
    $objController = new Controller();
    //dados
    $id_cad_plano = htmlspecialchars($_POST['id_cad_plano']);
    $desc_plano = htmlspecialchars($_POST['desc_plano']);
    //invocar o método de alterar plano
    $objController->alterar_plano($id_cad_plano, $desc_plano);
}

//excluir plano
if (isset($_POST['excluir_plano'])) {
    //instânciar controller
    $objController = new Controller();
    //dados
    $id_cad_plano = htmlspecialchars($_POST['id_cad_plano']);
    //invocar o método de excluir plano
    $objController->excluir_plano($id_cad_plano);
}

//==============================TIPO==============================

//consultar plano
if (isset($_POST['consultar_plano'])) {
    //instânciar controller
    $objController = new Controller();
    //dados
    $desc_plano = htmlspecialchars($_POST['desc_plano']);
    //invocar o método de consultar tipo
    $objController->consultar_plano($desc_tipo);
}

//==============================USUÁRIO==============================

//inserir usuário
if (isset($_POST['inserir_usuario'])) {
    //instânciar controller
    $objController = new Controller();
    //dados
    $nome_usuario = htmlspecialchars($_POST['nome_usuario']);
    $email = htmlspecialchars($_POST['email']);
    $senha= htmlspecialchars($_POST['senha']);
    //invocar o método de inserir usuário
    $objController->inserir_usuario($nome_usuario, $email, $senha);
}

//consultar usuário
if (isset($_POST['consultar_usuario'])) {
    //instânciar controller
    $objController = new Controller();
    //dados
    $nome_usuario = htmlspecialchars($_POST['nome_usuario']);
    //invocar o método de consultar usuário
    $objController->consultar_usuario($nome_usuario);
}

//alterar usuário
if (isset($_POST['alterar_usuario'])) {
    //instânciar controller
    $objController = new Controller();
    //dados
    $id_cad_usuario = htmlspecialchars($_POST['id_cad_usuario']);
    $nome_usuario = htmlspecialchars($_POST['nome_usuario']);
    $email = htmlspecialchars($_POST['email']);
    $senha = htmlspecialchars($_POST['senha']);
    //invocar o método de alterar usuário
    $objController->alterar_usuario($id_cad_usuario, $nome_usuario, $email, $senha);
}

//excluir usuário
if (isset($_POST['excluir_usuario'])) {
    //instânciar controller
    $objController = new Controller();
    //dados
    $id_cad_usuario = htmlspecialchars($_POST['id_cad_usuario']);
    //invocar o método de excluir usuário
    $objController->excluir_usuario($id_cad_usuario);
}