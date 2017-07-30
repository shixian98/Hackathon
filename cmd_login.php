 <?php 
	include './config/connbilling.php';
	require './templates/'.$templates.'/header.html';

	if (isset($_SESSION['username'])){
		header('Location: /?p=panel');
	}
	
	if (@$_POST){
	
		$username = mysql_escape_string($_POST['username']);
		$password = mysql_escape_string($_POST['password']);
		$result = mysql_query("select * from account where username = '".$username."' and passwd =password('".$password."') ");
		$num_rows = mysql_num_rows($result);
		$row = mysql_fetch_assoc($result);

		if($num_rows >0){
			
			if($row['lock'] == 0){
				$_SESSION['username'] = $username;
				header('Location: /?p=panel');
			}else{
				echo "<script>alert('您的賬號已被封鎖！');history.back();</script>";
			}
			
		}else{
			echo "<script>alert('賬號或密碼錯誤！');history.back();</script>";
		}
	}
	
	
	if(strstr($_SERVER["HTTP_USER_AGENT"], "MSIE")){
		exit('请使用Google Chrome或FireFox浏览本网页！');
	}
	require './templates/'.$templates.'/login.html';
?>