<?
    
    session_start();
    
    $DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'] . "/dolibrary";
    
    include("$DOCUMENT_ROOT/include/SESSION.php3");
    include("$DOCUMENT_ROOT/include/auth_staff.php3");
    include("$DOCUMENT_ROOT/include/dbconn.php3");  
    include("$DOCUMENT_ROOT/include/func_return.php3");
    include("$DOCUMENT_ROOT/include/class.BearTemplate.php");
    
    db_init();

    
    $code            = $_POST['code'];
    $title           = $_POST['title'];
    $author          = $_POST['author'];
    $descr           = $_POST['descr'];    
    $cate            = $_POST['s_cate'];
    $genre           = $_POST['s_genre'];        
    $status          = $_POST['s_status'];
    
    
    /*$query = "select ID from tbl_vendor where ID = '$name'";
    $result = mysqli_query($g_db_conn, $query);
    $row_num = mysqli_num_rows($result);    
    if($row_num > 0) {   
        echo("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> \n" .
                        "<script language=\"javascript\">\n" .
              "<!--\n" .
       "alert(\"The vendor name already exists.\");\n" .
        "history.back();\n"  .
         "//-->\n" .
         "</script>\n");    
       
      db_close();  
      exit;    
    }*/  
    //if($name == "") { db_close(); exit; }   



    $query = "INSERT INTO tbl_books(CODE,TITLE,AUTHOR,
                                    CATE,GENRE,DESCR,STATUS)                                                
              VALUES('$code','$title','$author',
                     '$cate','$genre','$descr',
                     '$status')";             
    $result = mysqli_query($g_db_conn, $query);    
    
    db_close();    

    echo("<script language=\"javascript\">\n" .
           "<!--\n" .
               "location.href='books.php';\n" .
               "//-->\n" .
               "</script>\n");            
    exit;        
                        
?>