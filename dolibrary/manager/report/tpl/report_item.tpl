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
    <!-- daterange picker -->
    <link rel="stylesheet" href="../../plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="../../plugins/iCheck/all.css">    
    <!-- Bootstrap Color Picker -->
    <link rel="stylesheet" href="../../plugins/colorpicker/bootstrap-colorpicker.min.css">
    <!-- Bootstrap time Picker -->
    <link rel="stylesheet" href="../../plugins/timepicker/bootstrap-timepicker.min.css">   
    <!-- Select2 -->
    <link rel="stylesheet" href="../../plugins/select2/select2.min.css">
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

     <!-- Bootstrap -->
    <link href="../../dist2/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">       
    <!-- Datatables -->
    <link href="../../dist2/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">    


    <script type="text/javascript">
      function DoSelect(frm)
      {                        
        var cate        = $("#s_cate option:selected").val();    
        var genre       = $("#s_genre option:selected").val();            
        var daterange   = $("#daterange_hid").val();
        var type        = $("#date_picker_hid").val();
        //alert(type);        

        location.href='report_item.php?s_genre='+genre+'&s_cate='+cate+
                      '&p_daterange='+ daterange + '&p_datetype=' + type;
      }

      function SetDateRange(daterange, type)
      {
          //alert(daterange);
          var cate        = $("#s_cate option:selected").val();    
          var genre       = $("#s_genre option:selected").val();            
          
          location.href='report_item.php?s_genre='+genre+'&s_cate='+cate+
                        '&p_daterange='+ daterange + '&p_datetype=' + type;
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
            Borrow Items
            <small>Report</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="../main/main.php"><i class="fa fa-dashboard"></i> Home</a></li>     <li class="active">Borrow Book Report</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <div class="row">
            <div class="col-xs-12">              
            <div class="box box-primary">

                <!-- form start -->
                <!--form role="form" name="formp" method="get" action="report_sales_item.php"-->
                  <div class="box-body">  
                    <!--div class="form-group">
                      <label >Purchase Order Number</label>
                      <input type="text" name="s_poid" class="form-control" id="s_poid" placeholder="Enter Puchase Order Number">
                    </div-->  

                    <div class="row">    
                      <div class="col-md-4">                      
                        <div class="form-group">
                          <label>Category</label>
                          <div class="input-group">
                            <div class="input-group-addon">
                              <i class="fa fa-database"></i>
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
                              <i class="fa fa-sitemap"></i>
                            </div>
                            <!--input type="text" class="form-control pull-right" id="invt_status" name="invt_status" value="{{T_INVT_STATUS}}"-->
                            <select class="form-control" name="s_genre" id="s_genre" onchange="DoSelect(this)">
                              {{T_SELECT_GENRE}}
                            </select>
                          </div><!-- /.input group -->
                        </div><!-- /.form group -->  
                      </div><!-- /.col -->                       
                      <div class="col-md-4">                      
                        <div class="form-group">
                          <label>Date range:</label>
                          <div class="input-group">                            
                            <button class="btn btn-default pull-right" id="daterange-btn"  style="width:200px;">
                              <i class="fa fa-calendar"></i>  
                              <!--span id="date_picker" name="date_picker">Date range picker</sapn--> 
                              &nbsp {{T_DATE_PICKER}} &nbsp
                              <i class="fa fa-caret-down"></i>
                            </button>
                            <input type="hidden" id="daterange_hid" name="daterange_hid" value='{{T_DATERANGE_HID}}'>
                            <input type="hidden" id="date_picker_hid" name="date_picker_hid" value='{{T_DATE_PICKER}}'>
                          </div><!-- /.input group -->
                        </div><!-- /.form group -->  
                      </div><!-- /.col -->    

                    </div><!-- /.row -->  
                  </div><!-- /.box-body -->

                <!--/form-->
              </div><!-- /.box -->
             </div>
           
          </div><!-- /.row -->  


         
          <div class="row">
            <div class="col-md-12">
              <!--div class="box-header with-border" align="right">              
                <button type="button" class="btn-xs btn-primary">Label1</button>
                <button type="button" class="btn-xs btn-success">Label2</button>                   
                <button type="button" class="btn-xs btn-info">Label2</button>                   
              </div-->
            </div>
            <!--div class="col-md-12">
              <div class="box-header with-border">
              </div>
            </div-->  
          

            <div class="col-md-12">

              <div class="box-header">
                <h3 class="box-title" ><i class="fa fa-bar-chart"></i> Date: {{T_DATERANGE}}  {{T_QUERY}}</h3>
              </div><!-- /.box-header -->

              <!-- Bar CHART -->
              <div class="box box-success">
                <div class="box-header with-border">

                  <h3 class="box-title">Qty</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>                 
                  </div>                  

                </div>
                <div class="box-body">
                  <div class="chart">
                    <canvas id="barChart" style="height:250px"></canvas>
                    <h4 class="box-title" align="right"><i class="ion ion-bag"></i> {{T_DATE_UNIT}}</h>
                  </div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

              <!-- DONUT CHART -->
              <!--div class="box box-danger">               
              </div--><!-- /.box -->

            </div><!-- /.col (LEFT) -->


            <div class="col-md-12">
              <!-- LINE CHART -->
              <div class="box box-info">
                <!--div class="box-header with-border">
                  <h3 class="box-title">Sales($)</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div class="chart">
                    <canvas id="lineChart" style="height:250px"></canvas>
                  </div>
                </div--><!-- /.box-body -->


                <div class="box-header">
                  <h3 class="box-title"><i class="fa fa-table"></i> Date: {{T_DATERANGE}}</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <table id="datatable_btn" class="table table-bordered table-striped">
                    <thead>
                      <tr>                      
                      <th>TITLE</th>                                           
                      <th>Borrowed Count</th>
                      <th>Author</th>
                      <th>Category</th>                      
                      <th>Genre</th>
                      <th>Code</th>
                      </tr>
                    </thead>
                    <tbody>
<!-- LOOP START 'LP' -->
                      <tr>                                            
                      <td>{{LP.T_TITLE}}</td>                                    
                      <td>{{LP.T_QTY}}</td>                      
                      <td>{{LP.T_AUTHOR}}</td>                      
                      <td>{{LP.T_CATE}}</td>                      
                      <td>{{LP.T_GENRE}}</td>                      
                      <td>{{LP.T_CODE}}</td>                      
                      </tr>
<!-- LOOP END 'LP' -->                      
                    
                    </tbody>
                  </table>                    
                </div><!-- /.box-body -->

              </div><!-- /.box -->


              <!-- BAR CHART -->
              <!--div class="box box-success">               
              </div--><!-- /.box -->

            </div><!-- /.col (RIGHT) -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->


      <!-- INCLUDE FILE '../../include/footer.tpl' -->


    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="../../plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="../../bootstrap/js/bootstrap.min.js"></script>
    <!-- ChartJS 1.0.1 -->
    <script src="../../plugins/chartjs/Chart.min.js"></script>
    <!-- Select2 -->
    <script src="../../plugins/select2/select2.full.min.js"></script>
    <!-- InputMask -->
    <script src="../../plugins/input-mask/jquery.inputmask.js"></script>
    <script src="../../plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="../../plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- date-range-picker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="../../plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bootstrap color picker -->
    <script src="../../plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
    <!-- bootstrap time picker -->
    <script src="../../plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="../../plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!-- iCheck 1.0.1 -->
    <script src="../../plugins/iCheck/icheck.min.js"></script>
    <!-- FastClick -->
    <script src="../../plugins/fastclick/fastclick.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../dist/js/app.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../dist/js/demo.js"></script>
    <!-- DataTables -->
    <script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../plugins/datatables/dataTables.bootstrap.min.js"></script>

    <!-- Page script -->
    <script>
      $(function () {

        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */

        //-----------------
        //- Common Data -
        //-----------------           
          var areaChartData = {
          //labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],          
          labels: [{{T_LABELS}}],
          datasets: [
             {
              label: "Hana Foods",
              fillColor: "rgba(60,141,188,0.9)",
              strokeColor: "rgba(60,141,188,0.8)",
              pointColor: "#3b8bba",
              pointStrokeColor: "rgba(60,141,188,1)",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(60,141,188,1)",              
              //data: [280, 1048, 200, 19, 86, 270, 10]
              data: [{{T_DATA}}]
            }
            /*,
            {
              label: "Electronics",
              fillColor: "rgba(210, 214, 222, 1)",
              strokeColor: "rgba(210, 214, 222, 1)",
              pointColor: "rgba(210, 214, 222, 1)",
              pointStrokeColor: "#c1c7d1",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(220,220,220,1)",
              data: [28, 48, 40, 19, 86, 27, 90]
              //{{T_DATA}}
            }*/
           
          ]
          };

        //-------------
        //- BAR CHART -
        //-------------
        var barChartCanvas = $("#barChart").get(0).getContext("2d");
        var barChart = new Chart(barChartCanvas);
        var barChartData = areaChartData;

        var barColor = "#00a65a" // green
        //var barColor = "#f56954" // red
        //var barColor = "#00c0ef" // light blue
        //var barColor = "#3c8dbc" // dark blue

        barChartData.datasets[0].fillColor = barColor;
        barChartData.datasets[0].strokeColor = barColor;
        barChartData.datasets[0].pointColor = barColor;

        var barChartOptions = {
          //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
          scaleBeginAtZero: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: true,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 2,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - If there is a stroke on each bar
          barShowStroke: true,
          //Number - Pixel width of the bar stroke
          barStrokeWidth: 2,
          //Number - Spacing between each of the X value sets
          barValueSpacing: 5,
          //Number - Spacing between data sets within X values
          barDatasetSpacing: 1,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to make the chart responsive
          responsive: true,
          maintainAspectRatio: true,          
        };

        barChartOptions.datasetFill = false;
        barChart.Bar(barChartData, barChartOptions);
      

        //-------------
        //- LINE CHART -
        //--------------
        /*var lineChartCanvas = $("#lineChart").get(0).getContext("2d");
        var lineChart = new Chart(lineChartCanvas);
        
        var lineChartOptions = {
          //Boolean - If we should show the scale at all
          showScale: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: true,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 2,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - Whether the line is curved between points
          bezierCurve: true,
          //Number - Tension of the bezier curve between points
          bezierCurveTension: 0.3,
          //Boolean - Whether to show a dot for each point
          pointDot: false,
          //Number - Radius of each point dot in pixels
          pointDotRadius: 4,
          //Number - Pixel width of point dot stroke
          pointDotStrokeWidth: 1,
          //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
          pointHitDetectionRadius: 20,
          //Boolean - Whether to show a stroke for datasets
          datasetStroke: true,
          //Number - Pixel width of dataset stroke
          datasetStrokeWidth: 2,
          //Boolean - Whether to fill the dataset with a color
          datasetFill: true,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
          maintainAspectRatio: true,
          //Boolean - whether to make the chart responsive to window resizing
          responsive: true
        };

        lineChartOptions.datasetFill = false;
        lineChart.Line(areaChartData, lineChartOptions);*/
       
      });


      //-----------------
      // Date Range
      //----------------- 
      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();

        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'}
          );
        //Date range as a button
        $('#daterange-btn').daterangepicker(
            {
              ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                //'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                //'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Week': [moment().startOf('week'), moment().endOf('week')],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                'Last 3 Months': [moment().subtract(3, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
              },
              startDate: moment().subtract(29, 'days'),
              endDate: moment()
            },
        function (start, end, type) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
          //window.alert("You chose: " + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
          //alert(type);
          SetDateRange(start.format('YYYY-MM-DD')+ '~' + end.format('YYYY-MM-DD'), type);
        }
        );

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });

        //Colorpicker
        $(".my-colorpicker1").colorpicker();
        //color picker with addon
        $(".my-colorpicker2").colorpicker();

        //Timepicker
        $(".timepicker").timepicker({
          showInputs: false
        });
      });    


      //-----------------
      // Total Table
      //----------------- 
      $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
          "paging": false,
          "lengthChange": false,
          "searching": false,
          "ordering": false,
          "info": false,
          "autoWidth": true,
          "order": [[0,'desc']]
        });
      });
    </script>


     <!-- Datatable (export button) -->  
    <script src="../../dist2/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../dist2/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../../dist2/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../../dist2/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../../dist2/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../../dist2/jszip/dist/jszip.min.js"></script>    

    <script>
      // lBfrtip
      $(document).ready(function() {
        var handleDataTableButtons = function() {
          if ($("#datatable_btn").length) {
            $("#datatable_btn").DataTable({
               //"lengthMenu": [ 10, 25, 50, 75, 100 ],  
                 //"lengthMenu": [ 10, 25, 50, 75, 100 ],   
               "ordering": false,    
               "paging": false,             
               dom: "Brtp",
               buttons: [                         
                {
                  extend: "csv",
                  className: "btn-sm",
                  title: 'report_dolibrary'
                },
                {
                  extend: "excel",
                  className: "btn-sm btn-success",
                  title: 'report_dolibrary'
                },            
                {
                  extend: "print",
                  className: "btn-sm"
                },             
              ],              

              responsive: true
            });
          }
        };
        TableManageButtons = function() {
          "use strict";
          return {
            init: function() {
              handleDataTableButtons();
            }
          };
        }();      
        TableManageButtons.init();
      });
    </script>    

  </body>
</html>
