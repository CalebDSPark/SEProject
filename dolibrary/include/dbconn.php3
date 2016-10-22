<?
    $g_db_conn;

    function db_init() {
    
        GLOBAL $db_conn_value;
        GLOBAL $g_db_conn;
        
		$env = $_SERVER['env'];
		$db_name=$_SERVER['db_name'];
		$db_user=$_SERVER['db_user'];
		$db_pass=$_SERVER['db_pass'];
		$db_host=$_SERVER['db_host'];	
    

		if (is_null($env)) 
        {			        
            $g_db_conn = mysqli_connect("localhost","root","");   // wamp server
		} 
        else 
        {
			$g_db_conn = mysqli_connect($db_host,$db_user,$db_pass);
		}
		
        mysqli_select_db($g_db_conn, "dolibrary") or die ("Error Opening Database System");
        
        $db_conn_value = 1;    
        
        mysqli_query($g_db_conn, "SET NAMES UTF8"); 
    }

    function db_close() {
        
        GLOBAL $db_conn_value;  
        GLOBAL $g_db_conn;   
        
        mysqli_close($g_db_conn);
        
        $db_conn_value = 0;
    }   

?>