<?php 
    $a = $_POST['id'];
    require("../conn.php");
    $sql="select transaksi.id_transaksi,transaksi.kode_t,transaksi.id_produk,transaksi.nama,transaksi.id_suppliers,   
          transaksi.id_customers,transaksi.reject,transaksi.qty, 
          produk.id_produk,produk.kode,produk.nama_p, 
          customers.id_customers,customers.customers_name, suppliers.id_suppliers,suppliers.nama 
          from transaksi,produk,customers,suppliers 
          where transaksi.id_produk = produk.id_produk 
          and transaksi.id_customers = customers.id_customers 
          and transaksi.id_suppliers = suppliers.id_suppliers  and transaksi.id_transaksi = '".$a."'";
    $ambil_data= mysql_query($sql); 
    while($data=mysql_fetch_array($ambil_data))
    {
?>
<form class="form-horizontal" method="post" action="../config/transaksi/transaksi_exe_update.php">
  <div class="form-group">
    <label class="control-label col-sm-2">Kode:</label>
    <div class="col-sm-5">
      <input value="<?php  echo $data["kode_t"]?>" type="text" class="form-control" name="kode" autocomplete="off" required>
      <input value="<?php  echo $a ?>" type="hidden" class="form-control" name="id" autocomplete="off" readonly>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2">Kode Barang:</label>
    <div class="col-sm-5">
      <select class="form-control" name="kb" id="barang" onchange="changeValue(this.value)">
           <option value = "<?php echo $data["id_produk"]?>"> <?php echo $data["kode"];?></option>";
            <?php //koneksi
                include ('../config/conn.php');
                $sql = mysql_query("SELECT * FROM produk ORDER BY id_produk ASC");
                 $jsArray = "var dtBrg = new Array();\n";  
                while($row = mysql_fetch_array($sql)){
                echo '<option value="' . $row['id_produk'] . '">' . $row['kode'] . '</option>';   
                $jsArray .= "dtBrg['" . $row['id_produk'] . "'] = {nama:'" . addslashes($row['nama_p']) ."'};\n"; 
                }   
            ?>
        </select>
    </div>
  </div>
   <div class="form-group">
    <label class="control-label col-sm-2">Barang:</label>
    <div class="col-sm-5">
      <input  value="<?php  echo $data["nama_p"]?>" type="text" class="form-control" name="nama" id="nama">
      <script type="text/javascript">   
    <?php echo $jsArray; ?> 
    function changeValue(kb){ 
    document.getElementById('nama').value = dtBrg[kb].nama;  
    }; 
    </script>
    </div>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-2">Supplier:</label>
    <div class="col-sm-5">
      <select class="form-control" name="supplier" ">
           <option value = "<?php echo $data["id_suppliers"]?>"> <?php echo $data["nama"];?></option>";
            <?php //koneksi
                include ('../config/conn.php');
                $sql = mysql_query("SELECT * FROM suppliers ORDER BY id_suppliers ASC");
                while($row = mysql_fetch_array($sql)){
                echo "<option value= $row[id_suppliers]>$row[nama]</option>";
                }   
            ?>
        </select>
    </div>
    </div>
    <div class="form-group">
    <label class="control-label col-sm-2">Customer:</label>
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
    <label class="control-label col-sm-2">Reject:</label>
    <div class="col-sm-5">
      <textarea name="reject" class="form-control" ><?php  echo $data["reject"]?></textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2">Qty:</label>
    <div class="col-sm-5">
      <input  value="<?php  echo $data["qty"]?>" type="text" class="form-control" name="qty">
    </div>
  </div>
       <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="submit" class="btn btn-primary">Save</button>
      </div>
    </div>
  </form> 
<?php
	}
?>


