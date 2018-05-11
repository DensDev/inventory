
<?php
include "../conn.php";	
if(isset($_POST["submit"]))
{
	$username 	= $_POST['username'];
	$password	= $_POST['password'];
	$sql = "insert into user(username, password)
	values ('".$username."',
			'".$password."')";
	$exec = mysql_query($sql);
	if($exec)
	header('location:../../pages/user.php');
	else
	{
		echo "<script>
			alert('data gagal disimpan');
			window.location.href='../../pages/user.php';
			</script>";
	  //echo $sql;
	}  
}
?>