 <?php
 include './config/connbilling.php';
 if (@$_GET['p']){
		 require './cmd_'.$_GET['p'].'.php';
 }else{  
	 require './cmd_main.php';
 }
?>