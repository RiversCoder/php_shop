<?php
	
	require_once '../include.php';

	$rowsData = listAlbumData();

	if(!$rowsData)
	{
		alertMes('当前没有商品信息,请先添加！','addPro.php');
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
                    <th>编号</th>
                    <th>商品名称</th>
                    <th>商品图片</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
            	<?php foreach($rowsData as $k): ?>
					<tr>
						<td align="center"><?php echo $k['id']; ?></td>
						<td align="center" ><?php echo $k['pname']; ?></td>
						<td align="center"><?php echo $k['pImg']; ?></td>
						<td data-id='<?php echo $k["id"]; ?>'><input type="button" value="添加文字水印" class="btn btn_edit"  /><input type="button" value="添加图片水印" class="btn btn_remove" /></td>
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
			location.href='addUser.php';
		}

		for(var i=0;i<editBtns.length;i++)
		{
			editBtns[i].onclick = function()
			{
				location.href = 'editUser.php?id='+this.parentNode.dataset.id;
			}

			removeBtns[i].onclick = function()
			{	
				if(confirm('您确定要删除吗?'))
				{
					location.href = 'doAdminAction.php?act=delUser&id='+this.parentNode.dataset.id;
				}
				
			}

		}

	})();
</script>
</html>