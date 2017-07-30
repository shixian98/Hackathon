<?php

	$username = $_SESSION['username'];
	$result = mysql_query("select * from account where username = '".$username."' ");
	$row = mysql_fetch_assoc($result);
	
	require './templates/'.$templates.'/panel/header.html';
	require './templates/'.$templates.'/panel/menu.html';
	if (@$_GET['m']){
		require './templates/'.$templates.'/panel/'.$_GET['m'].'.html';
	}else{
		require './templates/'.$templates.'/panel/main.html';
	}
	require './templates/'.$templates.'/panel/footer.html';
	
?>