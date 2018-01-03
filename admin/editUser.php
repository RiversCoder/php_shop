<?php
	require_once '../include.php';

	$id = $_REQUEST['id'];
	$rowsData = getUserDataById($id);
	$rowsData = $rowsData[0];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
	<h3>修改用户</h3>
	<form action="doAdminAction.php?act=editUser&id=<?php echo $id;?>" method="post" enctype="multipart/form-data">
		<table width="70%" border='1' cellpadding="5" cellspacing="0" bgcolor="#ccc">
			<tr>
				<td align="center">用户名称 :</td>
				<td align="center"><input type="text" name="username" value="<?php echo $rowsData['username']; ?>" /></td>
			</tr>
			<tr>
				<td align="center">用户密码 :</td>
				<td align="center"><input type="password" name="password"  /></td>
			</tr>
			<tr>
				<td align="center">用户性别 :</td>
				<td align="center">
					<div class="input_item">
						<input type="radio"  <?php echo $rowsData['sex']=='男' ? 'checked' : '';  ?> name="sex" value="1"> 男
						<input type="radio" <?php echo $rowsData['sex']=='女' ? 'checked' : '';  ?> name="sex" value="2" > 女
						<input type="radio"  <?php echo $rowsData['sex']=='保密' ? 'checked' : '';  ?> name="sex" value="3" > 保密
					</div>
				</td>
			</tr>
			<tr>
				<td align="center">用户邮箱 :</td>
				<td align="center"><input type="email" name="email" value="<?php echo $rowsData['email']; ?>" /></td>
			</tr>
			<tr>
				<td align="center">用户头像 :</td>
				<td align="center">
				<input type="file" name="Fileface" />
				<?php if($rowsData['face']): ?>
					<img src='../uploads/<?php echo $rowsData["face"]; ?>' width='50' height='50'/>
				<?php endif; ?>	
				</td>
			</tr>
			<tr>
				<td align="center" colspan="2"><input type="submit" value="修改用户" /></td>
			</tr>
		</table>
	</form>
</body>
</html>