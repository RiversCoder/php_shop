<?php
	//添加商品信息
	function addPro()
	{
		$arr = $_POST;
		$arr['pubTime'] = time();
		$uploadFiles = uploadFile('../image_800');

		//判断单文件、多文件
		if(is_array($uploadFiles) && $uploadFiles){
			foreach($uploadFiles as $key=>$uploadFile){
				thumb('../image_800'.$uploadFile['name'],'../image_50'.$uploadFile['name'],50,50);
				thumb('../image_800'.$uploadFile['name'],'../image_220'.$uploadFile['name'],220,220);
				thumb('../image_800'.$uploadFile['name'],'../image_350'.$uploadFile['name'],350,350);
			}
		}

		//向数据库插入信息 得到ID
		$link = connect();
		$res = insert($link,'imooc_pro',$arr);
		$pid = getInsertId($link);
		$arr_1 = array();

		if($res && $pid) //插入成功
		{
			foreach ($uploadFiles as $key=>$uploadFile) {
				$arr_1['pid'] = $pid;
				$arr_1['albumPath'] = $uploadFile['name'];
				addAlbum($arr_1); 
			}
		}
		else
		{

		}

	}
?>