<?php

	//获取商品图片信息
	function listAlbumData()
	{	
		$link = connect();
		$sql = 'select ';

		$arr = fetchAll($link,$sql);
	}

?>