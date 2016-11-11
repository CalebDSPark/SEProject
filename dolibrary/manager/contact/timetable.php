<?


    session_start();

    $DOCUMENT_ROOT = $_SERVER['DOCUMENT_ROOT'] . "/dolibrary";

    include("$DOCUMENT_ROOT/include/SESSION.php3");
    include("$DOCUMENT_ROOT/include/auth_E.php3");
    include("$DOCUMENT_ROOT/include/dbconn.php3");    
    include("$DOCUMENT_ROOT/include/func_return.php3");
    include("$DOCUMENT_ROOT/include/class.BearTemplate.php");

    db_init();    
    

    $loop = array();

    $memo = "";
    $open_time_weekday  = "08:00 AM";
    $close_time_weekday = "07:00 PM";

    $open_time_weekend  = "09:00 AM";
    $close_time_weekend = "05:00 PM";

    $close              = "Close";
   
    $loop[0] = array('T_OPEN_TIME' => $open_time_weekday, 'T_CLOSE_TIME' => $close_time_weekday, 
                      'T_DAY' => 'MON', 'T_MEMO' => $memo);

    $loop[1] = array('T_OPEN_TIME' => $open_time_weekday, 'T_CLOSE_TIME' => $close_time_weekday, 
                      'T_DAY' => 'TUE', 'T_MEMO' => $memo);

    $loop[2] = array('T_OPEN_TIME' => $open_time_weekday, 'T_CLOSE_TIME' => $close_time_weekday, 
                      'T_DAY' => 'WED', 'T_MEMO' => $memo);

    $loop[3] = array('T_OPEN_TIME' => $open_time_weekday, 'T_CLOSE_TIME' => $close_time_weekday, 
                      'T_DAY' => 'THUR', 'T_MEMO' => $memo);

    $loop[4] = array('T_OPEN_TIME' => $open_time_weekday, 'T_CLOSE_TIME' => $close_time_weekend, 
                      'T_DAY' => 'FIR', 'T_MEMO' => $memo);

    $loop[5] = array('T_OPEN_TIME' => $open_time_weekend, 'T_CLOSE_TIME' => $close_time_weekend, 
                      'T_DAY' => 'SAT', 'T_MEMO' => $memo);

    $loop[6] = array('T_OPEN_TIME' => $close, 'T_CLOSE_TIME' => $close, 
                      'T_DAY' => 'SUN', 'T_MEMO' => $memo);

    $title = "Timetable of DoLibray";

    $tpl = new BearTemplate();
    $tpl->setFile("main", "tpl/timetable.tpl");
    $tpl->setVar("T_TITLE",$title);  
    $tpl->setLoop("LP", $loop);      
    
    
    include("$DOCUMENT_ROOT/include/COMMON.php");
    $tpl->tprint("main");
    db_close();

?>