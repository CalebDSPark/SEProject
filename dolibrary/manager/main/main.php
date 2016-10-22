<?


    session_start();
    
    $DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'] . "/dolibrary";
    
    include("$DOCUMENT_ROOT/include/SESSION.php3");
    include("$DOCUMENT_ROOT/include/auth_E.php3");    
    include("$DOCUMENT_ROOT/include/dbconn.php3");      
    include("$DOCUMENT_ROOT/include/func_return.php3");
    include("$DOCUMENT_ROOT/include/class.BearTemplate.php");


    $tpl = new BearTemplate();
    $tpl->setFile("main", "tpl/main.tpl");    
    $tpl->setVar("T_TITLE","Main");  
 
    include("$DOCUMENT_ROOT/include/COMMON.php");   
    $tpl->tprint("main");
    
?>