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
    
    $s_cate_id              = $_GET['s_cate'];  
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
         "</script>\n"); */

    //
    // Select Category
    if($s_cate_id != "-1" && $s_cate_id != "")    
    {                
        $q_where = $q_where . " AND CATE_ID = '$s_cate_id' ";        
    }
    

    //
    // Select Department  
    if($s_dept_id != "-1" && $s_dept_id != "")    
    {                
        $q_where = $q_where . " AND DEPT_ID = '$s_dept_id' ";        
    }


    //
    // Select Customer
    if($s_cust_id != "-1" && $s_cust_id != "")    
    {                
        $q_where = $q_where . " AND CUSTOMER_ID = '$s_cust_id' ";        
    }


    //
    // Select Payment Status
    if($s_pay_status != "-1" && $s_pay_status != "")    
    {                
        $q_where = $q_where . " AND PAY_STATUS = '$s_pay_status' ";        
    }


    //
    // Select date range
    if($p_daterange == "")
    {
        // default date range (this month)
        $daterange = date("Y-m"); //date("Y-m-d");
        $q_where = $q_where . " AND ORDER_DATE >= " . "'" . $daterange . "-01'".
                   " AND ORDER_DATE <= " . "'" . date("Y-m-t") . "'" ;      
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

        $q_where = $q_where . " AND ORDER_DATE >= " . "'" . $range[0] . "'" . 
                   " AND ORDER_DATE <= " . "'" . $range[1] . "'" ;      

        // to maintain date range value and apply with other select items
        $daterange_hid = $range[0] . '~' . $range[1];
        
        // Set Date range picker button display
        $date_picker = $p_datetype;           
    }

       
        
    $data   = "";
    $labels = "";   

    // grand total 
    $g_subtotal     = "";
    $g_gst          = "";
    $g_pst          = "";
    $g_totalWithTax = "";
    

    // item labels
    $date_unit = "(Item)";
    $query = "SELECT sum(SD.QTY) AS ITEM_QTY, I.*, U.NAME AS UNAME
               FROM tbl_sales AS S, tbl_sales_detail AS SD, tbl_inventory_product as I 
               Left Join tbl_inventory_unit AS U ON I.UNIT_ID = U.UNIT_ID       
               $q_where AND S.SO_ID = SD.SO_ID AND SD.INVT_ID = I.INVT_ID
               GROUP BY SD.INVT_ID
               ORDER BY SD.INVT_ID";
              
    $result = mysqli_query($g_db_conn, $query);
    $row_num = mysqli_num_rows($result);

    if($row_num > 0) {        
            
        while($row = mysqli_fetch_array($result)) {
            
            $d_item             = $row['ITEM'];
            $d_item_qty         = $row['ITEM_QTY'];
            $d_unit             = $row['UNAME'];
            $d_volume           = $row['VOLUME'];
            $d_cost             = round($row['COST'],2);
            $d_price            = round($row['PRICE'],2);
            $d_total_price      = $d_item_qty * $d_price;
            $d_desc             = $row['DESCR'];
            
            if($i==0)
            {
                $data = $d_item_qty;                                       
                $labels = "'".$d_item."'";
            }
            else
            {
                $data = $data . ',' .  $d_item_qty;                                    
                $labels = $labels . ',' ."'". $d_item."'";                
            }  
     
            // grand total                 
            $g_qty           += $d_item_qty;
            $g_price         += $d_price;
            $g_total_price   += $d_total_price;        

            $loop[$i] = array('T_ITEM'  => $d_item, 'T_QTY'   => $d_item_qty, 
                              'T_UNIT'  => $d_unit, 'T_VOLUME' => $d_volume, 
                              'T_COST'  => number_format($d_cost,2), 
                              'T_PRICE' => number_format($d_price,2), 
                              'T_TOTAL' => number_format($d_total_price,2), 
                              'T_DESC'  => $d_desc);
            $i = $i + 1;
        }
        mysqli_free_result($result);
    }   

    $query_test = $query;
   

    // select Category
    $query = "select * from tbl_category";    
    $result = mysqli_query($g_db_conn, $query);
    $row_num = mysqli_num_rows($result);
    if($row_num > 0) 
    {                             
        $select_cate .= "<option value='-1' selected>" . "All" . "</option>\n";        
        while($row = mysqli_fetch_array($result)) 
        {                            
            if($s_cate_id == $row['CATE_ID'])                
                $select_cate .= "<option value='" . $row['CATE_ID'] . "' selected>" . $row['NAME'] . "</option>\n";
            else
                $select_cate .= "<option value='" . $row['CATE_ID'] . "'>" . $row['NAME'] . "</option>\n";
        }
        mysqli_free_result($result);
    }

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
    $tpl->setFile("main", "tpl/report_sales_item.tpl");    
    
    // Select
    $tpl->setVar("T_SELECT_CATE",$select_cate);  
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
    $tpl->setVar("T_G_QTY",number_format($g_qty,2));
    $tpl->setVar("T_G_PRICE",number_format($g_price,2));
    $tpl->setVar("T_G_TOTAL_PRICE",number_format($g_total_price,2));    

    // Test
    //$tpl->setVar("T_QUERY",$query_test);
    
    include("$DOCUMENT_ROOT/include/COMMON.php");
    $tpl->tprint("main");
    db_close();

?>