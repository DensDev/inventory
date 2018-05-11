<?php
	if(isset($_POST['su']))
	{
		$id 	= $_POST['id'];
		$kode 	= $_POST['kode'];
		$nama 	= $_POST['nama'];
		$alamat = $_POST['alamat'];
		$telp 	= $_POST['telp'];
		$email  = $_POST['email'];
		include('../conn.php');
			
			$sql = "update customers set
					kode = '".$kode."', 
					customers_name = '".$nama."',
					alamat = '".$alamat."',
					telp = '".$telp."',
					email = '".$email."' 
					where id_customers = '".$id."'";
			echo $sql;
			$exec = mysql_query($sql);
			
			if($exec)	
			header('location:../../pages/customers.php');
			else
			{
				echo "<script>
				alert('data gagal disimpan');
				window.location.href='../../pages/customers.php';
				</script>";
			}
			//echo $sql;
	}
exit();
?>	