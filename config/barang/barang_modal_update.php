<?php 
    $a = $_POST['id'];
    require("../conn.php");
    $sql="select produk.id_produk,produk.kode,produk.nama_p,produk.qty,produk.id_customers,customers.id_customers,customers.customers_name from produk,customers where produk.id_customers = customers.id_customers and produk.id_produk = '".$a."'";
    $ambil_data= mysql_query($sql); 
    while($data=mysql_fetch_array($ambil_data))
    {
?>
<form class="form-horizontal" method="post" action="../config/barang/barang_exe_update.php">
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
      	<input value="<?php  echo $data["nama_p"]?>" type="text" class="form-control" name="nama" autocomplete="off" required>
    	</div>
  </div>
   <div class="form-group">
    	<label class="control-label col-sm-2">Qty:</label>
    	<div class="col-sm-5">
      	<input value="<?php  echo $data["qty"]?>" type="text" class="form-control" name="qty" autocomplete="off" required>
    	</div>
    </div>
  </div>
    <div class="form-group">
    	<label class="control-label col-sm-2">Customers:</label>
    	<div class="col-sm-5">
      	<select class="form-control" name="customer" ">
            <option value = "<?php echo $data["id_customers"]?>"> <?php echo $data["customers_name"];?></option>";
            <?php //koneksi
                include ('../config/conn.php');
                $sql = mysql_query("SELECT * FROM customers ORDER BY id_customers ASC");
                while($row = mysql_fetch_array($sql)){
                echo "<option value= $row[id_customers]>$row[customers_name]</option>";
                }   
            ?>
        </select>
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


