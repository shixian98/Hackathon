 <?php 
 
	include './config/connbilling.php';

	if (isset($_SESSION['username'])){
		header('Location: /?p=panel');
	}
	
	if (@$_POST['submit']){
	
		$username = str_check($_POST['username']);
		$pincode = str_check($_POST['pincode']);
		$newpassword = $_POST['newpassword'];
		$confirmpw = $_POST['confirmpw'];
		$result = mysql_query("select * from account where username = '".$username."' and pincode =password('".$pincode."') ");
		$num_rows = mysql_num_rows($result);

		if($num_rows >0){
			if($newpassword != $confirmpw ){
				echo "<script>alert('密碼兩次輸入不一致！');history.back();</script>";
			}else if(($newpassword)==null){
				echo "<script>alert('密碼不能為空！');history.back();</script>";
			}else if(strlen($newpassword) < 8 or strlen($newpassword) > 16){
				echo "<script>alert('密码长度为8-16位');history.back();</script>";
			}else{
				$sql="update account set passwd =password('".$newpassword."') where username = '".$username."'";
				$result=mysql_query($sql);
				if($result){
					echo "<script>alert('修改密碼成功！');location.href='/';</script>";
				}else{
					echo "<script>alert('操作失敗！');history.back();</script>";
				}
			}
 
		}else{
			echo "<script>alert('賬號或安全碼錯誤！');history.back();</script>";
		}
	}
	require './templates/'.$templates.'/header.html';
	if(strstr($_SERVER["HTTP_USER_AGENT"], "MSIE")){
		exit('请使用Google Chrome或FireFox浏览本网页！');
	}
	require './templates/'.$templates.'/menu.html';
	require './templates/'.$templates.'/forgotPw.html';
	require './templates/'.$templates.'/footer.html';
?>