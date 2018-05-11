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
                    <h1 class="page-header">User</h1>
                    <h5> <div class="datewidget">Hari ini: <?php echo date("d M Y"); ?></div></h5>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalBarang">Tambah User</button>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            &nbsp;
            <table id="dataTables-example" class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                require("../config/conn.php");
                $sql="select * from user";
                $ambil_data= mysql_query($sql);
                $no=1; 
                while($data=mysql_fetch_array($ambil_data))
                {
                ?>
                <tr class='odd gradeX'>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $data['username'] ?></td>
                    <td><?php echo $data['password'] ?></td>
                    <td><i class="fa fa-pencil-square-o" aria-hidden="true"><a href="#" class="edit-record" value= "<?php echo $data['id_user'] ?>">Edit</a> </i>  
                        <i class="fa fa-trash-o" aria-hidden="true"><a href="hapus_user.php?id_user=<?php echo $data['id_user'] ?>" onClick="return confirm ('Yakin akan menghapus?')">Hapus</a></i>
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
<!-- Modal -->
<div id="modalBarang" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Tambah User</h4>
      </div>
      <div class="modal-body">
     <form class="form-horizontal" method="post" action="../config/user/user_add.php">
  <div class="form-group">
    <label class="control-label col-sm-2">Username:</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" name="username" placeholder="Username"  required>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2">Password:</label>
    <div class="col-sm-5">
      <input type="password" class="form-control" name="password" placeholder="Password" required>
    </div>
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
<!-- Modal edit-->
        <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button  onclick='window.location.reload();' type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

                    
                    <h4 class="modal-title" id="myModalLabel">Update User</h4>
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
                $("#modalEdit").modal('show');
                $.post('../config/user/user_modal_update.php',
                    {id:$(this).attr('value')},
                    function(html){
                        $(".modal-body").html(html);
                    }   
                );
            });
        });
    </script>
 <script type="application/javascript">
    function isNumberKeyTrue(evt)
        {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 65)
            return false;         
         return true;
        }
    </script>