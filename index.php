    <?php
    session_start();
    error_reporting(~E_ALL & ~E_NOTICE & ~E_WARNING);

    include_once 'autoload.php';

    // include_once 'controller/Controller.class.php';
    // $objController = new Controller();
    // if (!isset($_POST['recuperar_senha'])) {
    //     $objController->validarSessao();
    // }

    include_once 'includes/header.php'; // layout visual (começo)

    include_once 'router.php';          // conteúdo da página (dinâmico)

    include_once 'includes/footer.php'; // layout visual (final)
    ?>