<?


    session_start();
    
    $DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'] . "/dolibrary";
    
    include("$DOCUMENT_ROOT/include/SESSION.php3");
    include("$DOCUMENT_ROOT/include/auth_staff.php3");
    include("$DOCUMENT_ROOT/include/dbconn.php3");      
    include("$DOCUMENT_ROOT/include/func_return.php3");
    include("$DOCUMENT_ROOT/include/class.BearTemplate.php");
                      
    db_init();    
       


    // Today
    $today = date("Y-m-d");


    $tpl = new BearTemplate();
    $tpl->setFile("main", "tpl/member_new.tpl");

    //$tpl->setVar("T_BIRTHDAY",$today);  
    
    // Select    
    $tpl->setVar("T_SELECT_STATUS", ARRAY_ARRAY_RETURN($Array_common_status,"1",$s_status));       
    $tpl->setVar("T_SELECT_GENDER", ARRAY_ARRAY_RETURN($Array_gender,"1",$s_status));      
   
    
    include("$DOCUMENT_ROOT/include/COMMON.php");
    
    $tpl->tprint("main");
    
    db_close();
    
?>