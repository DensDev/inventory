<?php

include '../config/conn.php';
$id = $_GET['id_customers'];
$hps = mysql_query("delete from customers where id_customers=$id");
if ($hps) {
    header("location: customers.php");
} else {
    echo "gagal menghapus";
}
?>