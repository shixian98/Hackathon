<?php 
	include './config/connbilling.php';
	require './templates/'.$templates.'/header.html';
	
	if (isset($_SESSION['username'])){
		header('Location: /?p=panel');
	}
	
	if ($_POST){
	
		$username = mysql_escape_string($_POST['username']);
		$password = mysql_escape_string($_POST['password']);
		$confirmpw = mysql_escape_string($_POST['confirmpw']);
		$pincode = mysql_escape_string($_POST['pincode']);
		$regip = $_SERVER["REMOTE_ADDR"];
		
		if(($username)==null or ($confirmpw)==null or ($password)==null or ($pincode)==null){
			exit;
		}
		
		$result = mysql_query("select * from account where regip = '".$regip."' and CreateTime > date_sub(now(), interval 1 hour)");
		$data_rows = mysql_num_rows($result);
		
		if($data_rows >9){
			echo "0";
			exit;
		}
		
		$result = mysql_query("select * from account where username = '".$username."'");
		$num_rows = mysql_num_rows($result);

		if($num_rows <1){
			if(strlen($password) < 8 or strlen($password) > 16){
				echo "<script>alert('密碼长度限于8-16');history.back();</script>";
				exit;
			}else if($confirmpw != $password){
				echo "<script>alert('兩次密碼不一致');history.back();</script>";
				exit;
			}else if(strlen($pincode) < 6 or strlen($pincode) > 10){
				echo "<script>alert('安全碼长度限于6-10');history.back();</script>";
				exit;
			}else{
				$sql="insert account (CreateTime,username,passwd,pincode,regip)values(now(),'".$username."',password('".$confirmpw."'),password('".$pincode."'),'".$regip."')";
				$result=mysql_query($sql);
				
				if($result){
					$_SESSION['username'] = $username;
					echo "<script>alert('註冊成功！');ocation.href='/?p=panel';</script>";
					exit;
				}else{
					echo "<script>alert('註冊失敗！');history.back();</script>";
					exit;
				}
			}
		}else{
			echo "<script>alert('賬號已被使用！');history.back();</script>";
			exit;
		}
	}
	
	if(strstr($_SERVER["HTTP_USER_AGENT"], "MSIE")){
		exit('请使用Google Chrome或FireFox浏览本网页！');
	}
	require './templates/'.$templates.'/register.html';
?>