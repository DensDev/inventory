<?php

include '../config/conn.php';
$id = $_GET['id_suppliers'];
$hps = mysql_query("delete from suppliers where id_suppliers=$id");
if ($hps) {
    header("location: suppliers.php");
} else {
    echo "gagal menghapus";
}
?>