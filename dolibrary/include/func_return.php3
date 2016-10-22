<?

        $GLOBAL_PASSWD = "re!@#start";              
		
        $Array_month                        = array('-1','All','1','January','2','February','3','March','4','April','5','May','6','June','7','July','8','August','9','September','10','October','11','Nomember','12','December');

        $Array_province              = array('-1','All','1','British Columbia','0','----','2','Alberta','3','Manitoba','4','New Brunswick','5','Newfoundland','6','Nova Scotia','7','Ontario','8','Prince Edward Island','9','Quebec','10','Saskatchewan','11','Territory: Northwest Territories','12','Territory: Nunavut','13','Territory: Yukon');

        // status 
        $Array_common_status        = array('-1','All','1','Active','0','Inactive');

        // request status 
        $Array_req_status        = array('-1','All','1','Accepted','0','Request');

        $Array_country              = array('-1','All','1','Canada','2','USA','3','Korea','4','Others');        

        $Array_invt_status          = array('-1','All','1','Available(Return)','2','Request','3','Borrowed','4','Overdue');

        $Array_dept                 = array('-1','All','1','Division');

        $Array_yesno                = array('-1','All','1','Yes','2','No');

        $Array_gender               = array('-1','All','1','Female','2','Male');
	
        $Array_cate                 = array('-1','All','1','Paper Book','2','e-Book','3','DVD');

        $Array_genre                = array('-1','All','1','Science','2','Business','3','Economy',
                                             '4','Engineering','5','Language','6','Novel');

   
        function ARRAY_PRINT($str,$flag,$cvalue) {

            if($flag == "0") $init = 0;
            else $init = 1;

            for($i=$init;$i<(count($str)/2);$i++) 
            {
                if($cvalue == $str[$i*2]) echo "<option value='" . $str[$i*2] . "' selected>" . $str[$i*2+1] . "</option>\n";
                else     echo "<option value='" . $str[$i*2] . "'>" . $str[$i*2+1] . "</option>\n";
            }
        }

        function ARRAY_ARRAY_RETURN($str,$flag,$cvalue) {

            if($flag == "0") $init = 0;
            else $init = 1;

            for($i=$init;$i<(count($str)/2);$i++) {

                    if($cvalue == $str[$i*2]) $return_value .= "<option value='" . $str[$i*2] . "' selected>" . $str[$i*2+1] . "</option>\n";
                    else     $return_value .= "<option value='" . $str[$i*2] . "'>" . $str[$i*2+1] . "</option>\n";
            }

            return $return_value;
        }

        function ARRAY_DISPLAY_RETURN($str,$flag,$cvalue) {

            if($flag == "0") $init = 0;
            else $init = 1;

            for($i=$init;$i<(count($str)/2);$i++) {

                    if($cvalue == $str[$i*2+1]) $return_value .= "<option value='" . $str[$i*2+1] . "' selected>" . $str[$i*2+1] . "</option>\n";
                    else     $return_value .= "<option value='" . $str[$i*2+1] . "'>" . $str[$i*2+1] . "</option>\n";
            }

            return $return_value;
        }

        function ARRAY_ARRAY_RETURN_NOBR($str,$flag,$cvalue) {

            if($flag == "0") $init = 0;
            else $init = 1;

            for($i=$init;$i<(count($str)/2);$i++) {

                    if($cvalue == $str[$i*2]) $return_value .= "<option value='" . $str[$i*2] . "' selected>" . $str[$i*2+1] . "</option>";
                    else     $return_value .= "<option value='" . $str[$i*2] . "'>" . $str[$i*2+1] . "</option>";
            }

            return $return_value;
        }

             
        function ARRAY_RETURN($str,$cvalue) {

            for($i=0;$i<(count($str)/2);$i++) {

                    if($cvalue == $str[$i*2]) $return_msg = $str[$i*2+1];

            }

            return $return_msg;

        }

        function ARRAY_RADIO_RETURN($str,$cvalue,$vardefine) {

            $return_value = "";

            for($i=0;$i<(count($str)/2);$i++) {

                    if($cvalue == $str[$i*2]) $return_value .= "<input type='radio' name='$vardefine' value='".$str[$i*2]."' checked>".$str[$i*2+1]."&nbsp;&nbsp;&nbsp;";
                    else      $return_value .= "<input type='radio' name='$vardefine' value='".$str[$i*2]."'>".$str[$i*2+1]."&nbsp;&nbsp;&nbsp;";
            }

            return $return_value;
        }

        function ARRAY_CHECK_RETURN($str,$cvalue) {

            $return_value = "";

            for($i=0;$i<(count($str)/3);$i++) {

                    if($cvalue[$i] == $str[$i*3]) $return_value .= "<input type='checkbox' name='".$str[$i*3+2]."' value='".$str[$i*3]."' checked>".$str[$i*3+1]."&nbsp;&nbsp;";
                    else      $return_value .= "<input type='checkbox' name='".$str[$i*3+2]."' value='".$str[$i*3]."'>".$str[$i*3+1]."&nbsp;&nbsp;";

            }

            return $return_value;
        }

        function ARRAY_LIST_RETURN($cvalue) {

            for($i=1;$i<1001;$i++) {

                    if($cvalue == $i) $return_value .= "<option value='" . $i . "' selected>" . $i . "</option>\n";
                    else     $return_value .= "<option value='" . $i . "'>" . $i . "</option>\n";

            }

            return $return_value;
        }
           
?>