<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
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
    <!-- Theme style -->
    <link rel="stylesheet" href="../../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../../dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../../plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="../../plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="../../plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="../../plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript">
      function CheckSubmit(frm)
      {               
        if(frm.code.value.length == 0)
        {
          alert("Please enter the Code.");
          frm.code.focus();
          return false;
        }  

        if(frm.title.value.length == 0)
        {
          alert("Please enter the title.");
          frm.item.focus();
          return false;
        }            

      }      

      function DoCheckUPC(frm)
      {        
        //alert(frm.value);    
        $.ajax({                  
                url: "books_check_upc.php",
                data: { 'f_upc':frm.value },
                type: "GET",
                async: false,
                success: function(data) 
                {                
                  if(data == "unique") 
                  {                                                        
                    //alert('success');                                                   
                  }                             
                  else
                  {
                    alert('The Code already exists.');
                    frm.value = "";                    
                    //alert(data);
                    location.reload();                                                
                  }
                } // function(data)
        }); // end of aja        
      }   

     

     
    </script>

  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">
      
      <!-- INCLUDE FILE '../../include/header.tpl' -->
      
      <!-- INCLUDE FILE '../../include/left_menu.tpl' -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
           Inventory Product
            <small>New</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="../main/main.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="invt_p.php">Product List</a></li>
            <li class="active">New Product</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">          
          <div class="row">
            <div class="col-xs-12">
            <div class="box box-primary">
                
                <!-- form start -->
                <form role="form" name="formp" method="post" action="books_new_submit.php" onsubmit="return CheckSubmit(this)">
                <input type="hidden" name="f_page" value="{{T_F_PAGE}}">
                  <div class="box-body">  

                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>CODE <font color="red">*</font></label>
                          <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-credit-card"></i>
                          </div>    
                          <input type="text" name="code" class="form-control" id="code" placeholder="Enter the Code" value="{{T_UPC}}" onchange="DoCheckUPC(this)">
                          </div>
                        </div>  
                      </div><!-- /.col -->
                      <div class="col-md-4">
                        <div class="form-group">    
                          <label>TITLE <font color="red">*</font></label>
                          <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-bars"></i>
                          </div>    
                           <input type="text" name="title" class="form-control" id="title" placeholder="Enter the Title" value="{{T_TITLE}}">
                          </div>                          
                        </div>                                  
                      </div><!-- /.col -->   
                      <div class="col-md-4">
                        <div class="form-group">    
                          <label>AUTHOR </label>
                          <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-bars"></i>
                          </div>    
                           <input type="text" name="author" class="form-control" id="author" placeholder="Enter the Name of Author" value="{{T_AUTHOR}}">
                          </div>                          
                        </div>                                  
                      </div><!-- /.col -->   
                    </div><!-- /.row -->                                                          

                     <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>CATEGORY </label>
                          <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-book"></i>
                          </div>    
                          <select class="form-control" name="s_cate">
                          {{T_SELECT_CATE}}
                          </select> 
                          </div>
                        </div>  
                      </div><!-- /.col -->
                      <div class="col-md-4">
                        <div class="form-group">    
                          <label>GENRE </label>
                          <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-bars"></i>
                          </div>    
                          <select class="form-control" name="s_genre">
                          {{T_SELECT_GENRE}}
                          </select> 
                          </div>                          
                        </div>                                  
                      </div><!-- /.col -->   

                      <div class="col-md-4">
                        <div class="form-group">    
                          <label>STATUS </label>
                          <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-bars"></i>
                          </div>    
                           <select class="form-control" name="s_status" id="s_status">
                            {{T_SELECT_STATUS}}
                          </select>     
                          </div>                       
                        </div>                                  
                      </div><!-- /.col -->   
                    </div><!-- /.row -->      

                     <div class="row">   
                      <div class="col-md-8">
                        <div class="form-group">    
                          <label>DESCRIPTION </label>
                          <div class="input-group">
                          <div class="input-group-addon">
                            <i class="fa fa-pencil-square-o"></i>
                          </div>    
                          <input type="text" name="descr" class="form-control" id="descr" placeholder="Enter the Description" value="{{T_DESCR}}">
                          </div>                          
                        </div>                                  
                      </div><!-- /.col -->   
                 
                    </div><!-- /.row --> 
                                   
                  </div><!-- /.box-body -->

                  <div class="box-footer" align="center">
                    <button type="submit" class="btn btn-primary">Save</button>&nbsp;
                    <a href="books.php">
                      <button type="button" class="btn btn-primary">Cancel</button>
                    </a>
                  
                  </div>
                </form>
              </div><!-- /.box -->
             </div> 
              
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      

      <!-- INCLUDE FILE '../../include/footer.tpl' -->
      
      
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="../../plugins/morris/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="../../plugins/sparkline/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="../../plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="../../plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="../../plugins/knob/jquery.knob.js"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="../../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="../../plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="../../dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
  </body>
</html>

