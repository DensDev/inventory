<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Aplikasi Inventory</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="../vendor/morrisjs/morris.css" rel="stylesheet">

    <link rel="stylesheet" href="../vendor/datatables-plugins/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../vendor/datatables-responsive/css/dataTables.responsive.css">

    <!-- Custom Fonts -->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        

        <?php include('menu.php');?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Transaksi</h1>
                    <h5> <div class="datewidget">Hari ini: <?php echo date("d M Y"); ?></div></h5>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCustomers">Tambah Transaksi</button>
                    <a href="printLaporan.php" class="btn btn-info" role="button" target="_blank"><i class="fa fa-print" aria-hidden="true"> Print</i></a>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            &nbsp;
            <table id="dataTables-example" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Nama Supplier</th>
                        <th>Nama Customer</th>
                        <th>Keterangan Reject</th>
                        <th>Qty</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                require("../config/conn.php");
                $sql="select transaksi.id_transaksi,transaksi.kode_t,transaksi.id_produk,transaksi.nama,transaksi.id_suppliers, transaksi.id_customers,transaksi.reject,transaksi.qty, 
                    produk.id_produk,produk.kode,produk.nama_p, 
                    customers.id_customers,customers.customers_name, suppliers.id_suppliers,suppliers.nama 
                    from transaksi,produk,customers,suppliers 
                    where transaksi.id_produk = produk.id_produk 
                    and transaksi.id_customers = customers.id_customers 
                    and transaksi.id_suppliers = suppliers.id_suppliers ";
                $ambil_data= mysql_query($sql);
                $no=1; 
                while($data=mysql_fetch_array($ambil_data))
                {
                ?>
                <tr class='odd gradeX'>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data['kode_t'] ?></td>
                    <td><?php echo $data['kode'] ?></td>
                    <td><?php echo $data['nama_p'] ?></td>
                    <td><?php echo $data['nama'] ?></td>
                    <td><?php echo $data['customers_name'] ?></td>
                    <td><?php echo $data['reject'] ?></td>
                    <td><?php echo $data['qty'] ?></td>
                    <td><i class="fa fa-pencil-square-o" aria-hidden="true"><a href="#" class="edit-record" value= "<?php echo $data['id_transaksi'] ?>">Edit</a> </i>  
                        <i class="fa fa-trash-o" aria-hidden="true"><a href="hapus_transaksi.php?id_transaksi=<?php echo $lihat['id_transaksi'] ?>" onClick="return confirm ('Yakin akan menghapus?')">Hapus</a></i>
                    </td>
                </tr>
                <?php } ?>
                </tbody>
                
                
            </table>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../data/morris-data.js"></script>
     <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>
<!-- Modal edit-->
    <div class="modal fade" id="myModale" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button  onclick='window.location.reload();' type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Update Transaksi</h4>
                </div>
                <div class="modal-body col-lg-12">
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <!-- Modal edit-->
    <script>
        $(function(){
            $(document).on('click','.edit-record',function(e){
                e.preventDefault();
                $("#myModale").modal('show');
                $.post('../config/transaksi/transaksi_modal_update.php',
                    {id:$(this).attr('value')},
                    function(html){
                        $(".modal-body").html(html);
                    }   
                );
            });
        });
    </script>

<!-- Modal -->
<div id="modalCustomers" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah Transaksi</h4>
      </div>
      <div class="modal-body">
<form class="form-horizontal" method="post" action="../config/transaksi/transaksi_add.php">
  <div class="form-group">
    <label class="control-label col-sm-2">Kode:</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" name="kode" placeholder="Kode Transaski">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2">Kode Barang:</label>
    <div class="col-sm-5">
      <select class="form-control" name="kb" id="barang" onchange="changeValue(this.value)">
            <option>-- Silahkan Pilih --</option>
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
      <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama Barang">
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
            <option>-- Silahkan Pilih --</option>
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
            <option>-- Silahkan Pilih --</option>
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
      <textarea name="reject" class="form-control"></textarea>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2">Qty:</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" name="qty" placeholder="Qty">
    </div>
  </div>
       <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="submit" class="btn btn-primary">Save</button>
      </div>
    </div>
  </form> 
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
