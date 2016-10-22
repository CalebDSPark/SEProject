<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DO Library</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="../../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../../plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript">   
      function CheckSubmit(frm)
      {
        // REQ_STATUS : 0:request, 1:accepted
        var req = {{T_REQ_STATUS}};                

        if(req == '1')
        {
          alert("This request has already been accepted.");
          return;
        }              

        var yn = confirm("Do you want to accecpt this request?");            
        if(yn) location.href='msgborrow_detail_submit.php?p_boid={{T_BOID}}';             
      }  

    </script>  

  </head>
  
   <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <!-- INCLUDE FILE '../../include/header.tpl' -->

      <!-- INCLUDE FILE '../../include/left_menu.tpl' -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Management Borrowing
            <small>Detail</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="../main/main.php"><i class="fa fa-dashboard"></i> Home</a></li>     
            <li><a href="msgborrow.php"><i class="fa fa-dashboard"></i> Borrowing</a></li>     
            <li class="active">Borrowing Detail</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">

                                  
            <div class="col-xs-12">              
            <div class="box box-primary">

                             
              </div><!-- /.box -->
             </div>

            <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                  <h3 class="box-title">{{T_TITLE}}</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="example2" class="table table-bordered table-striped">
                    <thead>
                      <tr>  
                      <th>Title</th>  
                      <th>Code</th>                        
                      <th>Author</th>                    
					            <th>Category</th>                  
                      <th>Genre</th>       
                      <th>Book Status</th>                  
                      </tr>
                    </thead>
                    <tbody>
<!-- LOOP START 'LP' -->
                      <tr>     
                      <td>{{LP.T_TITLE}}</td>                       
                      <td>{{LP.T_CODE}}</td>     
                      <td>{{LP.T_AUTHOR}}</td>                
                      <td>{{LP.T_CATE}}</td>
                      <td>{{LP.T_GENRE}}</td>
                      <td>{{LP.T_STATUS}}</td>                                      
                      </tr>
<!-- LOOP END 'LP' -->

                    </tbody>
                  </table>                    
                </div><!-- /.box-body -->
                       
                  <div class="box-footer" align="center">
                    <a href="#;">
                    <button type="button" class="btn btn-success" onclick="CheckSubmit(this)">Accept</button>
                    </a>
                    &nbsp;
                    <a href="msgborrow.php">
                      <button type="button" class="btn btn-primary">Cancel</button>
                    </a>
                  </div>

              </div><!-- /.box -->
            </div><!-- /.col-xs-12 -->

            

          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


      <!-- INCLUDE FILE '../../include/footer.tpl' -->


    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <!-- DataTables -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- SlimScroll -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <!-- page script -->
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": false,
          "info": true,
          "autoWidth": false
        });
      });
    </script>
  </body>
</html>
