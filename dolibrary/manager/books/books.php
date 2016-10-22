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
   

    // category search
    $q_where         = "WHERE TRUE";    
    $s_genre         = $_GET['s_genre'];   
    $s_cate          = $_GET['s_cate'];     
    $s_status        = $_GET['s_status'];  


    // Select Category
    if($s_cate != "" && $s_cate != "-1") 
    {                
        $q_where = $q_where . " AND B.CATE = '$s_cate'";            
    }

    // Select Genre
    if($s_genre != "" && $s_genre != "-1") 
    {                
        $q_where = $q_where . " AND B.GENRE = '$s_genre'";            
    }

    // Select status
    if($s_status != "" && $s_status != "-1") 
    {                
        $q_where = $q_where . " AND B.STATUS = '$s_status'";   
    }

      
    $query = "SELECT B.*
              from tbl_books AS B             
              $q_where";
    

    $result = mysqli_query($g_db_conn, $query);
    $row_num = mysqli_num_rows($result);

    if($row_num < 1) {
    }
    else {
            
            $i = 0;

            while($row = mysqli_fetch_array($result)) {

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
                
                
                $loop[$i] = array('T_INVT_ID' => $d_invt_id, 'T_CODE' => $d_code, 'T_TITLE' => $d_title, 
                    'T_AUTHOR' => $d_author, 'T_DESC'=>$d_descr, 'T_CATE'=>$d_cate,                    
                    'T_GENRE' =>$d_genre, 'T_STATUS'=>$d_status, 
                    );
                
                $i = $i + 1;
            }

        mysqli_free_result($result);
    }


    $tpl = new BearTemplate();
    $tpl->setFile("main", "tpl/books.tpl");
    $tpl->setVar("T_TITLE","Book List");    
    $tpl->setLoop("LP", $loop);

    //Select
    $tpl->setVar("T_SELECT_CATE", ARRAY_ARRAY_RETURN($Array_cate,"0",$s_cate));
    $tpl->setVar("T_SELECT_GENRE", ARRAY_ARRAY_RETURN($Array_genre,"0",$s_genre));
    $tpl->setVar("T_SELECT_STATUS", ARRAY_ARRAY_RETURN($Array_invt_status,"0",$s_status));
    
    include("$DOCUMENT_ROOT/include/COMMON.php");
    $tpl->tprint("main");
    db_close();

?>