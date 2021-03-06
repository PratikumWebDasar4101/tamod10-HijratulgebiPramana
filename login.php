<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Selamat Datang</title>
    <link rel="stylesheet" type="text/css" href="./assets/bootstrap.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <h2 class="my-4 text-center">Masuk</h2>
                <form action="submit.php" method="post">
                    <div class="form-group">
                        <?php if (!empty($error)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error ?>
                        </div>
                        <?php endif; ?>
                        <label for="username">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" name="login">Masuk</button>
                </form>
                <p class="py-2"><small>Belum memiliki akun? <a href="register.php">Buat sekarang</a></small></p>
            </div>
            <div class="col"></div>
        </div>
    </div>
</body>

</html>
