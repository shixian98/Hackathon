 <?php 
 
	include './config/connbilling.php';
	
	if (!isset($_SESSION['username'])){
		header('Location: /');
	}
	
	if(strstr($_SERVER["HTTP_USER_AGENT"], "MSIE")){
		exit('请使用Google Chrome或FireFox浏览本网页！');
	}
	
	require './panel/main.php';
	
?>