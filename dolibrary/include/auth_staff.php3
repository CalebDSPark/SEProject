<?

        if($SS_LEVEL == "") {
        
             echo("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> \n" .
                        "<script language=\"javascript\">\n" .
                  "<!--\n" .
             "alert(\"You need to login.\");\n" .
              "location.href='../login.html';\n" .
             "//-->\n" .
             "</script>\n");        
                 exit;
        }



        if(stristr($SS_LEVEL, "staff") == false) {
        
             echo("<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" /> \n" .
                        "<script language=\"javascript\">\n" .
                  "<!--\n" .
             "alert(\"You do not have permission for this page.\");\n" .
             "history.back();\n"  .
             "//-->\n" .
             "</script>\n");        
                 exit;
        }
        
?>