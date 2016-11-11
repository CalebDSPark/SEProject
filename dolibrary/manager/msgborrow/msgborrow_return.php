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
      
    $p_re_invt_id         = $_GET['p_re_invt_id'];  
    $q_where              = "WHERE TRUE";    
  
    
    date_default_timezone_set('America/Los_Angeles');
    $today   = date("Y-m-d");
 
 

    // Update return book status in tbl_books
    // Update return date in tbl_borrow_detail  
    if($p_re_invt_id != "" && $p_re_invt_id != "-1") 
    {                
        $act     = split("_", $p_re_invt_id);
        $boid    = $act[0];
        $invt_id = $act[1];

  
        //  1:available(return), 2:request, 3:borrowed, 4:overdue 
        // update book status to '1'
        $query3 = "UPDATE tbl_books SET STATUS = '1' 
                   WHERE INVT_ID = '$invt_id'";
        $result3 = mysqli_query($g_db_conn, $query3);           

        $query4 = "UPDATE tbl_borrow_detail SET RETURN_DATE = '$today' 
                   WHERE BO_ID = '$boid' AND INVT_ID = '$invt_id' ";
        $result4 = mysqli_query($g_db_conn, $query4);           
    }
        


    $query = "SELECT BK.*,B.BO_ID, BD.DUE_DATE, M.ID, M.FNAME,M.LNAME
              FROM tbl_books AS BK
              LEFT JOIN   tbl_borrow_detail AS BD ON BD.INVT_ID = BK.INVT_ID                      
              INNER JOIN  tbl_borrow AS B ON BD.BO_ID = B.BO_ID
              INNER JOIN  tbl_member AS M ON B.MEMBER_ID = M.ID              
              WHERE (BK.STATUS = '3' OR BK.STATUS = '4') AND BD.RETURN_DATE IS NULL
              ORDER BY BD.DUE_DATE, BK.TITLE";
    

    $result = mysqli_query($g_db_conn, $query);
    $row_num = mysqli_num_rows($result);

    if($row_num < 1) {
    }
    else {
            
            $i = 0;

            while($row = mysqli_fetch_array($result)) {

                $d_boid             = $row['BO_ID'];                                   
                $d_invt_id          = $row['INVT_ID'];                               
                $d_due_date         = $row['DUE_DATE'];
                $d_title            = $row['TITLE'];                
                $d_code             = $row['CODE'];
                $d_author           = $row['AUTHOR'];                
                
                $d_member_id        = $row['ID'];
                $d_fname            = $row['FNAME'];
                $d_lname            = $row['LNAME'];

                //$d_descr            = $row['DESCR']; 
                $d_cate_id          = $row['CATE'];                 
                $d_cate             = ARRAY_RETURN($Array_cate, $d_cate_id);                
                $d_genre_id         = $row['GENRE'];                 
                $d_genre            = ARRAY_RETURN($Array_genre, $d_genre_id);
                
                // check invt_status and update status                
                $d_status_id        = $row['STATUS'];
                if($d_status_id != '4')
                {
                    if($d_due_date < $today)
                    {
                        // 1:available(return), 2:request, 3:borrowed, 4:overdue  
                        $query2 = "UPDATE tbl_books SET STATUS = '4' 
                                   WHERE INVT_ID = '$d_invt_id'";
                        $result2 = mysqli_query($g_db_conn, $query2);   
                        $d_status_id = '4';
                    }
                }

                $d_status           = ARRAY_RETURN($Array_invt_status, $d_status_id);      
               

                if($d_status_id == '4')
                {                
                    $d_btn = "<input type=\"button\" name=".$d_boid."_".$d_invt_id."\" id=".$d_boid."_".$d_invt_id." 
                                         value=\"Return\" onclick=\"DoReturn(this)\" class=\"btn btn-danger btn-xs\"/>";         
                }
                else{                
                    $d_btn = "<input type=\"button\" name=".$d_boid."_".$d_invt_id."\" id=".$d_boid."_".$d_invt_id."
                                         value=\"Return\" onclick=\"DoReturn(this)\" class=\"btn btn-warning btn-xs\"/>";         
                }


                // calculate overdue fine
                $d_overdays = 0;
                if($d_status_id == '4')
                {
                    $d_time_in          = $d_due_date;
                    $d_time_out         = $today;
                             
                    // split time out
                    $yy = substr($d_time_out, 0, 4);
                    $mm = substr($d_time_out, 5, 2);
                    $dd = substr($d_time_out, 8, 2);
                    $hh = 0;
                    $ii = 0;
                    $ss = 0;
 
                    // split time in
                    $yy_start = substr($d_time_in, 0, 4);
                    $mm_start = substr($d_time_in, 5, 2);
                    $dd_start = substr($d_time_in, 8, 2);
                    $hh_start = 0;
                    $ii_start = 0;
                    $ss_start = 0;

                    $time_out_stamp = mktime($hh, $ii, $ss, $mm, $dd, $yy);
                    $time_in_stamp = mktime($hh_start, $ii_start, $ss_start, $mm_start, $dd_start, $yy_start);

                    // '/60' for miniutes, '/60*60' for hours, '/60*60*24' for days                    
                    $d_overdays = round(($time_out_stamp - $time_in_stamp) / (60*60*24), 2);

                    /*echo("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> \n" .
                    "<script language=\"javascript\">\n" .
                    "<!--\n" .
                    "alert(\"PDS test: $d_overdays\");\n" .       
                    "//-->\n" .
                    "</script>\n");*/
                }
                $d_overdays = number_format($d_overdays, 2);
                
                
                $loop[$i] = array('T_BTN' => $d_btn,
                    'T_DUE_DATE' => $d_due_date,
                    'T_TITLE' => $d_title, 'T_CODE' => $d_code,
                    'T_AUTHOR' => $d_author, 'T_CATE' => $d_cate, 'T_GENRE' => $d_genre,
                    'T_MEMBER_ID' => $d_member_id,
                    'T_FNAME' => $d_fname, 'T_LNAME' => $d_lname,                     
                    'T_STATUS'=>$d_status, 'T_OVERDUE_FEE' => $d_overdays);
                
                $i = $i + 1;
            }

        mysqli_free_result($result);
    }

    $title = "Management Borrowing";

    $tpl = new BearTemplate();
    $tpl->setFile("main", "tpl/msgborrow_return.tpl");
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