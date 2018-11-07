<?php
require_once "koneksi.php";
session_start();
$errors = "";
if (isset($_POST["register"])) {
    $nim = $_POST["nim"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $rpassword = $_POST["rpassword"];

    if ($nim == "") {
        $errors = "NIM tidak boleh kosong";
        $_SESSION["errors"] = $errors;
        header("Location: register.php");
    } elseif ($username == "") {
        $errors = "Username tidak boleh kosong";
        $_SESSION["errors"] = $errors;
        header("Location: register.php");
    } elseif ($password == "") {
        $errors = "Password tidak boleh kosong";
        $_SESSION["errors"] = $errors;
        header("Location: register.php");
    } elseif ($rpassword == "") {
        $errors = "Password tidak sesuai.";
        $_SESSION["errors"] = $errors;
        header("Location: register.php");
    } else {
        if (is_numeric($nim) && strlen($nim) <= 10) {
            if (!is_numeric($username) && strlen($nim) <= 20) {
                if (strlen($password) > 6) {
                    if ($password == $rpassword) {
                        $query = "INSERT INTO user VALUES('$nim','$username','$password')";
                        if (mysqli_query($conn, $query)) {
                            $next_query = "INSERT INTO mahasiswa VALUES('','','$nim','','','','','')";
                            if (mysqli_query($conn, $next_query)) {
                                header("Location: index.php?login=true");
                            } else {
                                echo "Terjadi kesalahan 2: " . mysqli_error($conn);
                            }
                        } else {
                            echo "Terjadi kesalahan: " . mysqli_error($conn);
                        }
                    } else {
                        $errors = "Password tidak sesuai.";
                        $_SESSION["errors"] = $errors;
                        header("Location: register.php");
                    }
                } else {
                    $errors = "Password harus lebih dari 6 karakter";
                    $_SESSION["errors"] = $errors;
                    header("Location: register.php");
                }
            } else {
                $errors = "Username tidak boleh angka dan lebih dari 20 karakter";
                $_SESSION["errors"] = $errors;
                header("Location: register.php");
            }
        } else {
            $errors = "NIM tidak valid";
            $_SESSION["errors"] = $errors;
            header("Location: register.php");
        }
    }
} elseif (isset($_POST["newdata"])) {
    $nama = $_POST["namadpn"] . " " . $_POST["namablkng"];
    $nim = $_POST["nim"];
    $kelas = $_POST["kelas"];
    $hobi = implode(";", $_POST["hobi"]);
    $genre = implode(";", $_POST["genre"]);
    $wisata = implode(";", $_POST["wisata"]);
    $tanggal = $_POST["tanggal"];

    $query = "UPDATE mahasiswa SET nama='$nama', kelas='$kelas', hobi='$hobi', genre='$genre', wisata='$wisata', tanggal='$tanggal' WHERE nim=$nim";

    if (mysqli_query($conn, $query)) {
        $_SESSION["last_activity"] = time();
        header("Location: profile.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} elseif (isset($_POST["edit"])) {
    $nama = $_POST["namadpn"] . " " . $_POST["namablkng"];
    $nim = $_POST["nim"];
    $kelas = $_POST["kelas"];
    $hobi = implode(";", $_POST["hobi"]);
    $genre = implode(";", $_POST["genre"]);
    $wisata = implode(";", $_POST["wisata"]);
    $tanggal = $_POST["tanggal"];

    $query = "UPDATE mahasiswa SET nama='$nama', kelas='$kelas', hobi='$hobi', genre='$genre', wisata='$wisata', tanggal='$tanggal' WHERE nim=$nim";

    if (mysqli_query($conn, $query)) {
        $_SESSION["last_activity"] = time();
        header("Location: profile.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} elseif (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    if ($username == "") {
        $errors = "Username harus diisi";
        $_SESSION["errors"] = $errors;
        header("Location: index.php?login=true");
    } elseif ($password == "") {
        $errors = "Password harus diisi";
        $_SESSION["errors"] = $errors;
        header("Location: index.php?login=true");
    } else {
        $query = "SELECT nim, username, password FROM user where username='$username'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);

        if ($username == $row["username"]) {
            if ($password == $row["password"]) {
                $_SESSION["is_login"] = true;
                $_SESSION["nim"] = $row["nim"];
                $_SESSION["username"] = $row["username"];
                $_SESSION["last_activity"] = time();
                header("Location: index.php");
            } else {
                $errors = "Password yang anda masukkan salah";
                $_SESSION["errors"] = $errors;
                header("Location: index.php?login=true");
            }
        } else {
            $errors = "Username tidak ditemukan";
            $_SESSION["errors"] = $errors;
            header("Location: index.php?login=true");
        }
    }
} elseif (isset($_GET["delete"]) && $_GET["delete"] == true) {
    $nim = $_GET["nim"];
    $query = "DELETE FROM user WHERE nim = $nim";
    if (mysqli_query($conn, $query)) {
        header("Location: logout.php");
    }
} else {
    header("Location: index.php");
}
