<?php
	
	require_once '../include.php';

	$arr = editListCate($_REQUEST['id'])[0];

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<h3>编辑分类</h3>
	<form action="doAdminAction.php?act=editCate&id=<?php echo $_REQUEST['id']; ?>" method="post">
		<table width="70%" border='1' cellpadding="5" cellspacing="0" bgcolor="#ccc">
			<tr>
				<td align="center">分类名称 :</td>
				<td align="center"><input type="text" name="cName" value="<?php echo $arr['cName']; ?>" /></td>
			</tr>
			<tr>
				<td align="center" colspan="2"><input type="submit" value="修改分类" /></td>
			</tr>
		</table>
	</form>
</body>
</html>