<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<h3>添加分类</h3>
	<form action="doAdminAction.php?act=addCate" method="post">
		<table width="70%" border='1' cellpadding="5" cellspacing="0" bgcolor="#ccc">
			<tr>
				<td align="center">分类名称 :</td>
				<td align="center"><input type="text" name="cName" placeholder="请输入分类名称" /></td>
			</tr>
			
			<tr>
				<td align="center" colspan="2"><input type="submit" value="添加分类" /></td>
			</tr>
		</table>
	</form>
</body>
</html>