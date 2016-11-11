<?


    session_start();

    $DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'] . "/dolibrary";

    include("$DOCUMENT_ROOT/include/SESSION.php3");
    include("$DOCUMENT_ROOT/include/auth_staff.php3");
    include("$DOCUMENT_ROOT/include/dbconn.php3");    
    include("$DOCUMENT_ROOT/include/func_return.php3");
    include("$DOCUMENT_ROOT/include/class.BearTemplate.php");

    db_init();    
    
    $loop = array();
    
    $s_cate_id               = $_GET['s_cate'];  
    $s_genre_id              = $_GET['s_genre'];   
    
    $p_daterange            = $_GET['p_daterange'];
    $p_datetype             = $_GET['p_datetype'];

    $q_where                = "WHERE TRUE ";
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
        $q_where = $q_where . " AND BK.CATE = '$s_cate_id' ";        
    }
    

    //
    // Select Department  
    if($s_genre_id != "-1" && $s_genre_id != "")    
    {                
        $q_where = $q_where . " AND BK.GENRE = '$s_genre_id' ";        
    }


    //
    // Select date range
    if($p_daterange == "")
    {
        // default date range (this month)
        $daterange = date("Y-m"); //date("Y-m-d");
        $q_where = $q_where . " AND BD.REQ_DATE >= " . "'" . $daterange . "-01'".
                   " AND BD.REQ_DATE <= " . "'" . date("Y-m-t") . "'" ;      
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

        $q_where = $q_where . " AND BD.REQ_DATE >= " . "'" . $range[0] . "'" . 
                   " AND BD.REQ_DATE <= " . "'" . $range[1] . "'" ;      

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
    $query = "SELECT count(BD.INVT_ID) AS ITEM_QTY, BD.REQ_DATE, BK.*
               FROM tbl_borrow_detail AS BD
               Inner Join tbl_books AS BK ON BK.INVT_ID = BD.INVT_ID       
               $q_where 
               GROUP BY BD.INVT_ID
               ORDER BY BK.TITLE";
              
    $result = mysqli_query($g_db_conn, $query);
    $row_num = mysqli_num_rows($result);

    if($row_num > 0) {        
            
        while($row = mysqli_fetch_array($result)) {
            
            $d_item_qty         = $row['ITEM_QTY'];

            $d_title            = $row['TITLE'];
            $d_author           = $row['AUTHOR'];
            $d_invt_id          = $row['INVT_ID'];
            $d_code             = $row['CODE'];

            $d_cate_id          = $row['CATE'];                 
            $d_cate             = ARRAY_RETURN($Array_cate, $d_cate_id);                

            $d_genre_id         = $row['GENRE'];                 
            $d_genre            = ARRAY_RETURN($Array_genre, $d_genre_id);     
            
            
            if($i==0)
            {
                $data = $d_item_qty;                                       
                $labels = "'".$d_title."'";
            }
            else
            {
                $data = $data . ',' .  $d_item_qty;                                    
                $labels = $labels . ',' ."'". $d_title."'";                
            }  
     
            // grand total                 
            $g_qty           += $d_item_qty;
            $g_price         += $d_price;
            $g_total_price   += $d_total_price;        

            $loop[$i] = array('T_TITLE'  => $d_title, 'T_QTY'   => $d_item_qty, 
                              'T_AUTHOR'  => $d_author, 
                              'T_CATE' => $d_cate, 'T_GENRE' => $d_genre,                               
                              'T_INVT_ID'  => $d_invt_id, 'T_CODE'  => $d_code);
            $i = $i + 1;
        }
        mysqli_free_result($result);
    }   

    $query_test = $query;
   

   
   
    $tpl = new BearTemplate();
    $tpl->setFile("main", "tpl/report_item.tpl");    
    
    // Select
    $tpl->setVar("T_SELECT_CATE", ARRAY_ARRAY_RETURN($Array_cate,"0",$s_cate_id));
    $tpl->setVar("T_SELECT_GENRE", ARRAY_ARRAY_RETURN($Array_genre,"0",$s_genre_id));

    
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
    //$tpl->setVar("T_G_QTY",number_format($g_qty,2));
    //$tpl->setVar("T_G_PRICE",number_format($g_price,2));
    //$tpl->setVar("T_G_TOTAL_PRICE",number_format($g_total_price,2));    

    // Test
    //$tpl->setVar("T_QUERY",$query_test);
    
    include("$DOCUMENT_ROOT/include/COMMON.php");
    $tpl->tprint("main");
    db_close();

?>