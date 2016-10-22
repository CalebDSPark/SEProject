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
    <!-- daterange picker -->
    <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet" href="../../plugins/datepicker/datepicker3.css">
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
        /*if(frm.boid_new.value.length == 0)
        {
          alert("Please enter the sales order numbers.");
          frm.boid_new.focus();
          return false;
        } */     
      }  

      function DoSelect(frm)
      {                        
        var cate   = $("#s_cate option:selected").val();     
        var genre  = $("#s_genre option:selected").val();     
        
        location.href="request.php?s_cate="+cate+"&s_genre="+genre;
      }

      function DoAdd(frm)
      {        
        var invt_id = frm.id;        
        var cate    = $("#s_cate option:selected").val();   
        var genre   = $("#s_genre option:selected").val();     

        location.href="request.php?bag_invt="+invt_id+"&s_cate="+cate+"&s_genre="+genre;
      }

      function DoDel(frm)
      {        
        var invt_id = frm.id;        
        var cate    = $("#s_cate option:selected").val();    
        var genre   = $("#s_genre option:selected").val();                     

        location.href="request.php?bag_invt="+invt_id+"&s_cate="+cate+"&s_genre="+genre;
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
            Book
            <small>Search</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="../main/main.php"><i class="fa fa-dashboard"></i> Home</a></li>     <li class="active">Book Search</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">

            <div class="col-xs-12">              
            <div class="box box-primary">

                <!-- form start -->
                <!--form role="form" name="formp" method="get" action="booKs.php"-->
                  <div class="box-body">    

                    <!--div class="form-group">
                      <label for="exampleInputFile">Inventory Category</label>
                      <select class="form-control" name="s_category" id="s_category" onchange="DoSelect(this)">
                        {{T_SELECT_CATEGORY}}
                      </select>                         
                    </div-->

                    <div class="row">
                      <div class="col-md-4">                      
                        <div class="form-group">
                          <label>Category</label>
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-align-justify"></i>
                            </div>
                            <select class="form-control" name="s_cate" id="s_cate" onchange="DoSelect(this)">
                            {{T_SELECT_CATE}}
                            </select>  
                          </div><!-- /.input group -->
                        </div><!-- /.form group -->  
                      </div><!-- /.col -->                         
                      <div class="col-md-4">                      
                        <div class="form-group">
                          <label>Genre</label>
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-database"></i>
                            </div>
                            <select class="form-control" name="s_genre" id="s_genre" onchange="DoSelect(this)">
                            {{T_SELECT_GENRE}}
                            </select>  
                          </div><!-- /.input group -->
                        </div><!-- /.form group -->  
                      </div><!-- /.col -->                     
                    </div><!-- /.row --> 

                  </div><!-- /.box-body -->

                  <!--div class="box-footer" align="center">
                    <button type="submit" class="btn btn-primary">Search</button>
                  </div-->
                <!--/form-->
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
                      <th></th>                   
					            <th>Code</th>
                      <th>Title</th>
                      <th>Author</th>
                      <th>Category</th>
                      <th>Genre</th>					            
                      <th>Desc</th>    
                      <th>Status</th>                  
                      </tr>
                    </thead>
                    <tbody>
<!-- LOOP START 'LP' -->
                      <tr>  
                      <td>{{LP.T_BTN}}</td>                    
                      <td>{{LP.T_CODE}}</td>
                      <td>{{LP.T_TITLE}}</td>
                      <td>{{LP.T_AUTHOR}}</td>
                      <td>{{LP.T_CATE}}</td>
                      <td>{{LP.T_GENRE}}</td>
					            <td>{{LP.T_DESC}}</td>
                      <td>{{LP.T_STATUS}}</td>                      
                      </tr>
<!-- LOOP END 'LP' -->

                    </tbody>
                  </table>                    
                </div><!-- /.box-body -->


                       
                  </div><!-- /.box -->
            </div>

            
            <form role="form" name="formp" method="post" action="request_new_submit.php" onsubmit="return CheckSubmit(this)">            
            <div class="col-xs-12">  
            <div class="box">                
                <div class="box-header">
                  <h3 class="box-title">Borrowing Request</h3>
                </div><!-- /.box-header -->

                <div class="box-body">
                
                  <div class="row">                   
                    <div class="col-md-6">
                      <!-- Date range -->
                      <div class="form-group">
                        <label>Borrow Request # </label>
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-th-large"></i>
                          </div>
                          <input type="text" name="boid_new" class="form-control" id="boid_new" value="{{T_BOID_NEW}}" readonly>
                        </div><!-- /.input group -->
                      </div><!-- /.form group -->  
                    </div><!-- /.col -->                      
                    <div class="col-md-6">
                      <!-- Date range -->
                      <div class="form-group">
                        <label>Date</label>
                        <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                          </div>
                          <input type="text" class="form-control pull-right" id="datepicker" name="date" value="{{T_DATE}}">
                        </div><!-- /.input group -->
                      </div><!-- /.form group -->  
                    </div><!-- /.col -->  
                  </div><!-- /.row -->                                  

                  <table id="example3" class="table table-bordered table-striped">
                    <thead>
                      <tr>   
                      <th></th>                   
                      <th>Code</th>
                      <th>Title</th>
                      <th>Author</th>
                      <th>Category</th>
                      <th>Genre</th>                      
                      <th>Desc</th>    
                      <th>Status</th>                  
                      </tr>
                    </thead>
                    <tbody>
<!-- LOOP START 'LP_BAG' -->
                      <tr>
                      <td>{{LP_BAG.T_BTN}}</td>
                      <td>{{LP_BAG.T_CODE}}</td>  
                      <td>{{LP_BAG.T_TITLE}}</td>  
                      <td>{{LP_BAG.T_AUTHOR}}</td>  
                      <td>{{LP_BAG.T_CATE}}</td>  
                      <td>{{LP_BAG.T_GENRE}}</td>
                      <td>{{LP_BAG.T_DESC}}</td>
                      <td>{{LP_BAG.T_STATUS}}</td>      
                      </tr>
<!-- LOOP END 'LP_BAG' -->
                    </tbody>
                  </table>                    
                </div><!-- /.box-body -->                       
                
                  <div class="box-footer" align="center">
                    <a href="#;">
                    <button type="submit" class="btn btn-primary">Save</button>&nbsp;
                    <a href="../main/main.php">
                      <button type="button" class="btn btn-primary">Cancel</button>
                    </a>
                    <!--input type="button" name="Button" value="취소" onClick="window.close();"-->
                    </a>
                  </div>

              </div><!-- /.box -->
            </div><!-- /.col-xs-12 -->

            </form>

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
    <!-- date-range-picker -->
    <!--script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="../../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap datepicker -->
    <script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- page script -->
    <script>
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({ // material list
          "paging": true,
          "lengthChange": true,
          "searching": true,
          "ordering": true,
          "info": true,
          "autoWidth": true,
          "lengthMenu": [[5, 10, 25, 50], [5, 10, 25, 50]]
        });
         $('#example3').DataTable({ // order shopping bag
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": true,
          "lengthMenu": [[5, 10, 25, 50], [5, 10, 25, 50]]
        });
      });

      //Date range picker
      $('#reservation').daterangepicker();

      //Date picker
      $('#datepicker').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'
      });
       
    </script>
  </body>
</html>
