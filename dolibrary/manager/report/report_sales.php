<?


    session_start();

    $DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'] . "/dolibrary";

    include("$DOCUMENT_ROOT/include/SESSION.php3");
    include("$DOCUMENT_ROOT/include/auth_M_repo.php3");
    include("$DOCUMENT_ROOT/include/dbconn.php3");
    include("$DOCUMENT_ROOT/include/page_admin.php3");
    include("$DOCUMENT_ROOT/include/func_return.php3");
    include("$DOCUMENT_ROOT/include/class.BearTemplate.php");

    db_init();    
    
    $loop = array();
    

    $s_dept_id              = $_GET['s_dept'];   
    $s_cust_id              = $_GET['s_cust'];  
    $s_pay_status           = $_GET['s_pay_status'];   
    $p_daterange            = $_GET['p_daterange'];
    $p_datetype             = $_GET['p_datetype'];

    $q_where                = "WHERE S.STATUS='1' ";
    $q_group                = "";

    // PDS Test
    /*echo("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> \n" .
                        "<script language=\"javascript\">\n" .
              "<!--\n" .
       "alert(\"PDS test: $p_daterange : $p_datetype\");\n" .       
         "//-->\n" .
         "</script>\n");      */
    
    //
    // Select Department  
    if($s_dept_id != "-1" && $s_dept_id != "")    
    {                
        $q_where = $q_where . " AND S.DEPT_ID = '$s_dept_id' ";        
    }


    //
    // Select Customer
    if($s_cust_id != "-1" && $s_cust_id != "")    
    {                
        $q_where = $q_where . " AND S.CUSTOMER_ID = '$s_cust_id' ";        
    }


    //
    // Select Payment Status
    if($s_pay_status != "-1" && $s_pay_status != "")    
    {                
        $q_where = $q_where . " AND S.PAY_STATUS = '$s_pay_status' ";        
    }


    //
    // Select date range
    if($p_daterange == "")
    {
        // default date range (this month)
        $daterange = date("Y-m"); //date("Y-m-d");
        $q_where = $q_where . " AND S.ORDER_DATE >= " . "'" . $daterange . "-01'".
                   " AND S.ORDER_DATE <= " . "'" . date("Y-m-t") . "'" ;      
        $daterange = date("Y-M");  

        // to maintain date range value and apply with other select items
        $daterange_hid = date("Y-m")."-01"."~".date("Y-m-t"); 

        // Set Date range picker button display
        $date_picker = "This Month";  
        $p_datetype  = "This Month";    
    }
    else
    {
        $range = explode("~",$p_daterange);
        if($range[0] == $range[1])
            $daterange = $range[0];
        else       
            $daterange = $range[0] . ' ~ ' . $range[1];
    
        // YYYY/mm/dd
        $start = explode("-",$range[0]);  
        $end   = explode("-",$range[1]);   

        $q_where = $q_where . " AND S.ORDER_DATE >= " . "'" . $range[0] . "'" . 
                   " AND S.ORDER_DATE <= " . "'" . $range[1] . "'" ;      

        // to maintain date range value and apply with other select items
        $daterange_hid = $range[0] . '~' . $range[1];
        
        // Set Date range picker button display
        $date_picker = $p_datetype;           
    }

       
    // IF. Rows <= 31
    //   => labels = day
    //   => group by = GROUP BY ORDER_DATE    
    // IF. Rows > 31
    //   => labels = month
    //   => group by = GROUP BY year(ORDER_DATE), month(ORDER_DATE)   
    // $start[0]: Year, $start[1]: Month, $start[2]: Day
        
    $data   = "";
    $labels = "";   

    // grand total 
    $g_subtotal     = "";
    $g_gst          = "";
    $g_pst          = "";
    $g_totalWithTax = "";
    

    // Daily labels
    $date_unit = "(Day)";
    $query = "SELECT sum(S.TOTAL_PRICE) AS SALES, S.ORDER_DATE
              FROM tbl_sales AS S
              INNER JOIN tbl_sales_detail AS SD ON S.
              $q_where
              GROUP BY S.ORDER_DATE
              ORDER BY S.ORDER_DATE";
              
    $result = mysqli_query($g_db_conn, $query);
    $row_num = mysqli_num_rows($result);

    if($row_num > 0 && $row_num <= 31) { // Daily labels    
            
        $i = 0;
        while($row = mysqli_fetch_array($result)) {

            $d_total_price      = $row['SALES'];
            $d_date             = $row['ORDER_DATE'];        
            $datef              = date_create($d_date);

            if($i==0)
            {
                $data = round($d_total_price,2);  
                if($start[1] == $end[1])                      
                    $labels = "'".date_format($datef, "d")."'";                    
                else
                    $labels = "'".date_format($datef, "M-d")."'";
            }
            else
            {
                $data = $data . ',' .  round($d_total_price,2);                                    
                if($start[1] == $end[1]) // compare month                  
                    $labels = $labels . ',' ."'".date_format($datef, "d")."'";                    
                else
                    $labels = $labels . ',' ."'".date_format($datef, "M-d")."'";                    
            }  

            $gst = $d_total_price * 0.05;
            $pst = $d_total_price * 0.07;
            $totalWithTax = $d_total_price + $gst + $pst;

            // grand total                 
            $g_subtotal         += round($d_total_price,2);
            $g_gst              += round($gst,2);
            $g_pst              += round($pst,2);
            $g_totalWithTax     += round($totalWithTax,2);

            $loop[$i] = array('T_ORDER_DATE' => $d_date,                     
                              'T_SUBTOTAL'=> number_format($d_total_price,2), 
                              'T_GST'=> number_format($gst,2), 
                              'T_PST' => number_format($pst,2), 
                              'T_TOTAL' => number_format($totalWithTax,2));
            $i = $i + 1;
        }
        mysqli_free_result($result);
    }
    else if( $row_num > 31) { // Monthly labels  
        mysqli_free_result($result);

        // Monthly labels
        $date_unit = "(Month)";
        $query = "SELECT sum(S.TOTAL_PRICE) AS SALES, S.ORDER_DATE
                   FROM tbl_sales AS S
                   $q_where
                   GROUP BY year(S.ORDER_DATE), month(S.ORDER_DATE)
                   ORDER BY S.ORDER_DATE";
                  
        $result = mysqli_query($g_db_conn, $query);
        $row_num = mysqli_num_rows($result);

        if($row_num > 0) {        
                
            $i = 0;
            while($row = mysqli_fetch_array($result)) {

                $d_total_price      = $row['SALES'];
                $d_date             = $row['ORDER_DATE'];        
                $datef              = date_create($d_date);

                if($i==0)
                {
                    $data = round($d_total_price,2);    
                    $labels = "'".date_format($datef, "Y-M")."'";                    
                }
                else
                {
                    $data = $data . ',' .  round($d_total_price,2);
                    $labels = $labels . ',' ."'". date_format($datef, "Y-M")."'";
                }    

                $gst = $d_total_price * 0.05;
                $pst = $d_total_price * 0.07;
                $totalWithTax = $d_total_price + $gst + $pst;

                // grand total
                $g_subtotal         += round($d_total_price,2);
                $g_gst              += round($gst,2);
                $g_pst              += round($pst,2);
                $g_totalWithTax     += round($totalWithTax,2);

                $loop[$i] = array('T_ORDER_DATE' => date_format($datef, "Y-M"),                     
                                  'T_SUBTOTAL'=> number_format($d_total_price,2), 
                                  'T_GST'=> number_format($gst,2), 
                                  'T_PST' => number_format($pst,2), 
                                  'T_TOTAL' => number_format($totalWithTax,2));          
                $i = $i + 1;
            }
            mysqli_free_result($result);
        } 
    }

    $query_test = $query;


    // tax 
   
    // select Department
    $query = "select * from tbl_department";    
    $result = mysqli_query($g_db_conn, $query);
    $row_num = mysqli_num_rows($result);
    if($row_num > 0) 
    {                             
        $select_dept .= "<option value='-1' selected>" . "All" . "</option>\n";        
        while($row = mysqli_fetch_array($result)) 
        {                            
            if($s_dept_id == $row['DEPT_ID'])                
                $select_dept .= "<option value='" . $row['DEPT_ID'] . "' selected>" . $row['NAME'] . "</option>\n";
            else
                $select_dept .= "<option value='" . $row['DEPT_ID'] . "'>" . $row['NAME'] . "</option>\n";
        }
        mysqli_free_result($result);
    }


    // select Customer
    $query = "select * from tbl_customer";    
    $result = mysqli_query($g_db_conn, $query);
    $row_num = mysqli_num_rows($result);
    if($row_num > 0) 
    {                             
        $select_cust .= "<option value='-1' selected>" . "All" . "</option>\n";        
        while($row = mysqli_fetch_array($result)) 
        {                            
            if($s_cust_id == $row['ID'])                
                $select_cust .= "<option value='" . $row['ID'] . "' selected>" . $row['NAME'] . "</option>\n";
            else
                $select_cust .= "<option value='" . $row['ID'] . "'>" . $row['NAME'] . "</option>\n";
        }
        mysqli_free_result($result);
    }
   

    $tpl = new BearTemplate();
    $tpl->setFile("main", "tpl/report_sales.tpl");    
    
    // Select
    $tpl->setVar("T_SELECT_DEPT",$select_dept);  
    $tpl->setVar("T_SELECT_CUST",$select_cust);  
    $tpl->setVar("T_SELECT_PAY_STATUS",ARRAY_ARRAY_RETURN($Array_pay_status,"0",$s_pay_status));    

    // Date range picker
    $tpl->setVar("T_DATERANGE",$daterange);    
    $tpl->setVar("T_DATERANGE_HID",$daterange_hid);    
    $tpl->setVar("T_DATE_PICKER",$date_picker);        

    // Chart
    //$tpl->setVar("T_LABELS","'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'");
    $tpl->setVar("T_LABELS", $labels);
    $tpl->setVar("T_DATA",$data);
    $tpl->setVar("T_DATE_UNIT",$date_unit);    
    
    // Table
    $tpl->setLoop("LP", $loop);
    $tpl->setVar("T_G_SUBTOTAL",number_format($g_subtotal,2));
    $tpl->setVar("T_G_GST",number_format($g_gst,2));
    $tpl->setVar("T_G_PST",number_format($g_pst,2));
    $tpl->setVar("T_G_TOTAL",number_format($g_totalWithTax,2));
    $tpl->setVar("T_TAX_GST", $G_TAX_GST);
    $tpl->setVar("T_TAX_PST", $G_TAX_PST);

    // Test
    //$tpl->setVar("T_QUERY",$query_test);
    
    include("$DOCUMENT_ROOT/include/COMMON.php");
    $tpl->tprint("main");
    db_close();

?>