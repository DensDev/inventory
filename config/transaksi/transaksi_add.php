
<?php
include "../conn.php";	
if(isset($_POST["submit"]))
{
	$kode 		= $_POST['kode'];
	$kb			= $_POST['kb'];
	$nama 		= $_POST['nama'];
	$supplier 	= $_POST['supplier'];
	$customer 	= $_POST['customer'];
	$reject 	= $_POST['reject'];
	$qty 		= $_POST['qty'];
	$sql = "insert into transaksi(kode_t,id_produk,nama,id_suppliers,id_customers,reject,qty)
	values ('".$kode."',
			'".$kb."',
			'".$nama."',
			'".$supplier."',
			'".$customer."',
			'".$reject."',
			'".$qty."')";
	$exec = mysql_query($sql);
	if($exec)
	header('location:../../pages/transaksi.php');
	else
	{
		echo "<script>
			alert('data gagal disimpan');
			window.location.href='../../pages/transaksi.php';
			</script>";
	  //echo $sql;
	}  
}
?>