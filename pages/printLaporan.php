<?php
//memulai menggunakan mpdf
// Tentukan path yang tepat ke mPDF
$nama_dokumen='Laporan'; //Beri nama file PDF hasil.
define('_MPDF_PATH','../mpdf/'); // Tentukan folder dimana anda menyimpan folder mpdf
include(_MPDF_PATH . "mpdf.php"); // Arahkan ke file mpdf.php didalam folder mpdf
$mpdf=new mPDF('utf-8', 'A4', 10.5, 'arial'); // Membuat file mpdf baru
 
//Memulai proses untuk menyimpan variabel php dan html
ob_start();

?>
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
                    <h1 class="page-header">Laporan</h1>
                    <h5> <div class="datewidget">Hari ini: <?php echo date("d M Y"); ?></div></h5>
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
<?php
//penulisan output selesai, sekarang menutup mpdf dan generate kedalam format pdf

$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean();
//Disini dimulai proses convert UTF-8, kalau ingin ISO-8859-1 cukup dengan mengganti $mpdf->WriteHTML($html);
$mpdf->WriteHTML(utf8_encode($html));
$mpdf->Output($nama_dokumen.".pdf" ,'I');
exit;
?>