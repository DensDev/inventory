<?php
	if(isset($_POST['su']))
	{
		$id 		= $_POST['id'];
		$kode 		= $_POST['kode'];
		$nama 		= $_POST['nama'];
		$qty 		= $_POST['qty'];
		$customer 	= $_POST['customer'];
		include('../conn.php');
			
			$sql = "update produk set
					kode = '".$kode."', 
					nama_p = '".$nama."',
					qty = '".$qty."',
					id_customers = '".$customer."' 
					where id_produk = '".$id."'";
			echo $sql;
			$exec = mysql_query($sql);
			
			if($exec)	
			header('location:../../pages/barang.php');
			else
			{
				echo "<script>
				alert('data gagal disimpan');
				window.location.href='../../pages/barang.php';
				</script>";
			}
			//echo $sql;
	}
exit();
?>	