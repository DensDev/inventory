<?php

include '../config/conn.php';
$id = $_GET['id_produk'];
$hps = mysql_query("delete from produk where id_produk=$id");
if ($hps) {
    header("location: barang.php");
} else {
    echo "gagal menghapus";
}
?>