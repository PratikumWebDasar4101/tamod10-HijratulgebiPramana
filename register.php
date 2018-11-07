<?php
session_start();
if (isset($_SESSION["last_activity"]) && (time() - $_SESSION["last_activity"] > 1800)) {
    session_unset();
    session_destroy();
}
if (isset($_SESSION["is_login"])) {
    header("Location: index.php");
}
$errors = (!empty($_SESSION["errors"])) ? $_SESSION["errors"] : "";
$error = (!empty($errors)) ? $errors : "";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="./assets/bootstrap.css">
</head>

<body>
    <div class="container">
        <form action="submit.php" method="post">
            <div class="row">
                <div class="col"></div>
                <div class="col">
                    <h2 class="mt-4 text-center">Registrasi</h2>
                    <p class="text-muted text-center">Silahkan Buat Akun Anda Terlebih Dahulu!</p>
                    <?php if (!empty($error)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error ?>
                    </div>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="text" class="form-control" name="nim" value="<?php echo isset($_POST[" nim"]) ? $_POST["nim"] : '' ; ?>" placeholder="Nomor Induk Mahasiswa aktif">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="rpassword">Re-type Password</label>
                        <input type="password" class="form-control" name="rpassword" placeholder="Re-type Password">
                    </div>
                    <button class="btn btn-outline-primary btn-block" type="submit" name="register">Kirim</button>
                    <p class="py-2"><small>Telah memiliki akun? <a href="index.php?login=true">Masuk disini</a></small></p> 
                </div>
                <div class="col"></div>
            </div>
        </form>
    </div>
</body>

</html>
<?php
unset($_SESSION["errors"]);
?>
