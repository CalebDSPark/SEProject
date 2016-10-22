<?
    
    session_start();
    
    $DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'] . "/dolibrary";
    
    include("$DOCUMENT_ROOT/include/SESSION.php3");
    include("$DOCUMENT_ROOT/include/auth_staff.php3");
    include("$DOCUMENT_ROOT/include/dbconn.php3");  
    include("$DOCUMENT_ROOT/include/func_return.php3");
    include("$DOCUMENT_ROOT/include/class.BearTemplate.php");
    
    db_init();

  
    $id           = $_POST['id'];
    $pw           = $_POST['pw'];
    $fname        = $_POST['fname'];
    $lname        = $_POST['lname'];
    $sid          = $_POST['sid'];
    $emp_id       = $_POST['emp_id'];    
    $email        = $_POST['email'];
    $phone        = $_POST['phone'];    
    $address      = $_POST['address'];        
    $birthday     = $_POST['birthday'];        
    $gender       = $_POST['s_gender'];    
    $status       = $_POST['s_status'];
    $memo         = $_POST['memo'];

    // staff info
    $dept      = $_POST['s_dept'];
    $jobtitle  = $_POST['s_jobtitle'];

    // Access Level
    $level        = $_POST['radioLevel'];
    

    // Today
    $today = date("Y-m-d");

    

    $query = "select ID from tbl_member where ID = '$id'";
    $result = mysqli_query($g_db_conn, $query);
    $row_num = mysqli_num_rows($result);
    
    if($row_num > 0) {   
        echo("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> \n" .
                        "<script language=\"javascript\">\n" .
              "<!--\n" .
       "alert(\"The member ID already exists.\");\n" .
        "history.back();\n"  .
         "//-->\n" .
         "</script>\n");    
       
      db_close();  
      exit;    
    }
    mysqli_free_result($result);
    //if($name == "") { db_close(); exit; }    

    // Insert to tbl_member
    $query = "INSERT INTO tbl_member(ID, PW, FNAME, LNAME,
                                     SID, EMP_ID, LEVEL,
                                     PHONE, EMAIL, ADDRESS,
                                     BIRTHDAY, GENDER, STATUS, MEMO,
                                     DEPT, JOBTITLE
                                     ) 
              VALUES('$id','$pw','$fname','$lname',
                     '$sid','$emp_id','$level',
                     '$phone','$email','$address', 
                     '$birthday','$gender','$status','$memo',
                     '$dept','$jobtitle'
                     )";

    $result = mysqli_query($g_db_conn, $query);
      

    db_close();    

    echo("<script language=\"javascript\">\n" .
           "<!--\n" .
               "location.href='member.php';\n" .
               "//-->\n" .
               "</script>\n");            
    exit;        
                        
?>