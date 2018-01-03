<?php
	
	//删除记录
	function delUser($id)
	{
		$link = connect();
		$table = 'imooc_user';
		$where = 'id='.$id;
		$mes = '';

		if(!!delete($link,$table,$where))
		{
			$mes = '删除成功！| <a href="listUser.php">回到列表</a>'; 
		}
		else
		{
			$mes = '删除失败！| <a href="listUser.php">回到列表</a>'; 
		}

		return $mes;
	}


	//注册
	function register()
	{	
		date_default_timezone_set('Asia/Shanghai'); 
		$link = connect();
		$array = $_POST;
		$mes = '';
		$array['password'] = md5($array['password']);
		$array['regTime'] = time();

		//接受处理上传文件
		$uploadFiles = uploadFile('./uploads');
		$uploadFiles = $uploadFiles[0];
		$array['face'] = $uploadFiles['name'];
		
		//插入数据库数据
		if(!!insert($link,'imooc_user',$array))
		{
			$mes = '注册成功<br/><a href="./admin/main.php">进入后台</a>';
		}
		else
		{
			$mes = '注册失败<br/><a href="reg.php">重新注册</a>';
		}
		
		return $mes;
	}

	//添加用户
	function addUser()
	{	
		date_default_timezone_set('Asia/Shanghai'); 
		$link = connect();
		$array = $_POST;
		$mes = '';
		$array['password'] = md5($array['password']);
		$array['regTime'] = time();

		//接受处理上传文件
		$uploadFiles = uploadFile('../uploads');
		$uploadFiles = $uploadFiles[0];
		$array['face'] = $uploadFiles['name'];
		
		//插入数据库数据
		if(!!insert($link,'imooc_user',$array))
		{
			$mes = '添加成功<br/><a href="addUser.php">继续添加</a><br/><a href="listUser.php">查看用户列表</a>';
		}
		else
		{
			$mes = '添加失败<br/><a href="addUser.php">重新添加</a>';
		}
		
		return $mes;
	}


	//获取用户数据
	function listUserData()
	{
		$link = connect();
		$sql = 'select id,username,sex,face,email,regTime from imooc_user';

		if($arr = fetchAll($link,$sql))
		{
			return $arr;
		}
	}

	//通过id获取用户数据
	function getUserDataById($id)
	{
		$link = connect();
		$sql = "select * from imooc_user where id = {$id}";


		if($arr = fetchAll($link,$sql))
		{
			return $arr;
		}
	}

	//提交新的用户数据 >> 修改用户数据
	function editUser($id)
	{	

		$link = connect();
		$table = 'imooc_user';
		$array = $_POST;
		$mes = '';
		$array['regTime'] = time();
		$where = 'id='.$id;

		//处理密码问题
		if(!$array['password'])
		{
			unset($array['password']);
		}
		else
		{
			$array['password'] = md5($array['password']);
		}

		//接受处理上传文件
		$uploadFiles = uploadFile('../uploads');
		if(is_array($uploadFiles) && !!$uploadFiles)
		{	
			$uploadFiles = $uploadFiles[0];
			$array['face'] = $uploadFiles['name'];
		}	
		
		print_r($array);

		if(!!update($link,$table,$array,$where))
		{
			$mes = '修改成功!<br/><a href="listUser.php">查看用户列表</a>';
		}
		else
		{
			$mes = '修改失败!<br/><a href="editUser.php?id='.$id.'">继续修改</a><br/><a href="listuser.php">查看用户列表</a>';
		}

		return $mes;
	}	
?>