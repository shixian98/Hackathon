 <?php
	include './config/connbilling.php';
	require './templates/'.$templates.'/header.html';
	if(strstr($_SERVER["HTTP_USER_AGENT"], "MSIE")){
		exit('请使用Google Chrome或FireFox浏览本网页！');
	}
	require './templates/'.$templates.'/menu.html';
	require './templates/'.$templates.'/download.html';
	require './templates/'.$templates.'/footer.html';
?>