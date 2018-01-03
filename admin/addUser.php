<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<h3>添加用户</h3>
	<form action="doAdminAction.php?act=addUser" method="post" enctype="multipart/form-data">
		<table width="70%" border='1' cellpadding="5" cellspacing="0" bgcolor="#ccc">
			<tr>
				<td align="center">用户名称 :</td>
				<td align="center"><input type="text" name="username" placeholder="请输入用户名" /></td>
			</tr>
			<tr>
				<td align="center">用户密码 :</td>
				<td align="center"><input type="password" name="password"  /></td>
			</tr>
			<tr>
				<td align="center">用户性别 :</td>
				<td align="center">
					<div class="input_item">
						<input type="radio"  name="sex" value="1"> 男
						<input type="radio"  checked="checked" name="sex" value="2" > 女
						<input type="radio"  name="sex" value="3" > 保密
					</div>
				</td>
			</tr>
			<tr>
				<td align="center">用户邮箱 :</td>
				<td align="center"><input type="email" name="email" placeholder="请输入邮箱" /></td>
			</tr>
			<tr>
				<td align="center">用户头像 :</td>
				<td align="center"><input type="file" name="Fileface" /></td>
			</tr>
			<tr>
				<td align="center" colspan="2"><input type="submit" value="添加用户" /></td>
			</tr>
		</table>
	</form>
</body>
</html>