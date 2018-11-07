<?php
$conn = mysqli_connect('localhost','root','','jurnal');
if (!$conn) {
  die('Gagal terhubung' . mysqli_error($conn));
}
