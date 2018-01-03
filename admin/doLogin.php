<?php
	
	require_once '../include.php';

	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$verify = $_POST['verify'];
	$verify_s = $_SESSION['verify'];
	@$autoLogin = $_POST['autoLogin'];

	
	//1. 匹配验证码
	if(strtolower($verify) == strtolower($verify_s)){
		
		$sql = "select * from imooc_admin where username = '{$username}' and password = '{$password}'";

		//2. 匹配用户名和密码
		$con= connect();
		$res = checkAdmin($con,$sql);
		
		//匹配成功
		if(!!$res)
		{
			$_SESSION['adminName'] = $res['username'];
			$_SESSION['adminId'] = $res['id'];

			//如果选择了一周内自动登录
			if(!empty($autoLogin)){
				setcookie('adminId',$res['id'],time()+7*24*3600);
				setcookie('adminName',$res['username'],time()+7*24*3600);
			}

			//echo $_SESSION['adminName'];
			alertMes('登陆成功','main.php');
		}
		else
		{
			alertMes('登陆失败','login.php');
		}
	}
	else{
		
		alertMes('验证码错误','login.php');
	}
	