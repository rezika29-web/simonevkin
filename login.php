<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="utf-8" />
        <title>Log In | SIMONEVKIN</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/pemerintah-daerah.png">

        <!-- App css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
        <link href="assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />
</head>

<body class="authentication-bg pb-0" data-layout-config='{"darkMode":false}'>
<div class="auth-fluid">
            <!--Auth fluid left content -->
            <div class="auth-fluid-form-box">
                <div class="align-items-center d-flex h-100">
                    <div class="card-body">

                        <!-- Logo -->
                        <div class="auth-brand text-center text-lg-start">
                            <a href="index.php" class="logo-dark">
                                <span><img src="assets/images/pemerintah-daerah.png" alt="" height="80"></span>
                                <b><span style="font-size: 30px; color: #000;"> SIMONEVKIN </span></b>
                            </a>
                        </div>

                         <!-- title-->
                         <h4 class="mt-0">Masuk</h4>
                        <p class="text-muted mb-4">Masukkan username dan password anda.</p>

                   <form class="user" method="POST" action="login.php">
                    <div class="form-group mb-3">
                      <input class="form-control" type="text" id="username" name="username" placeholder="Input username">
                    </div>
                    <div class="form-group mb-3">
                      <input name="password" type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                    </div>
                    <div class="mb-3">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="checkbox-signin">
                                    <label class="form-check-label" for="checkbox-signin">Remember me</label>
                                </div>
                            </div>
                            <div class="d-grid mb-0 text-center">
                                <button class="btn btn-primary" type="submit" name="login"><i class="mdi mdi-login"></i> Masuk </button>
                            </div>
                  </form>
                  <hr>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

    <!-- bundle -->
    <script src="assets/js/vendor.min.js"></script>
    <script src="assets/js/app.min.js"></script>

    <?php

if (isset($_POST['login'])) {


  spl_autoload_register(function ($class) {
    require_once 'controller/auth/' . $class . '.php';
  });

  $wp = new Authentication();

  $email = $_POST['username'];
  $password = $_POST['password'];

  try {
    $wp->login($email, $password);
  } catch (\Throwable $th) {
    throw $th;
  }
}
if (@$_GET['logout'] == 'true') {
  session_start();
  session_destroy();
} else {
  
}
?>


</body>

</html>