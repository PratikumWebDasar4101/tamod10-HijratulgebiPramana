<?php
session_start();
if (isset($_SESSION["last_activity"]) && (time() - $_SESSION["last_activity"] > 1800)) {
    session_unset();
    session_destroy();
}
require_once "koneksi.php";
$nim = $_SESSION["nim"];
$query = "SELECT * FROM mahasiswa WHERE nim = $nim";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>New Data</title>
    <link rel="stylesheet" type="text/css" href="./assets/bootstrap.css">
</head>

<body>
    <?php include_once "menu.php" ?>
    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <?php
                if (isset($_GET["edit"]) && isset($_GET["edit"]) == true && $row["nama"] != '') {
                    $nama = explode(" ", $row["nama"]);
                    $hobi = explode(";", $row["hobi"]);
                    $genre = explode(";", $row["genre"]);
                    $wisata = explode(";", $row["wisata"]); ?>
                    <h2 class="my-4 text-center">Edit Profil</h2>
                    <p class="text-center text-muted">Lengkapi data anda sesuai dengan identitas anda.</p>
                    <form action="submit.php" method="post">
                        <div class="form-row form-group">
                            <div class="col">
                                <input type="text" name="namadpn" class="form-control" value="<?php echo $nama[0] ?>" placeholder="Nama Depan">
                            </div>
                            <div class="col">
                                <input type="text" name="namablkng" class="form-control" value="<?php echo $nama[1] ?>" placeholder="Nama Belakang">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nim">NIM</label>
                            <input type="text" class="form-control" name="nim" value="<?php echo $nim ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="kelas">Kelas</label>
                            <input type="text" class="form-control" name="kelas" value="<?php echo $row["kelas"] ?>">
                        </div>
                        <div class="form-group form-row">
                            <div class="col">
                                <label>Hobi</label>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="hobi[]" id="membaca" value="Membaca" <?php echo(in_array("Membaca", $hobi)?"checked":"") ?>>
                                    <label class="custom-control-label" for="membaca">Membaca</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="hobi[]" id="menulis" value="Menulis" <?php echo(in_array("Menulis", $hobi)?"checked":"") ?>>
                                    <label class="custom-control-label" for="menulis">Menulis</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="hobi[]" id="menari" value="Menari" <?php echo(in_array("Menari", $hobi)?"checked":"") ?>>
                                    <label class="custom-control-label" for="menari">Menari</label>
                                </div>
                            </div>
                            <div class="col">
                                <label>Genre</label>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="genre[]" id="horror" value="Horror" <?php echo(in_array("Horror", $genre)?"checked":"") ?>>
                                    <label class="custom-control-label" for="horror">Horror</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="genre[]" id="action" value="Action" <?php echo(in_array("Action", $genre)?"checked":"") ?>>
                                    <label class="custom-control-label" for="action">Action</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="genre[]" id="drama" value="Drama" <?php echo(in_array("Drama", $genre)?"checked":"") ?>>
                                    <label class="custom-control-label" for="drama">Drama</label>
                                </div>
                            </div>
                            <div class="col">
                                <label>Tempat Wisata</label>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="wisata[]" id="bali" value="Bali" <?php echo(in_array("Bali", $wisata)?"checked":"") ?>>
                                    <label class="custom-control-label" for="bali">Bali</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="wisata[]" id="tanjungSelor" value="Tanjung Selor" <?php echo(in_array("Tanjung Selor", $wisata)?"checked":"") ?>>
                                    <label class="custom-control-label" for="tanjungSelor">Tanjung Selor</label>
                                </div>
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="wisata[]" id="jakarta" value="Jakarta" <?php echo(in_array("Jakarta", $wisata)?"checked":"") ?>>
                                    <label class="custom-control-label" for="jakarta">Jakarta</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal" value="<?php echo $row["tanggal"] ?>">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block" name="edit">Input</button>
                    </form>
                <?php
                } else {
                    if ($row["nama"] == '') {
                        ?>
                <h2 class="my-4 text-center">Lengkapi Data</h2>
                <p class="text-center text-muted">Lengkapi data anda sesuai dengan identitas anda.</p>
                <form action="submit.php" method="post">
                    <div class="form-row form-group">
                        <div class="col">
                            <input type="text" name="namadpn" class="form-control" placeholder="Nama Depan">
                        </div>
                        <div class="col">
                            <input type="text" name="namablkng" class="form-control" placeholder="Nama Belakang">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="nim">NIM</label>
                        <input type="text" class="form-control" name="nim" value="<?php echo $_SESSION["nim"] ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <input type="text" class="form-control" name="kelas">
                    </div>
                    <div class="form-group form-row">
                        <div class="col">
                            <label>Hobi</label>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="hobi[]" id="membaca" value="Membaca">
                                <label class="custom-control-label" for="membaca">Membaca</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="hobi[]" id="menulis" value="Menulis">
                                <label class="custom-control-label" for="menulis">Menulis</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="hobi[]" id="menari" value="Menari">
                                <label class="custom-control-label" for="menari">Menari</label>
                            </div>
                        </div>
                        <div class="col">
                            <label>Genre</label>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="genre[]" id="horror" value="Horror">
                                <label class="custom-control-label" for="horror">Horror</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="genre[]" id="action" value="Action">
                                <label class="custom-control-label" for="action">Action</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="genre[]" id="drama" value="Drama">
                                <label class="custom-control-label" for="drama">Drama</label>
                            </div>
                        </div>
                        <div class="col">
                            <label>Tempat Wisata</label>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="wisata[]" id="bali" value="Bali">
                                <label class="custom-control-label" for="bali">Bali</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="wisata[]" id="tanjungSelor" value="Tanjung Selor">
                                <label class="custom-control-label" for="tanjungSelor">Tanjung Selor</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="wisata[]" id="jakarta" value="Jakarta">
                                <label class="custom-control-label" for="jakarta">Jakarta</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggal">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" name="newdata">Input</button>
                </form>
                <?php
                    } else {
                        header("Location: newdata.php?edit=true");
                    }
                } ?>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
</body>

</html>
