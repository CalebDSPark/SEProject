<?

   session_start();
   
   $DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'] . "/dolibrary";
   include("$DOCUMENT_ROOT/include/dbconn.php3");
   include("$DOCUMENT_ROOT/include/func_return.php3");
    
  
   db_init();
   

   $id           = $_POST['id'];
   $passwd       = $_POST['passwd'];
            
   $query = "SELECT *
             from tbl_member    
             where ID = '$id'";

   $result = mysqli_query($g_db_conn, $query);   
   $row_num = mysqli_num_rows($result);     

   if($row_num < 1) 
   {   
        echo("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> \n" .
                                "<script language=\"javascript\">\n" .
         "<!--\n" .
         "alert(\"Incorrect ID.\");\n" .
         "location.href='login.html';\n" .
         "//-->\n" .
         "</script>\n");
                   
        mysqli_close($g_db_conn);

        exit;   
   }
   else 
   {      
        $row = mysqli_fetch_array($result);     

        // check inactive status
        if($row['STATUS'] != '1') {
          
          echo("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> \n" .
                                      "<script language=\"javascript\">\n" .
               "<!--\n" .
               "alert(\"Inactive ID.\");\n" .
               "location.href='login.html';\n" .
               "//-->\n" .
               "</script>\n");                    
     
              mysqli_close($g_db_conn);
              exit;           
        }


        if($passwd != $row['PW']) {
           
          echo("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> \n" .
                                  "<script language=\"javascript\">\n" .
           "<!--\n" .
           "alert(\"Incorrect password.\");\n" .
           "location.href='login.html';\n" .
           "//-->\n" .
           "</script>\n");                    
 
          mysqli_close($g_db_conn);
          exit;           
       }                  
   }
    
    $ss_id                = $row['ID'];
    $ss_passwd            = $row['PW'];
    $ss_fname             = $row['FNAME']; 
    $ss_lname             = $row['LNAME']; 
    $ss_dept              = $row['DEPT'];
    $ss_job               = $row['JOBTITLE'];    
    $ss_level             = $row['LEVEL'];    
           
    mysqli_free_result($result);
   
    
    $_SESSION['ss_hf_id']      = $ss_id; 
    $_SESSION['ss_hf_passwd']  = $ss_passwd;    
    $_SESSION['ss_hf_fname']   = $ss_fname; 
    $_SESSION['ss_hf_lname']   = $ss_lname; 
    $_SESSION['ss_hf_dept']    = $ss_dept; 
    $_SESSION['ss_hf_job']     = $ss_job;        
    $_SESSION['ss_hf_level']   = $ss_level;    


    db_close();
    
    echo("<script language=\"javascript\">\n" .
             "<!--\n" .         
             "location.href='main/main.php';\n" .             
             "//-->\n" .
             "</script>\n");                 
?>