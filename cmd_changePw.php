 <?php 
 
	include './config/connbilling.php';
	
	if (@$_POST){
	
		$username = mysql_escape_string($_POST['username']);
		$password = mysql_escape_string($_POST['nowpassword']);
		$pincode = mysql_escape_string($_POST['pincode']);
		$newpassword = mysql_escape_string($_POST['newpassword']);
		$newconfirmpw = mysql_escape_string($_POST['newconfirmpw']);
		$result = mysql_query("select * from account where username = '".$username."' and passwd =password('".$password."') and pincode =password('".$pincode."')");
		$num_rows = mysql_num_rows($result);

		if($num_rows >0){
			if($newpassword != $newconfirmpw ){
				echo "1|0";
				exit;
			}else if(($newpassword)==null){
				echo "1|1|0";
				exit;
			}else if(strlen($newpassword) < 8 or strlen($newpassword) > 16){
				echo "1|1|1|0";
				exit;
			}else{
				$sql="update account set passwd =password('".$newpassword."') where username = '".$username."'";
				$result=mysql_query($sql);
				if($result){
					echo "1|1|1|1|1";
					exit;
				}else{
					echo "1|1|1|1|0";
					exit;
				}
			}
 
		}else{
			echo "0";
			exit;
		}
	}

	if(strstr($_SERVER["HTTP_USER_AGENT"], "MSIE")){
		exit('请使用Google Chrome或FireFox浏览本网页！');
	}
?>