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
   
    
    $p_boid             = $_GET['p_boid'];  
    
    $q_where            = "WHERE BD.BO_ID = '$p_boid'";    
    //$s_status             = $_GET['s_status'];  
    
    
      
    $query = "SELECT BD.*, B.MEMBER_ID, B.REQ_STATUS , 
                     BK.CODE, BK.TITLE, BK.AUTHOR, BK.CATE, BK.GENRE, BK.STATUS
              FROM tbl_borrow_detail AS BD              
              LEFT JOIN   tbl_books AS BK ON BD.INVT_ID = BK.INVT_ID    
              LEFT JOIN   tbl_borrow AS B ON BD.BO_ID = B.BO_ID                  
              $q_where
              ORDER BY BK.TITLE ";
    

    $result = mysqli_query($g_db_conn, $query);
    $row_num = mysqli_num_rows($result);

    if($row_num < 1) {
    }
    else {
            
            $i = 0;

            while($row = mysqli_fetch_array($result)) {

                $d_boid             = $row['BO_ID'];
                
                $d_member_id        = $row['MEMBER_ID'];
                $d_req_status       = $row['REQ_STATUS'];

                $d_code             = $row['CODE'];
				$d_title            = $row['TITLE'];                
                $d_author           = $row['AUTHOR'];                
                $d_descr            = $row['DESCR']; 

                $d_status_id        = $row['STATUS']; 
                $d_status           = ARRAY_RETURN($Array_invt_status, $d_status_id);                

                $d_cate_id          = $row['CATE'];                 
                $d_cate             = ARRAY_RETURN($Array_cate, $d_cate_id);                
                $d_genre_id         = $row['GENRE'];                 
                $d_genre            = ARRAY_RETURN($Array_genre, $d_genre_id);
                
                //$d_status_id        = $row['INVT_STATUS'];
                //$d_status           = ARRAY_RETURN($Array_invt_status, $d_status_id);      

                //$d_btn              = "<input type=\"button\" name=\"add_".$d_boid."\" id=\"add_".$d_boid."\" 
                //                         value=\"Borrow\" onclick=\"DoAdd(this)\" class=\"btn btn-success btn-xs\"/>";         
                                
                $loop[$i] = array(
                    //'T_ORDER_DATE' => $d_order_date,'T_DUE_DATE' => $d_due_date,
                    //'T_MEMBER_ID' => $d_member_id,                    
                    'T_CODE' => $d_code, 'T_TITLE' => $d_title, 
                    'T_AUTHOR' => $d_author, 'T_CATE' => $d_cate,
                    'T_GENRE' => $d_genre,'T_STATUS'=>$d_status);
                
                $i = $i + 1;
            }

        mysqli_free_result($result);
    }

    $title = "Member ID: ". $d_member_id;

    $tpl = new BearTemplate();
    $tpl->setFile("main", "tpl/msgborrow_detail.tpl");
    $tpl->setVar("T_TITLE",$title);    
    $tpl->setVar("T_BOID",$d_boid);  
    $tpl->setVar("T_REQ_STATUS",$d_req_status);  

    $tpl->setLoop("LP", $loop);

    //Select
    //$tpl->setVar("T_SELECT_CATE", ARRAY_ARRAY_RETURN($Array_cate,"0",$s_cate));
    //$tpl->setVar("T_SELECT_GENRE", ARRAY_ARRAY_RETURN($Array_genre,"0",$s_genre));
    //$tpl->setVar("T_SELECT_STATUS", ARRAY_ARRAY_RETURN($Array_invt_status,"0",$s_status));
    
    include("$DOCUMENT_ROOT/include/COMMON.php");
    $tpl->tprint("main");
    db_close();

?>