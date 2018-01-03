<?php

	//用户名密码匹配检测
	function checkAdmin($con,$sql){
		
		return fetchOne($con,$sql);
	}

	
	//检测是否非法后台进入
	function checkLogined()
	{	
		if(empty($_SESSION['adminId']) && empty($_COOKIE['adminId']))
		{
			alertMes('您还未登录，请登录','login.php');
		}
	}





	//退出后台 注销
	function logout()
	{
		//$_SESSION['adminId'] = '';
		//$_SESSION['adminName'] = '';
		$_SESSION = array();

		setcookie('adminId','',time()-1);
		setcookie('adminName','',time()-1);

		if(isset($_COOKIE[session_name()])){
			setcookie(session_name(),'',time()-1);
		}

		session_destroy();

		alertMes('退出成功','login.php');
	}


	//添加管理员
	function addAdmin()
	{
		$arr = $_POST;
		$link = connect();
		$arr['password'] = md5($arr['password']);

		if(!!insert($link,'imooc_admin',$arr)){

			$mes = '添加成功<br/><a href="addAdmin.php">继续添加</a><br/><a href="listAdmin.php">查看管理员</a>';
		}
		else
		{
			$mes = '添加失败<br/><a href="addAdmin.php">重新添加</a>';
		}

		return $mes;
	}


	//初始化管理员列表
	function listAdminData()
	{
		$link = connect();
		$sql = 'select * from imooc_admin';
		$arr = fetchAll($link,$sql,MYSQLI_ASSOC);

		return $arr;
	}	

	//编辑管理员列表 初始化数据
	function editListAdmin($id)
	{
		$link = connect();
		$sql = 'select * from imooc_admin where id = '.$id;
		$arr = fetchAll($link,$sql,MYSQLI_ASSOC);

		return $arr;
	}

	//提交新的管理员信息
	function editAdmin($id)
	{
		$link = connect();
		$arr = $_POST;
		$arr['password'] = md5($arr['password']);
		
		if(!!update($link,'imooc_admin',$arr,'id='.$id))
		{
			$mes = '修改成功!<br/><a href="listAdmin.php">查看管理员</a>';
		}
		else
		{
			$mes = '修改失败!<br/><a href="editAdmin.php?id='.$id.'">继续修改</a><br/><a href="listAdmin.php">查看管理员</a>';
		}

		return $mes;
	}


	//删除管理员
	function delAdmin($id)
	{
		$link = connect();

		if(!!delete($link,'imooc_admin','id='.$id))
		{
			$mes = '删除成功!<br/><a href="listAdmin.php">查看管理员</a>';
		}
		else
		{
			$mes = '删除失败!<br/><a href="doAdminAction.php?act=delAdmin&id="'.$id.'>再次删除</a>|<a href="listAdmin.php">查看管理员</a>';
		}

		return $mes;
	}


	//初始化分类列表
	function listCateData()
	{
		$link = connect();
		$sql = 'select * from imooc_cate';
		$arr = fetchAll($link,$sql,MYSQLI_ASSOC);

		return $arr;
	}

	//添加商品分类
	function addCate()
	{
		$arr = $_POST;
		$link = connect();

		if(!!insert($link,'imooc_cate',$arr)){

			$mes = '添加成功<br/><a href="addCate.php">继续添加</a><br/><a href="listCate.php">查看分类列表</a>';
		}
		else
		{
			$mes = '添加失败<br/><a href="addCate.php">重新添加</a>';
		}

		return $mes;
	}

	//编辑商品分类 处理
	function editListCate($id)
	{
		$link = connect();
		$sql = 'select * from imooc_cate where id = '.$id;
		$arr = fetchAll($link,$sql,MYSQLI_ASSOC);

		return $arr;
	}

	//提交新的分类信息
	function editCate($id)
	{
		$link = connect();
		$arr = $_POST;
		
		
		if(!!update($link,'imooc_cate',$arr,'id='.$id))
		{
			$mes = '修改成功!<br/><a href="listCate.php">查看分类信息</a>';
		}
		else
		{
			$mes = '修改失败!<br/><a href="editCate.php?id='.$id.'">继续修改</a><br/><a href="listCate.php">查看分类信息</a>';
		}

		return $mes;
	}

	//删除分类
	function delCate($id)
	{
		$link = connect();

		if(!!delete($link,'imooc_cate','id='.$id))
		{
			$mes = '删除成功!<br/><a href="listCate.php">查看分类列表</a>';
		}
		else
		{
			$mes = '删除失败!<br/><a href="doAdminAction.php?act=delCate&id="'.$id.'>再次删除</a>|<a href="listCate.php">查看分类列表</a>';
		}

		return $mes;
	}


	
?>