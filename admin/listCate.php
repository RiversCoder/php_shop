<?php
	
	require_once '../include.php';

	$rowsData = listCateData();

	if(!$rowsData)
	{
		alertMes('当前没有分类信息,请先添加！','addCate.php');
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
	            <input type="button" value="添&nbsp;&nbsp;加" class="add btn_add"  onclick="addCate()" style="cursor:pointer;" />
	        </div>
	            
	    </div>
	    <!--表格-->
	    <table class="table" cellspacing="0" cellpadding="0">
	        <thead>
	            <tr>
	                <th width="25%">编号</th>
	                <th width="35%">分类名称</th>
	              
	                <th>操作</th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php foreach($rowsData as $k): ?>
					<tr>
						<td width="25%" align="center"><?php echo $k['id']; ?></td>
						<td width="35%" align="center" ><?php echo $k['cName']; ?></td>
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
			location.href='addCate.php';
		}

		for(var i=0;i<editBtns.length;i++)
		{
			editBtns[i].onclick = function()
			{
				location.href = 'editCate.php?id='+this.parentNode.dataset.id;
			}

			removeBtns[i].onclick = function()
			{	
				if(confirm('您确定要删除吗?'))
				{
					location.href = 'doAdminAction.php?act=delCate&id='+this.parentNode.dataset.id;
				}
				
			}

		}

	})();
</script>
</html>