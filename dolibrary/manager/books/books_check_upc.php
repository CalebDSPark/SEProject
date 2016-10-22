<?
    
    session_start();
    
    $DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'] . "/dolibrary";
    
    include("$DOCUMENT_ROOT/include/SESSION.php3");
    include("$DOCUMENT_ROOT/include/auth_staff.php3");
    include("$DOCUMENT_ROOT/include/dbconn.php3");  
    include("$DOCUMENT_ROOT/include/func_return.php3");
    include("$DOCUMENT_ROOT/include/class.BearTemplate.php");
    
    db_init();

    
    $f_upc               = $_GET['f_upc'];       
    $reVal               = "unique";


    // PDS Test
    /*echo("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> \n" .
                        "<script language=\"javascript\">\n" .
              "<!--\n" .
       "alert(\"PDS test: $f_invt_id:$f_qty\");\n" .
        "history.back();\n"  .
         "//-->\n" .
         "</script>\n");      */
    //db_close();  
    //exit;


    // check duplicate upc
    $query = "SELECT INVT_ID, CODE from tbl_books
              WHERE CODE = '$f_upc'";
    $result = mysqli_query($g_db_conn, $query);   
    $row_num = mysqli_num_rows($result); 

    if($row_num > 0) { 
        
        $row = mysqli_fetch_array($result);    
        $reVal          = $row['INVT_ID'];  

        mysqli_free_result($result);      
    }

  
    echo $reVal;
    db_close();    
                        
?>