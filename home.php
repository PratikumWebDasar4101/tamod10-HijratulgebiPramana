<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Profil</title>
  <link rel="stylesheet" type="text/css" href="./assets/bootstrap.css">
</head>
<body>
  <?php include_once "menu.php" ?>
  <div class="jumbotron bg-warning">
    <?php if (!isset($_SESSION["is_login"])) { ?>
      <div class="container text-center">
        <h1 class="display-4">Welcome Prada!</h1>
        <p class="my-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

        <p><a class="btn btn-outline-primary" href="register.php">Registrasi</a><a class="btn btn-outline-dark" href="index.php?login=true">Login</a></p>
      </div>

    <?php }else { ?>
      <div class="container text-center">
        <h1 class="display-4">Selamat Datang! <?php echo $_SESSION["username"] ? $_SESSION["username"] : 'Guest' ?></h1>
        <p class="my-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>

        <p><a class="btn btn-outline-primary" href="dashboard.php">Dasbor</a><a class="btn btn-outline-dark" href="profile.php">Profil</a></p>
      </div>
    <?php } ?>
  </div>
</body>
</html>
