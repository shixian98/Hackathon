 <?php 
 
	include './config/connbilling.php';
	
	if (@$_POST){
	
		$username = mysql_escape_string($_POST['username']);
		$password = mysql_escape_string($_POST['password']);

		$result = mysql_query("select * from account where username = '".$username."' and passwd =password('".$password."')");
		$num_rows = mysql_num_rows($result);

		if($num_rows >0){
			$result = mysql_query("select SUM(value) from web_log where receiver = '".$username."' and action ='topup'");
			$row = mysql_fetch_assoc($result);
			$TOPUP = $row['SUM(value)'];
			
			$result2 = mysql_query("select * from account where username = '".$username."'");
			$row2 = mysql_fetch_assoc($result2);
			$VIP = $row2['vip'];
			$GM = $row2['gm'];
			$LoginCF = $row2['MemberID'];
			
			if(($GM) > 0){
				echo "1|1|108XXClientServer-VV-11\svip-line.dso";
			}elseif(($VIP) > 0){
				echo "1|1|108XXClientServer-VV-11\svip-line.dso";
			}elseif(($TOPUP) > 0){
				echo "1|1|108XXClientServer-VV-11\svip-line.dso";
			}elseif(($LoginCF) > 0){
				echo "1|1|108XXClientServer-VV-11\svip-line.dso";
			}else{
				echo "1|0";
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