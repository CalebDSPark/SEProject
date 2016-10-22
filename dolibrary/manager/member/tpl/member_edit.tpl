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

    <script language="JavaScript">
     
      function GO_DELETE(id) {         
        var yn = confirm('Are you sure you want to delete ?');            
        if(yn) location.href='member_delete_submit.php?p_id='+ id;         
     }

      function CheckSubmit(frm)
      {        
        /*if(frm.id.value.length == 0)
        {
          alert("Please enter the ID.");
          frm.id.focus();
          return false;
        }*/
        if(frm.pw.value.length == 0)
        {
          alert("Please enter the password.");
          frm.pw.focus();
          return false;
        }
        if(frm.fname.value.length == 0)
        {
          alert("Please enter the first name.");
          frm.fname.focus();
          return false;
        }
        if(frm.lname.value.length == 0)
        {
          alert("Please enter the last name.");
          frm.lname.focus();
          return false;
        }                       
      }      

      function ClickRadio(frm)
      { 
        //alert(frm.id);  //rdoAdmin, rdoEmployee, rdoManager
         if(frm.id == "rdoStudent")
        {        
          for(var i=0; i<document.formp.chkLevel.length; i++)                
            document.formp.chkLevel[i].disabled = true;
        }
        else if(frm.id == "rdoStaff")
        {
          //alert(frm.id);
          for(var i=0; i<document.formp.chkLevel.length; i++)                
            document.formp.chkLevel[i].disabled = true;
        }     
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
            User
            <small>Edit</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="../main/main.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="member.php">User List</a></li>
            <li class="active">User Eidt</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
            <div class="box box-primary">

                <!-- form start -->
                <form role="form" name="formp" method="post" action="member_edit_submit.php" onsubmit="return CheckSubmit(this)">                
                  <div class="box-body">

                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>ID <font color="red">*</font></label>
                          <!--div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-sitemap"></i>
                            </div-->
                            <input type="text" name="id" class="form-control" id="id" placeholder="Enter ID" value="{{T_ID}}" readonly> 
                          <!--/div--><!-- /.input group -->
                        </div><!-- /.form group --> 
                      </div><!-- /.col -->  
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>PW <font color="red">*</font></label>
                          <!--div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-th-list"></i>
                            </div-->
                            <input type="text" name="pw" class="form-control" id="pw" placeholder="Enter Password" value="{{T_PW}}"> 
                          <!--/div--><!-- /.input group -->
                        </div><!-- /.form group --> 
                      </div><!-- /.col --> 
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>FIRST NAME <font color="red">*</font></label>
                          <input type="text" name="fname" class="form-control" id="fname" placeholder="Enter First Name" value="{{T_FNAME}}">
                        </div>  
                      </div><!-- /.col -->
                      <div class="col-md-3">
                        <div class="form-group">    
                          <label>LAST NAME <font color="red">*</font></label>
                          <input type="text" name="lname" class="form-control" id="lname" placeholder="Enter Last Name" value="{{T_LNAME}}">
                        </div>                                  
                      </div><!-- /.col -->                                            
                    </div><!-- /.row -->                    

                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>STUDENT ID <font color="green">*</font></label>
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-credit-card"></i>
                            </div>                            
                            <input type="text" name="sid" class="form-control" id="sid"  placeholder="Enter Student ID" value="{{T_SID}}"> 
                          </div><!-- /.input group -->
                        </div><!-- /.form group --> 
                      </div><!-- /.col -->            
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Employee ID</label>
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-bars"></i>
                            </div>                            
                            <input type="text" name="emp_id" class="form-control" id="emp_id"  placeholder="Enter Employee ID" value="{{T_EMP_ID}}"> 
                          </div><!-- /.input group -->
                        </div><!-- /.form group --> 
                      </div><!-- /.col -->                                 
                      <div class="col-md-6">
                        <div class="form-group">    
                          <label>EMAIL </label>                          
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-at"></i>
                            </div>                            
                            <input type="text" name="email" class="form-control" id="email"  placeholder="Enter Email" value="{{T_EMAIL}}"> 
                          </div><!-- /.input group --> 
                        </div>                                  
                      </div><!-- /.col -->                        
                    </div><!-- /.row -->

                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">    
                          <label>PHONE (ex> 111-222-3333)</label>                       
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-phone"></i>
                            </div>                            
                            <input type="text" name="phone" class="form-control" id="phone"  placeholder="Enter Phone Number" value="{{T_PHONE}}"> 
                          </div><!-- /.input group --> 
                        </div>                                  
                      </div><!-- /.col -->                                                                                        
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>GENDER <font color="green">*</font></label>
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-user"></i>
                            </div>
                            <select class="form-control" name="s_gender" id="s_gender">
                              {{T_SELECT_GENDER}}
                            </select> 
                          </div><!-- /.input group -->
                        </div><!-- /.form group --> 
                      </div><!-- /.col -->
                      <div class="col-md-6">
                        <div class="form-group">    
                          <label>ADDRESS</label>                          
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-building-o"></i>
                            </div>                            
                            <input type="text" name="address" class="form-control" id="address" placeholder="Enter Address" value="{{T_ADDRESS}}">  
                          </div><!-- /.input group --> 
                        </div>   
                      </div><!-- /.col -->  
                    </div><!-- /.row -->                         
          
                    <div class="row">  
                      <div class="col-md-3">
                        <div class="form-group">    
                          <label>BIRTHDAY </label>
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="birthday" name="birthday" value="{{T_BIRTHDAY}}"> 
                          </div><!-- /.input group -->
                        </div>                                  
                      </div><!-- /.col -->                       
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>STATUS</label>
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-user"></i>
                            </div>
                            <select class="form-control" name="s_status" id="s_status">
                              {{T_SELECT_STATUS}}
                            </select> 
                          </div><!-- /.input group -->
                        </div><!-- /.form group --> 
                      </div><!-- /.col -->     
                      <div class="col-md-6">
                        <div class="form-group">
                          <label>MEMO</label>
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-pencil-square-o"></i>
                            </div>                            
                            <input type="text" name="memo" class="form-control" id="memo"  placeholder="Enter Memo" value="{{T_MEMO}}"> 
                          </div><!-- /.input group -->
                        </div><!-- /.form group --> 
                      </div><!-- /.col -->      
                    </div><!-- /.row -->  


                    <!-- history -->  
                    </br><div class="box box-gray">
                      <label><i class="fa fa-circle-o"></i> Staff Information</label>
                    </br></br>

                    <div class="row">
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>DEPARTMENT <font color="green">*</font></label>
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-sitemap"></i>
                            </div>                           
                            <input type="text" name="s_dept" class="form-control" id="s_dept"  placeholder="Enter Department" value="{{T_DEPT}}" > 
                          </div><!-- /.input group -->
                        </div><!-- /.form group --> 
                      </div><!-- /.col -->  
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>JOB TITLE <font color="green">*</font></label>
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-th-list"></i>
                            </div>                            
                            <input type="text" name="s_jobtitle" class="form-control" id="s_jobtitle"  placeholder="Enter Job Title" value="{{T_JOBTITLE}}" > 
                          </div><!-- /.input group -->
                        </div><!-- /.form group --> 
                      </div><!-- /.col -->                          
                    </div><!-- /.row -->   
                    </div><!-- /.box-gray --> 
                
                  </div><!-- /.box-body -->

<!-- access level strart -->
                <div class="col-xs-12">
                  <div class="box box-gray">

                    <div class="box-body">
                       <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label>ACCESS LEVEL <font color="red">*</font></label>
                            
                            <!-- radio -->
                            <div class="form-group">
                               <div class="radio">
                                <label>
                                  <input type="radio" name="radioLevel" id="rdoStudent" value="student" onClick="ClickRadio(this);" {{T_RDO_STUDENT}}><strong>Student</strong> 
                                </label>
                              </div>
                              <div class="radio">
                                <label>
                                  <input type="radio" name="radioLevel" id="rdoStaff" value="staff" onClick="ClickRadio(this);" {{T_RDO_STAFF}}><strong>Staff</strong> &nbsp;&nbsp;(All authority)
                                </label>
                              </div>
                            </div>
                            

                          </div><!-- /.form group --> 
                        </div><!-- /.col -->                        
                      </div><!-- /.row -->   
                    </div>

                  </div>     
                </div>
<!-- access level end -->

                  <div class="box-footer" align="center">
                    <button type="submit" class="btn btn-primary">Save</button>&nbsp;
                    <a href="member.php">
                      <button type="button" class="btn btn-primary">Cancel</button>&nbsp;
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


      //Date picker
      $('#birthday').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'         
      });

      //Date range picker
      /*$('#reservation').daterangepicker( {                    
          format: 'YYYY-MM-DD'         
        }
      );

      //Date picker
      $('#join_date').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'         
      });

      //Date picker
      $('#leave_date').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd'         
      });*/
       
    </script>


  </body>
</html>

