<?php
session_start();
require_once "koneksi.php";
if (isset($_SESSION["last_activity"]) && (time() - $_SESSION["last_activity"] > 1800)) {
    session_unset();
    session_destroy();
}
if (isset($_SESSION["nim"])) {
    $nim = $_SESSION["nim"];
    $query = "SELECT * FROM mahasiswa JOIN user using (nim) WHERE nim=$nim";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profil</title>
    <link rel="stylesheet" type="text/css" href="./assets/bootstrap.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
</head>

<body>
    <?php include_once "menu.php" ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-4">
                <h1>
                    <?php echo $row["nama"] ?>
                </h1>
                <p class="text-muted h4 mb-5">
                    <?php echo $row["username"] ?>
                </p>
                <a class="btn btn-primary btn-block btn" data-toggle="tooltip" data-placement="top" title="Edit data anda" href="newdata.php?edit=true">Edit Profil</a>
                <a class="btn btn-primary btn-block btn" data-toggle="tooltip" data-placement="top" title="Hapus data anda" href="submit.php?delete=true&nim=<?php echo $nim ?>">Hapus Akun</a>
            </div>
            <div class="col-8">
                <div class="card">
                    <p class="card-header h5">Profil Info</p>
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-4 text-right">Nomor Induk Mahasiswa:</dt>
                            <dd class="col-8">
                                <?php echo $row["nim"] ?>
                            </dd>
                            <dt class="col-4 text-right">Kelas:</dt>
                            <dd class="col-8">
                                <?php echo $row["kelas"] ?>
                            </dd>
                            <dt class="col-4 text-right">Hobi:</dt>
                            <dd class="col-8">
                                <?php echo $row["hobi"] ?>
                            </dd>
                            <dt class="col-4 text-right">Genre Film:</dt>
                            <dd class="col-8">
                                <?php echo $row["genre"] ?>
                            </dd>
                            <dt class="col-4 text-right">Tempat Wisata:</dt>
                            <dd class="col-8">
                                <?php echo $row["wisata"] ?>
                            </dd>
                            <dt class="col-4 text-right">Tanggal Lahir:</dt>
                            <dd class="col-8">
                                <?php echo $row["tanggal"] ?>
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="./assets/bootstrap.js" charset="utf-8"></script>
    <script type="text/javascript">
    $(document).ready(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
    </script>
</body>

</html>
<?php
} else {
        header("Location: index.php");
    } ?>
