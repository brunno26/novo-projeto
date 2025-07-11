<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login - SB Admin 2</title>

  <link href="template/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,400,700" rel="stylesheet">
  <link href="template/css/sb-admin-2.min.css" rel="stylesheet">

  <link href="template/css/custom-login.css" rel="stylesheet">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">

  <link rel="stylesheet" href="static/style.css">
</head>

<body>
  <div class="container d-flex align-items-center justify-content-center" style="min-height: 100vh;">
    <div class="col-12">
      <div class="card o-hidden border-0 shadow-lg animate__animated animate__fadeInDown login-card-altura">
        <div class="card-body p-0">
          <div class="row">
            <div class="col-lg-5 d-none d-lg-block bg-login-image" id="cover-image"></div>

            <div class="col-lg-7">
              <div class="p-5">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Bem-vindo de volta!</h1>
                </div>
                <form class="user" action="index.php" method="post">
                  <div class="form-group">
                    <input type="email" class="form-control form-control-user" name="email" placeholder="Digite seu e-mail" required>
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-user" name="senha" placeholder="Digite sua senha" required>
                  </div>
                  <button class="btn btn-primary btn-user btn-block" name="login" type="submit">
                    <i class="fas fa-sign-in-alt"></i> Acessar
                  </button>
                </form>
                <hr>
                <div class="text-center">
                  <a class="small" href="inserir_usuario.php">Cadastre-se?</a>
                </div>
                <hr>
                <div class="text-center">
                  <a class="small" href="recuperar.php">Esqueceu a senha?</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="template/vendor/jquery/jquery.min.js"></script>
  <script src="template/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="template/vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="template/js/sb-admin-2.min.js"></script>
</body>

</html>