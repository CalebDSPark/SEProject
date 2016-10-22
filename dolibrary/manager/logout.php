<?
       
   session_start();
   
   
   session_unset ();         

   unset($_SESSION['ss_hf_id']);      
   unset($_SESSION['ss_hf_passwd']); 
   unset($_SESSION['ss_hf_fname']);  
   unset($_SESSION['ss_hf_lname']);  
   unset($_SESSION['ss_hf_dept']);   
   unset($_SESSION['ss_hf_job']);    
   unset($_SESSION['ss_hf_level']);  
          
   session_destroy();


?>             
 <script language="javascript">


    function logout() {
    
         top.location.href="login.html"         
    }
           
    setTimeout("logout()", 1000);
               
</script>