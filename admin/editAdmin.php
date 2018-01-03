<?php
	
	require_once '../include.php';

	$arr = editListAdmin($_REQUEST['id'])[0];

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<h3>编辑管理员</h3>
	<form action="doAdminAction.php?act=editAdmin&id=<?php echo $_REQUEST['id']; ?>" method="post">
		<table width="70%" border='1' cellpadding="5" cellspacing="0" bgcolor="#ccc">
			<tr>
				<td align="center">管理员名称 :</td>
				<td align="center"><input type="text" name="username" value="<?php echo $arr['username']; ?>" /></td>
			</tr>
			<tr>
				<td align="center">管理员密码 :</td>
				<td align="center"><input type="password" name="password"  /></td>
			</tr>
			<tr>
				<td align="center">管理员邮箱 :</td>
				<td align="center"><input type="text" name="email" value="<?php echo $arr['email']; ?>" /></td>
			</tr>
			<tr>
				<td align="center" colspan="2"><input type="submit" value="修改管理员" /></td>
			</tr>
		</table>
	</form>
</body>
</html>