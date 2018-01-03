<?php
	
	include '../include.php';
	$act = $_REQUEST['act'];
	$mes = '';

	switch ($act) 
	{
		case 'logout': logout(); break;
		//管理员信息管理
		case 'addAdmin': $mes = addAdmin(); break;
		case 'editAdmin': $mes = editAdmin($_REQUEST['id']); break;
		case 'delAdmin': $mes = delAdmin($_REQUEST['id']); break;
		//分类信息管理
		case 'addCate' : $mes = addCate(); break;
		case 'editCate' : $mes = editCate($_REQUEST['id']); break;
		case 'delCate' : $mes = delCate($_REQUEST['id']); break;
		//商品信息管理
		case 'addPro' : $mes = addPro(); break;

		//用户信息管理
		case 'addUser' : $mes = addUser(); break;
		case 'editUser' : $mes = editUser($_REQUEST['id']); break;
		case 'delUser' : $mes = delUser($_REQUEST['id']); break;
	}	

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<?php
		if($mes){
			echo $mes;
		}
	?>
</body>
</html>