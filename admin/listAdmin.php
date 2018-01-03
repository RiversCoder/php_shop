<?php
	
	require_once '../include.php';

	$rowsData = listAdminData();

	if(!$rowsData)
	{
		alertMes('当前没有用户信息,请先添加！','addAdmin.php');
	}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>-.-</title>
<link rel="stylesheet" href="styles/backstage.css">
</head>

<body>
<div class="details">
                    <div class="details_operation clearfix">
                        <div class="bui_select">
                            <input type="button" value="添&nbsp;&nbsp;加" class="add btn_add"  onclick="addAdmin()" style="cursor:pointer;" />
                        </div>
                            
                    </div>
                    <!--表格-->
                    <table class="table" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th width="15%">编号</th>
                                <th width="25%">管理员名称</th>
                                <th width="30%">管理员邮箱</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php foreach($rowsData as $k): ?>
								<tr>
									<td width="15%" align="center"><?php echo $k['id']; ?></td>
									<td width="25%" align="center" ><?php echo $k['username']; ?></td>
									<td width="35%" align="center"><?php echo $k['email']; ?></td>
									<td data-id='<?php echo $k["id"]; ?>'><input type="button" value="修改" class="btn btn_edit"  /><input type="button" value="删除" class="btn btn_remove" /></td>
								</tr>
                    	    <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
</body>
<script type="text/javascript">
	(function(){

		var addBtn = document.querySelector('.btn_add');
		var editBtns = document.querySelectorAll('.btn_edit');
		var removeBtns = document.querySelectorAll('.btn_remove');

		addBtn.onclick = function()
		{
			location.href='addAdmin.php';
		}

		for(var i=0;i<editBtns.length;i++)
		{
			editBtns[i].onclick = function()
			{
				location.href = 'editAdmin.php?id='+this.parentNode.dataset.id;
			}

			removeBtns[i].onclick = function()
			{	
				if(confirm('您确定要删除吗?'))
				{
					location.href = 'doAdminAction.php?act=delAdmin&id='+this.parentNode.dataset.id;
				}
				
			}

		}

	})();
</script>
</html>