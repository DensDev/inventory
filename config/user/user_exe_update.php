<?php
	if(isset($_POST['submit']))
	{
		$id 		= $_POST['id'];
		$kode 		= $_POST['kode'];
		$kb			= $_POST['kb'];
		$nama 		= $_POST['nama'];
		$supplier 	= $_POST['supplier'];
		$customer 	= $_POST['customer'];
		$reject 	= $_POST['reject'];
		$qty 		= $_POST['qty'];
		include('../conn.php');
			
			$sql = "update transaksi set
					kode_t 				= '".$kode."',
					id_produk 			= '".$kb."', 
					nama 				= '".$nama."',
					id_suppliers 		= '".$supplier."',
					id_customers 		= '".$customer."',
					reject 				= '".$reject."',
					qty 				= '".$qty."' 
					where id_transaksi 	= '".$id."'";
			echo $sql;
			$exec = mysql_query($sql);
			
			if($exec)	
			header('location:../../pages/transaksi.php');
			else
			{
				echo "<script>
				alert('data gagal disimpan');
				window.location.href='../../pages/transaksi.php';
				</script>";
			}
			//echo $sql;
	}
exit();
?>	