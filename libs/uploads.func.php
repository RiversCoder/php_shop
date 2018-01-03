<?php
	
	require_once 'string.func.php';

	//print_r($_FILES);

/*	$filename = $_FILES['myFile']['name'];
	$type = $_FILES['myFile']['type'];
	$tmp_name = $_FILES['myFile']['tmp_name'];
	$error = $_FILES['myFile']['error'];
	$size = $_FILES['myFile']['size'];*/
	

function buildInfo($files)
{	
	//$my_file = $files['myFile'];
	$arr_item = array();
	$arr_All = array();
	$num = 0;

	foreach($files as $my_file)
	{
		//单文件
		if(is_string($my_file['name']))
		{	
			$arr_All[$num] = $my_file;
			$num++;
		}
		else
		{
			for($j=0;$j<count($my_file['name']);$j++)
			{	
				$arr_item = [];

				foreach($my_file as $key => $my_item)
				{	
					$arr_item[$key]  = $my_item[$j];
				}

				$arr_All[$num++] = $arr_item;
			}
		}
	}


	return $arr_All;
}




function uploadFile($path='uploads',$allowExt = array('gif','jpg','jpeg','png','wbmp','txt'),$maxsize = 1048570006,$imgFlag = true)
{	

	$i = 0;
	$uploadedFiles = array();

	//生成文件夹
	if(!file_exists($path))
	{
		mkdir($path,0777,true);
	}

	$files = buildInfo($_FILES);

	foreach($files as $fileInfo)
	{
		//判断上传错误信息
		if($fileInfo['error'] == UPLOAD_ERR_OK)
		{	
			
			$ext = getExt($fileInfo['name']);  //获取扩展名
			$filename = getUniName().'.'.$ext;  //获取随机文件名
			$destination = $path.'/'.$filename; //生成文件路径

			//判断是否为图片(非法文件类型)
			if(!in_array($ext,$allowExt))
			{
				exit('该文件不是图片 : 非法文件类型');
			}

			if($fileInfo['size'] > $maxsize)
			{
				exit('文件过大');
			}
			
			//检测是否为图片
			if($imgFlag)
			{
				//如何验证图片是否是一个真正的图片类型
				if(!getimagesize($fileInfo['tmp_name']))
				{
					exit('不是合法文件');
				}
			}

			//在指定文件夹下生成文件
			if(!is_uploaded_file($fileInfo['tmp_name']))
			{
				exit('文件不是通过HTTP_POST文件上传的');
			}
			else
			{	
				//判断文件是否是通过HTTP_POST上传上来的
				if(move_uploaded_file($fileInfo['tmp_name'],$destination))
				{
					$fileInfo['name'] = $filename;
					unset($fileInfo['tmp_name'],$fileInfo['error']);
					$uploadedFiles[$i] = $fileInfo;

					$i++;

					$mes = '文件上传成功';
				}
				else
				{
					$mes = '文件上传失败';
				}
			}
		}
		else
		{
			switch($fileInfo['error'])
			{
				case UPLOAD_ERR_INI_SIZE :
					$mes = '上传文件大小超过服务器允许上传的最大值';
				break;

				case UPLOAD_ERR_NO_TMP_DIR :
					$mes = '没有找不到临时文件夹';
				break;

				case UPLOAD_ERR_CANT_WRITE :
					$mes = '文件不可写';
				break;

				case UPLOAD_ERR_FORM_SIZE :
					$mes = '上传文件大小超过隐藏表单设置允许上传的最大值MAX_FILE_SIZE';
				break;

				case UPLOAD_ERR_EXTENSION :
					$mes = '文件上传扩展没有打开';
				break;

				case UPLOAD_ERR_PARTIAL :
					$mes = '文件只有部分被上传';
				break;
			}
		}
	}

	return $uploadedFiles;
}



//缩略图
function thumb($filename,$destination=null,$dst_w=null,$dst_h=null,$scale=0.5)
{
	list($src_w,$src_h,$imageTypeNum) = getimagesize($filename);
	$scale = 0.5;

	if( is_null($dst_w) || is_null($dst_h) )
	{
		$dst_w = ceil($src_w * $scale);
		$dst_h = ceil($src_h * $scale);
	}

	$mime = image_type_to_mime_type($imageTypeNum);
	$createFun = str_replace('/', 'createfrom', $mime);
	$outFun = str_replace('/',null,$mime);

	$src_image = $createFun($filename);
	$dst_image = imagecreatetruecolor($dst_w,$dst_h);

	imagecopyresampled($dst_image, $src_image,0,0,0,0,$dst_w, $dst_h,$src_w,$src_h);

	if($destination&&!file_exists(dirname($destination)))
	{	
		mkdir(dirname($destination),0777,true);
	}


	//要生成的新的图片的路径
	$imageName = dirname($destination).DIRECTORY_SEPARATOR.getUniName().'.'.getExt($filename);
	$outFun($dst_image,$imageName);
	
	//销毁图片资源
	imagedestroy($dst_image);
	imagedestroy($src_image);

	return $imageName;
}

?>