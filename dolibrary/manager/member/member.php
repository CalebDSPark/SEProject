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
   

    // status select 
    $q_where     = "";
    $s_status   = $_GET['s_status'];

    if($s_status != "" && $s_status != "-1") 
    {                
        $q_where = "WHERE M.STATUS = $s_status";            
    }
	
    $query = "SELECT M.* 
              from tbl_member AS M               
              $q_where";    

              

    $result = mysqli_query($g_db_conn, $query);
    $row_num = mysqli_num_rows($result);

    if($row_num < 1) {
    }
    else {          
            $i = 0;
            while($row = mysqli_fetch_array($result)) {

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

                $d_status_id        = $row['STATUS'];
                $d_status           = ARRAY_RETURN($Array_common_status, $d_status_id);      
                                 

                $LINK = "<a href='member_edit.php?p_id=$d_id'>$d_id</a>";
                $loop[$i] = array('T_ID' => $LINK, 'T_PW' => $d_pw, 'T_SID' => $d_sid, 
                                  'T_FNAME' => $d_fname, 'T_LNAME' => $d_lname, 
                                  'T_EMP_ID' => $d_emp_id, 'T_LEVEL' => $d_level,                                  
                                  'T_PHONE' => $d_phone, 'T_EMAIL' => $d_email, 
                                  'T_ADDRESS'=>$d_address, 'T_BIRTHDAY' => $d_birthday, 'T_GENDER' => $d_gender,
                                  'T_MEMO' => $d_memo, 'T_STATUS' => $d_status,
                                  'T_DEPT' => $d_dept, 'T_JOBTITLE' => $d_jobtitle,                                   
                                   );                
                $i = $i + 1;
            }

        mysqli_free_result($result);
    }
    

    $tpl = new BearTemplate();
    $tpl->setFile("main", "tpl/member.tpl");
    $tpl->setVar("T_TITLE","Member List");
    
    $tpl->setLoop("LP", $loop);
    $tpl->setVar("T_SELECT_STATUS", ARRAY_ARRAY_RETURN($Array_common_status,"0",$s_status));

    include("$DOCUMENT_ROOT/include/COMMON.php");
    $tpl->tprint("main");
    db_close();

?>