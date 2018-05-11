
<?php
include "../conn.php";	
if(isset($_POST["submit"]))
{
	$kode 		= $_POST['kode'];
	$nama 		= $_POST['nama'];
	$qty 		= $_POST['qty'];
	$customer 	= $_POST['customer'];
	$sql = "insert into produk(kode,nama_p,qty,id_customers)
	values ('".$kode."',
			'".$nama."',
			'".$qty."',
			'".$customer."')";
	$exec = mysql_query($sql);
	if($exec)
	header('location:../../pages/barang.php');
	else
	{
		echo "<script>
			alert('data gagal disimpan');
			window.location.href='../../pages/barang.php';
			</script>";
	  //echo $sql;
	}  
}
?>