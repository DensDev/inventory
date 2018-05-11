<?php

include '../config/conn.php';
$id = $_GET['id_transaksi'];
$hps = mysql_query("delete from transaksi where id_transaksi=$id");
if ($hps) {
    header("location: transaksi.php");
} else {
    echo "gagal menghapus";
}
?>