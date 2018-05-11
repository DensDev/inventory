<?php
include "../conn.php";	
if(isset($_POST["submit"]))
{
	$kode 	= $_POST['kode'];
	$nama 	= $_POST['nama'];
	$alamat = $_POST['alamat'];
	$telp 	= $_POST['telp'];
	$email  = $_POST['email'];
	$sql 	= "insert into customers(kode,customers_name,alamat,telp,email)
	values ('".$kode."',
			'".$nama."',
			'".$alamat."',
			'".$telp."',
			'".$email."')";
	$exec = mysql_query($sql);
	if($exec)
	header('location:../../pages/customers.php');
	else
	{
		echo "<script>
			alert('data gagal disimpan');
			window.location.href='../../pages/customers.php';
			</script>";
	  //echo $sql;
	}  
}
?>