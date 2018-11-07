<?php
session_start();
require_once "koneksi.php";
if (isset($_SESSION["last_activity"]) && (time() - $_SESSION["last_activity"] > 1800)) {
    session_unset();
    session_destroy();
}
if (!isset($_SESSION["is_login"])) {
    header("Location: index.php");
} else {
    $nim = $_SESSION["nim"];
    if (isset($_GET["cari"])) {
        $value = $_GET["cari"];
        $query = "SELECT * FROM user e LEFT OUTER JOIN mahasiswa m USING (nim) WHERE nim like '%$value%' or username like '%$value%'";
    } else {
        $query = "SELECT * FROM user e LEFT OUTER JOIN mahasiswa m USING (nim)";
    }
    $query2 = "SELECT * FROM mahasiswa WHERE nim=$nim";
    $result = mysqli_query($conn, $query);
    $result2 = mysqli_query($conn, $query2);
    $row2 = mysqli_fetch_array($result2); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Dasbor</title>
  <link rel="stylesheet" type="text/css" href="./assets/bootstrap.css">
</head>
<body>
  <?php include_once "menu.php" ?>
  <div class="container">
    <?php if (empty($row2["nama"])): ?>
      <div class="alert alert-warning mt-5 py-3" role="alert">
        Sepertinya anda belum melengkapi data pribadi anda, segera lengkapi data diri anda <a href="newdata.php" class="alert-link">disini</a>
      </div>
    <?php endif; ?>
    <div class="d-flex mt-5 mb-3">
      <div class="flex-row mr-auto"><h2>list Data User</h2></div>
      <div class="flex-row-reverse">
        <form action="dashboard.php" method="get">
          <div class="form-inline">
            <input type="text" class="form-control mr-2" name="cari" placeholder="Cari username atau nim">
            <button type="submit" class="btn btn-outline-success">Cari</button>
          </div>
        </form>
      </div>
    </div>
    <table class="table table-sm">
      <thead>
        <tr>
          <th width="5%">#</th>
          <th>NIM</th>
          <th>Username</th>
          <th>Nama</th>
          <th>Kelas</th>
          <th>Hobi</th>
          <th>Genre Film</th>
          <th>Tujuan Wisata</th>
          <th>Tanggal Lahir</th>
        </tr>
      </thead>
      <tbody>
      <?php echo mysqli_error($conn); ?>
      <?php if (isset($result) && mysqli_num_rows($result) > 0) {
        ?>
        <?php
          $i = 1;
        while ($row = mysqli_fetch_array($result)) {
            ?>
        <tr <?php echo (isset($_SESSION['nim']) && $_SESSION['nim'] == $row['nim']) ? 'class="table-active"' : '' ?>>
          <th scope="row"><?php echo $i ?></th>
          <td><?php echo $row["nim"] ?></td>
          <td><?php echo $row["username"] ?></td>
          <td><?php echo ($row["nama"] != "") ? $row["nama"] : "-" ?></td>
          <td><?php echo ($row["kelas"] != "") ? $row["kelas"] : "-" ?></td>
          <td><?php echo ($row["hobi"] != "") ? $row["hobi"] : "-" ?></td>
          <td><?php echo ($row["genre"] != "") ? $row["genre"] : "-" ?></td>
          <td><?php echo ($row["wisata"] != "") ? $row["wisata"] : "-" ?></td>
          <td><?php echo ($row["tanggal"] != "") ? $row["tanggal"] : "-" ?></td>
        </tr>
        <?php
          $i++;
        } ?>
      <?php
    } else {
        ?>
        <tr>
          <td colspan="3" class="text-center">0 Results.</td>
        </tr>
      <?php
    } ?>
      </tbody>
    </table>
  </div>
</body>
</html>
<?php
}
