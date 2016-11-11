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
   

    // category search
    $q_where              = "WHERE B.MEMBER_ID = '$SS_ID'";    
    $s_status             = $_GET['s_status'];  
    $s_genre              = $_GET['s_genre'];   
    $s_cate               = $_GET['s_cate'];     
    

    // Select inventory status : 
    //  1:available(return), 2:request, 3:borrowed, 4:overdue 
    if($s_status != "" && $s_status != "-1") 
    {                
        $q_where = $q_where . " AND B.INVT_STATUS = '$s_status'";            
    }

    // Select Category
    if($s_cate != "" && $s_cate != "-1") 
    {                
        $q_where = $q_where . " AND BK.CATE = '$s_cate'";            
    }

    // Select Genre
    if($s_genre != "" && $s_genre != "-1") 
    {                
        $q_where = $q_where . " AND BK.GENRE = '$s_genre'";            
    }
   
   
      
    $query = "SELECT B.ORDER_DATE, BD.* , BK.CODE, BK.TITLE, BK.AUTHOR, BK.CATE, BK.GENRE, BK.STATUS
              FROM tbl_borrow_detail AS BD
              INNER JOIN  tbl_borrow AS B ON BD.BO_ID = B.BO_ID
              LEFT JOIN   tbl_books AS BK ON BD.INVT_ID = BK.INVT_ID                      
              $q_where
              ORDER BY B.ORDER_DATE DESC";
    

    $result = mysqli_query($g_db_conn, $query);
    $row_num = mysqli_num_rows($result);

    if($row_num < 1) {
    }
    else {
            
            $i = 0;

            while($row = mysqli_fetch_array($result)) {

                $d_order_date       = $row['ORDER_DATE'];
                $d_due_date         = $row['DUE_DATE'];
                $d_return_date      = $row['RETURN_DATE'];
                $d_invt_id          = $row['INVT_ID'];
                $d_code             = $row['CODE'];
				$d_title            = $row['TITLE'];                
                $d_author           = $row['AUTHOR'];                
                $d_descr            = $row['DESCR']; 

                $d_cate_id          = $row['CATE'];                 
                $d_cate             = ARRAY_RETURN($Array_cate, $d_cate_id);                
                $d_genre_id         = $row['GENRE'];                 
                $d_genre            = ARRAY_RETURN($Array_genre, $d_genre_id);
                
                $d_status_id        = $row['STATUS'];
                $d_status           = ARRAY_RETURN($Array_invt_status, $d_status_id);                
                
                
                $loop[$i] = array('T_ORDER_DATE' => $d_order_date,'T_DUE_DATE' => $d_due_date,
                    'T_RETURN_DATE' => $d_return_date,
                    'T_INVT_ID' => $d_invt_id, 'T_CODE' => $d_code, 'T_TITLE' => $d_title, 
                    'T_AUTHOR' => $d_author, 'T_CATE' => $d_cate,
                    'T_GENRE' => $d_genre,'T_STATUS'=>$d_status);
                
                $i = $i + 1;
            }

        mysqli_free_result($result);
    }

    $title = "Reading History of ". $SS_FNAME. " ". $SS_LNAME;

    $tpl = new BearTemplate();
    $tpl->setFile("main", "tpl/myinfo_history.tpl");
    $tpl->setVar("T_TITLE",$title);    
    $tpl->setLoop("LP", $loop);

    //Select
    $tpl->setVar("T_SELECT_CATE", ARRAY_ARRAY_RETURN($Array_cate,"0",$s_cate));
    $tpl->setVar("T_SELECT_GENRE", ARRAY_ARRAY_RETURN($Array_genre,"0",$s_genre));
    $tpl->setVar("T_SELECT_STATUS", ARRAY_ARRAY_RETURN($Array_invt_status,"0",$s_status));
    
    include("$DOCUMENT_ROOT/include/COMMON.php");
    $tpl->tprint("main");
    db_close();

?>