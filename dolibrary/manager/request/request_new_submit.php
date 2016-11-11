<?
    
    session_start();
    
    $DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'] . "/dolibrary";
    
    include("$DOCUMENT_ROOT/include/SESSION.php3");
    include("$DOCUMENT_ROOT/include/auth_E.php3");
    include("$DOCUMENT_ROOT/include/dbconn.php3");  
    include("$DOCUMENT_ROOT/include/func_return.php3");
    include("$DOCUMENT_ROOT/include/class.BearTemplate.php");
    
    db_init();

    
    $p_boid             = $_POST['boid_new'];        
    $date               = $_POST['date'];


    // check my access level 
    $query = "SELECT * from tbl_member where ID = '$SS_ID'";
    $result = mysqli_query($g_db_conn, $query);
    $row_num = mysqli_num_rows($result);        
    if($row_num > 0) {   
        while($row = mysqli_fetch_array($result)) {
            $d_level          = $row['LEVEL'];                            
        }             
    }
    mysqli_free_result($result);


    if($d_level == "student")
        $due_date        =  date( "Y-m-d", strtotime( "$date +3 day" ) ); 
    else 
        $due_date        =  date( "Y-m-d", strtotime( "$date +5 day" ) ); 

    // INVT_STATUS: 1:available(return), 2:request, 3:borrowed, 4:overdue  
    $invt_status    = 2;      


    // PDS Test
    /*echo("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> \n" .
                        "<script language=\"javascript\">\n" .
              "<!--\n" .
       "alert(\"PDS test: $date : $due_date\");\n" .        
         "//-->\n" .
         "</script>\n");      
    db_close();  
    exit;*/


    // check duplicated BOID
    $query = "select * from tbl_borrow where BO_ID = '$p_boid'";
    $result = mysqli_query($g_db_conn, $query);
    $row_num = mysqli_num_rows($result);        
    if($row_num > 0) {   
        echo("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> \n" .
                        "<script language=\"javascript\">\n" .
            "<!--\n" .
            "alert(\"The borrowing request number already exists.\");\n" .        
            "history.back();\n"  .
            "//-->\n" .
            "</script>\n");    
       
      db_close();  
      exit;    
    }


    // check borrow bag and save      
    $query =  "SELECT BB.*
               FROM tbl_borrow_bag AS BB
               INNER JOIN tbl_books AS B ON BB.INVT_ID = B.INVT_ID";
    $result = mysqli_query($g_db_conn, $query);
    $row_num = mysqli_num_rows($result);

    if($row_num < 1) 
    {
        echo("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> \n" .
                        "<script language=\"javascript\">\n" .
            "<!--\n" .
            "alert(\"Please add items.\");\n" .        
            "history.back();\n"  .
            "//-->\n" .
            "</script>\n");    
       
        db_close();  
        exit;    
    }
    else 
    {                
        while($row = mysqli_fetch_array($result)) {
            
            $bag_invt_id          = $row['INVT_ID'];                                                    

            
            $query2 = "INSERT INTO tbl_borrow_detail(BO_ID, INVT_ID, REQ_DATE, DUE_DATE)  
                       VALUES('$p_boid','$bag_invt_id', '$date','$due_date')";             
            $result2 = mysqli_query($g_db_conn, $query2);                    

            // update books status 
            // 1:available(return), 2:request, 3:borrowed, 4:overdue  
            $query3 = "UPDATE tbl_books SET STATUS = '2' 
                       WHERE INVT_ID = '$bag_invt_id'";
            $result3 = mysqli_query($g_db_conn, $query3);                               
        }
        mysqli_free_result($result);
    }

        
    // set borrow    
    $member_id      = $SS_ID;    
 
    // REQ_STATUS : 0:request, 1:accepted
    $query = "INSERT INTO tbl_borrow(BO_ID,ORDER_DATE,MEMBER_ID, REQ_STATUS) 
              VALUES('$p_boid','$date','$member_id', 0)";             
    $result = mysqli_query($g_db_conn, $query);    
    

    db_close();    

    echo("<script language=\"javascript\">\n" .
           "<!--\n" .
               "location.href='../main/main.php'\n" .
               "//-->\n" .
               "</script>\n");            
    exit;        
                        
?>