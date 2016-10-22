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
    //$q_where         = "WHERE B.STATUS = '1'";    
    $s_genre         = $_GET['s_genre'];   
    $s_cate          = $_GET['s_cate'];     
    $s_stauts        = $_GET['s_stauts'];   

    $p_bag_invt      = $_GET['bag_invt'];
    $q_where         = "WHERE BB.INVT_ID IS NULL AND B.STATUS = '1' ";   
    

    // Add or Del inventory on bag
    if($p_bag_invt != "")
    {
        $act = split("_", $p_bag_invt);
        $invt_id = $act[1];

        if($act[0] == "add")
        {                          
            $query = "INSERT INTO tbl_borrow_bag(INVT_ID) 
                      VALUES('$invt_id')";             
            $result = mysqli_query($g_db_conn, $query);            
        }
        else if($act[0] == "del")
        {
            $query = "DELETE FROM tbl_borrow_bag WHERE INVT_ID = '$invt_id'";
            $result = mysqli_query($g_db_conn, $query);    
        }
        else if($act[0] == "init")
        {
            $query = "DELETE FROM tbl_borrow_bag";
            $result = mysqli_query($g_db_conn, $query);    
        }
    }  


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
  

      
    $query = "SELECT B.*
              from tbl_books AS B                                      
              Left Join tbl_borrow_bag AS BB ON B.INVT_ID = BB.INVT_ID             
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
                $d_status           = ARRAY_RETURN($Array_common_status, $d_status_id);                
                
                $p_btn                = "<input type=\"button\" name=\"add_".$d_invt_id."\" id=\"add_".$d_invt_id."\" 
                                         value=\"Add\" onclick=\"DoAdd(this)\" class=\"btn btn-success btn-xs\"/>";
                
                
                $loop[$i] = array('T_BTN' => $p_btn,'T_INVT_ID' => $d_invt_id, 'T_CODE' => $d_code, 
                                  'T_TITLE' => $d_title, 'T_AUTHOR' => $d_author, 'T_DESC'=>$d_descr, 
                                  'T_CATE'=>$d_cate, 'T_GENRE' =>$d_genre, 'T_STATUS'=>$d_status);                
                $i = $i + 1;
            }

        mysqli_free_result($result);
    }


    // New borrow request
    $query = "select MAX(BO_ID) as MAX_ID from tbl_borrow ";    
    $result = mysqli_query($g_db_conn, $query);
    $row_num = mysqli_num_rows($result);

    if($row_num > 0) {
        $row = mysqli_fetch_array($result);
        $p_boid_new = $row['MAX_ID'] + 1;
    }
    else
        $p_boid_new = 1;

    mysqli_free_result($result);  

    // Today
    $today = date("Y-m-d");

    
    // Borrow request shopping bag 
    $query = "SELECT BB.*, B.*
              from tbl_borrow_bag as BB, tbl_books as B                             
              WHERE BB.INVT_ID = B.INVT_ID";
    
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
                $d_status           = ARRAY_RETURN($Array_common_status, $d_status_id);   

                $p_btn                = "<input type=\"button\" name=\"del_".$d_invt_id."\" id=\"del_".$d_invt_id."\" 
                                         value=\"Del\" onclick=\"DoDel(this)\" class=\"btn btn-danger btn-xs\"/>";               
                
                $loop_bag[$i] = array('T_BTN' => $p_btn,'T_INVT_ID' => $d_invt_id, 'T_CODE' => $d_code, 
                                      'T_TITLE' => $d_title, 'T_AUTHOR' => $d_author, 'T_DESC'=>$d_descr, 
                                      'T_CATE'=>$d_cate, 'T_GENRE' =>$d_genre, 'T_STATUS'=>$d_status);
                $i = $i + 1;
            }  
            mysqli_free_result($result);                   
    }


    $tpl = new BearTemplate();
    $tpl->setFile("main", "tpl/request.tpl");
    $tpl->setVar("T_TITLE","Book List");    
    $tpl->setLoop("LP", $loop);

    //Select
    $tpl->setVar("T_SELECT_CATE", ARRAY_ARRAY_RETURN($Array_cate,"0",$s_cate));
    $tpl->setVar("T_SELECT_GENRE", ARRAY_ARRAY_RETURN($Array_genre,"0",$s_genre));
    $tpl->setVar("T_SELECT_STATUS", ARRAY_ARRAY_RETURN($Array_common_status,"0",$s_status));

    // New borrow request
    $tpl->setVar("T_BOID_NEW", sprintf("%06d", $p_boid_new));
    $tpl->setVar("T_DATE", $today);
    $tpl->setLoop("LP_BAG", $loop_bag);
    
    include("$DOCUMENT_ROOT/include/COMMON.php");
    $tpl->tprint("main");
    db_close();

?>