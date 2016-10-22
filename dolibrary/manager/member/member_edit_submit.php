<?
    
    session_start();

    $DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'] . "/dolibrary";
    
    include("$DOCUMENT_ROOT/include/SESSION.php3");
    include("$DOCUMENT_ROOT/include/auth_staff.php3");
    include("$DOCUMENT_ROOT/include/dbconn.php3");
    include("$DOCUMENT_ROOT/include/func_return.php3");    

    
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
   
    
    $query = "UPDATE tbl_member 
              SET PW='$pw',FNAME='$fname',LNAME='$lname',SID='$sid',
                  EMP_ID='$emp_id',LEVEL='$level',
                  PHONE='$phone',EMAIL='$email',
                  ADDRESS='$address',BIRTHDAY='$birthday',GENDER='$gender',
                  STATUS='$status',MEMO='$memo',
                  DEPT='$dept', JOBTITLE='$jobtitle'
              WHERE ID = '$id'";
 
    $result = mysqli_query($g_db_conn, $query);
                              
    db_close();
    
    echo("<script language=\"javascript\">\n" .
           "<!--\n" .
               "location.href='member.php';\n" .
               "//-->\n" .
               "</script>\n");               
    exit;                                
?>