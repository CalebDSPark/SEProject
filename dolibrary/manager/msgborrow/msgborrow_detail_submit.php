<?
    
    session_start();
    
    $DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'] . "/dolibrary";
    
    include("$DOCUMENT_ROOT/include/SESSION.php3");
    include("$DOCUMENT_ROOT/include/auth_staff.php3");
    include("$DOCUMENT_ROOT/include/dbconn.php3");  
    include("$DOCUMENT_ROOT/include/func_return.php3");
    include("$DOCUMENT_ROOT/include/class.BearTemplate.php");
    
    db_init();

    
    $p_boid             = $_GET['p_boid'];  
    
    /*echo("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> \n" .
         "<script language=\"javascript\">\n" .
         "<!--\n" .
         "alert(\"PDS Test2: $p_boid \");\n" .               
         "//-->\n" .
         "</script>\n");  */


    // Get books with BOID and update books status 
    $query = "SELECT *
              FROM tbl_borrow_detail
              WHERE BO_ID = '$p_boid'";

    $result = mysqli_query($g_db_conn, $query);
    $row_num = mysqli_num_rows($result);

    if($row_num > 0) {
                       
        while($row = mysqli_fetch_array($result)) {

            $d_borrow_invt_id            = $row['INVT_ID'];

            // update books status 
            // 1:available(return), 2:request, 3:borrowed, 4:overdue  
            $query2 = "UPDATE tbl_books SET STATUS = '3' 
                       WHERE INVT_ID = '$d_borrow_invt_id'";
            $result2 = mysqli_query($g_db_conn, $query2);        

            // update REQ_STATUS in tbl_borrow 
            // REQ_STATUS : 0:request, 1:accepted
            $query3 = "UPDATE tbl_borrow SET REQ_STATUS = '1' 
                       WHERE BO_ID = '$p_boid'";
            $result3 = mysqli_query($g_db_conn, $query3);  

        }
    }
            
    

    db_close();    

    echo("<script language=\"javascript\">\n" .
           "<!--\n" .
               "location.href='msgborrow.php'\n" .
               "//-->\n" .
               "</script>\n");            
    exit;        
                        
?>