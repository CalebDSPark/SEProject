<?


    session_start();
    
    $DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'] . "/dolibrary";
    
    include("$DOCUMENT_ROOT/include/SESSION.php3");
    include("$DOCUMENT_ROOT/include/auth_staff.php3");
    include("$DOCUMENT_ROOT/include/dbconn.php3");      
    include("$DOCUMENT_ROOT/include/func_return.php3");
    include("$DOCUMENT_ROOT/include/class.BearTemplate.php");
                      
    db_init(); 
    
    $p_id             = $_GET['p_id'];        
        
    //
    // tbl_member
    $query = "SELECT M.* 
              from tbl_member AS M               
              where ID = '$p_id'";

    $result = mysqli_query($g_db_conn, $query);    
    $row_num = mysqli_num_rows($result);    
    
    if($row_num < 1) {
        
        db_close();
                
        echo("<script language=\"javascript\">\n" .
              "<!--\n" .
          "alert('There is no infomation.');\n" .    
                 "history.back();\n" .
         "//-->\n" .
         "</script>\n");    
        
        exit;                         
    }                  
    else 
    {                
        $row = mysqli_fetch_array($result);

        $d_id               = $row['ID'];
        $d_pw               = $row['PW'];
        $d_fname            = $row['FNAME'];                
        $d_lname            = $row['LNAME'];
        $d_sid              = $row['SID'];
        $d_emp_id           = $row['EMP_ID'];                
        $d_level            = $row['LEVEL'];                
        $d_phone            = $row['PHONE'];                
        $d_email            = $row['EMAIL'];                
        $d_address          = $row['ADDRESS'];
        $d_birthday         = $row['BIRTHDAY'];
        $d_gender           = $row['GENDER'];                
        $d_memo             = $row['MEMO'];  
        $d_dept             = $row['DEPT'];  
        $d_jobtitle         = $row['JOBTITLE'];                   
        $d_status           = $row['STATUS'];          
    
        mysqli_free_result($result);
    }
  

    // Access Level
    $chk_disabled = "disabled";
    $arrLevel = explode("-", $d_level);
    if($arrLevel[0] == "student")
        $rdo_student = "checked";
    else if($arrLevel[0] == "staff")
        $rdo_staff = "checked";
   


    $tpl = new BearTemplate();
    $tpl->setFile("main", "tpl/member_edit.tpl");  

    $tpl->setVar("T_ID",$d_id);  
    $tpl->setVar("T_PW",$d_pw);  
    $tpl->setVar("T_FNAME",$d_fname);  
    $tpl->setVar("T_LNAME",$d_lname);  
    $tpl->setVar("T_SID",$d_sid);  
    $tpl->setVar("T_EMP_ID",$d_emp_id);      
    $tpl->setVar("T_LEVEL",$d_level);      
    $tpl->setVar("T_PHONE",$d_phone);          
    $tpl->setVar("T_EMAIL",$d_email);  
    $tpl->setVar("T_ADDRESS",$d_address);  
    $tpl->setVar("T_BIRTHDAY",$d_birthday);  
    $tpl->setVar("T_MEMO",$d_memo);       
    $tpl->setVar("T_DEPT",$d_dept);                  
    $tpl->setVar("T_JOBTITLE",$d_jobtitle);     

    $tpl->setVar("T_SELECT_STATUS", ARRAY_ARRAY_RETURN($Array_common_status,"1",$d_status));     
    $tpl->setVar("T_SELECT_GENDER", ARRAY_ARRAY_RETURN($Array_gender,"1",$d_gender));         
    
    
    // Access Level
    $tpl->setVar("T_RDO_STUDENT",$rdo_student);  
    $tpl->setVar("T_RDO_STAFF",$rdo_staff);  
    

    include("$DOCUMENT_ROOT/include/COMMON.php");
    
    $tpl->tprint("main");
    
    db_close();
    
?>
