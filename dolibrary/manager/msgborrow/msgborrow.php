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
   

    // category search
    $q_where              = "WHERE TRUE";    
    $s_req_status         = $_GET['s_req_status'];      
    $p_boid               = $_GET['p_boid'];  
    

    // borrow
    if($p_boid != "")
    {
        $act = split("_", $p_boid);
        $boid = $act[1];

        if($act[0] == "add")
        {                                                            
            /*echo("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> \n" .
                                "<script language=\"javascript\">\n" .
                      "<!--\n" .
                "alert(\"add: $poid \");\n" .               
                "//-->\n" .
                "</script>\n");  */

            // Get books with BOID and update books status 
            $query = "SELECT *
                      FROM tbl_borrow_detail
                      WHERE BO_ID = '$boid'";

            $result = mysqli_query($g_db_conn, $query);
            $row_num = mysqli_num_rows($result);

            if($row_num > 1) {
                               
                while($row = mysqli_fetch_array($result)) {

                    $d_borrow_invt_id            = $row['INVT_ID'];

                    // update books status 
                    // 1:available(return), 2:request, 3:borrowed, 4:overdue  
                    $query2 = "UPDATE tbl_books SET STATUS = '3' 
                               WHERE INVT_ID = '$d_borrow_invt_id'";
                    $result2 = mysqli_query($g_db_conn, $query2);                   
                }
            }
            
        }      
    }  


    // Request Status
    //  0:Request, 1:Accepted
    if($s_req_status != "" && $s_req_status != "-1") 
    {                
        $q_where = $q_where . " AND B.REQ_STATUS = '$s_req_status'";            
    }
    
      
    $query = "SELECT B.*, M.FNAME, M.LNAME
              FROM  tbl_borrow AS B 
              LEFT JOIN   tbl_member AS M ON B.MEMBER_ID = M.ID
              $q_where
              ORDER BY B.BO_ID DESC";
    

    $result = mysqli_query($g_db_conn, $query);
    $row_num = mysqli_num_rows($result);

    if($row_num < 1) {
    }
    else {
            
            $i = 0;

            while($row = mysqli_fetch_array($result)) {

                $d_boid             = $row['BO_ID'];
                $d_order_date       = $row['ORDER_DATE'];
                $d_member_id        = $row['MEMBER_ID'];
                
                $d_fname            = $row['FNAME'];
                $d_lname            = $row['LNAME'];
				
                $d_req_status_id    = $row['REQ_STATUS'];
                $d_req_status           = ARRAY_RETURN($Array_req_status, $d_req_status_id);      

                //$d_btn              = "<input type=\"button\" name=\"add_".$d_boid."\" id=\"add_".$d_boid."\" 
                //                         value=\"Borrow\" onclick=\"DoAdd(this)\" class=\"btn btn-success btn-xs\"/>";         
                $LINK = "<a href='msgborrow_detail.php?p_boid=$d_boid'>$d_boid</a>";
                
                $loop[$i] = array('T_BOID' => $LINK,
                    'T_ORDER_DATE' => $d_order_date,
                    'T_MEMBER_ID' => $d_member_id,
                    'T_FNAME' => $d_fname, 'T_LNAME' => $d_lname,
                    'T_REQ_STATUS' => $d_req_status);
                
                $i = $i + 1;
            }

        mysqli_free_result($result);
    }

    $title = "Management Borrowing";

    $tpl = new BearTemplate();
    $tpl->setFile("main", "tpl/msgborrow.tpl");
    $tpl->setVar("T_TITLE",$title);    
    $tpl->setLoop("LP", $loop);

    //Select    
    $tpl->setVar("T_SELECT_REQ_STATUS", ARRAY_ARRAY_RETURN($Array_req_status,"0",$s_req_status));
    
    include("$DOCUMENT_ROOT/include/COMMON.php");
    $tpl->tprint("main");
    db_close();

?>