<?php 
	$a = $_POST['id'];
	require("../conn.php");
	$sql="select * from customers where id_customers='".$a."'";
	$ambil_data= mysql_query($sql);	
	while($data=mysql_fetch_array($ambil_data))
	{
?>
<form class="form-horizontal" method="post" action="../config/customers/customers_exe_update.php">
  <div class="form-group">
    <label class="control-label col-sm-2">Kode:</label>
    	<div class="col-sm-5">
      	<input value="<?php  echo $data["kode"]?>" type="text" class="form-control" name="kode" autocomplete="off" required>
      	<input value="<?php  echo $a ?>" type="hidden" class="form-control" name="id" autocomplete="off" readonly>
    </div>
  	</div>
	<div class="form-group">
    	<label class="control-label col-sm-2">Nama:</label>
    	<div class="col-sm-5">
      	<input value="<?php  echo $data["customers_name"]?>" type="text" class="form-control" name="nama" autocomplete="off" required>
    	</div>
  </div>
   <div class="form-group">
    	<label class="control-label col-sm-2">Alamat:</label>
    	<div class="col-sm-5">
      	<input value="<?php  echo $data["alamat"]?>" type="text" class="form-control" name="alamat" autocomplete="off" required>
    	</div>
    </div>
  </div>
    <div class="form-group">
    	<label class="control-label col-sm-2">Telp:</label>
    	<div class="col-sm-5">
      	<input value="<?php  echo $data["telp"]?>" type="text" class="form-control" name="telp" autocomplete="off" required>
    	</div>
    </div>
    <div class="form-group">
    	<label class="control-label col-sm-2">Email:</label>
    	<div class="col-sm-5">
      	<input value="<?php  echo $data["email"]?>" type="email" class="form-control" name="email" autocomplete="off" required>
    	</div>
  </div>
  </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="su" class="btn btn-primary">Save</button>
      </div>
    </div>
  </form> 
<?php
	}
?>


