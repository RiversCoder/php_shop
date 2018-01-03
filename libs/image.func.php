<?php

require_once 'string.func.php';


function verifyImage($type = 3,$length = 4,$sess_name = 'verify')
{	
	

	$width = 80;
	$height = 30;
	//创建图片
	$image = imagecreatetruecolor($width, $height);

	//创建颜色
	$white = imagecolorallocate($image, 255, 255, 255);
	$black = imagecolorallocate($image, 0, 0, 0);

	//填充矩形填充画布
	imagefilledrectangle($image, 1, 1, $width-2, $height-2, $white);

	$chars = buildRandomString($type,$length);
	
	$_SESSION[$sess_name] = $chars;

	//定义字体文件
	$fontf = array('msyh.ttf','msyhbd.ttf','SIMLI.TTF','simsun.ttc','SIMYOU.TTF');

	//绘制验证码
	for($i=0;$i<$length;$i++)
	{
		$color = imagecolorallocate($image, mt_rand(0,50), mt_rand(0,100), mt_rand(0,200));
		$size = mt_rand(12,14);
		$angle = mt_rand(-15,15);
		$x = 5 + $i*$size;
		$y = mt_rand(20,26);
		$fontfile = '../fonts/'.$fontf[mt_rand(0,count($fontf)-1)];
		$text = substr($chars,$i,1);
		imagettftext($image, $size, $angle, $x, $y, $color, $fontfile, $text);
	}

	//画点
	$pixel = true;
	if($pixel)
	{
		for($i=0;$i<50;$i++)
		{	
			$x = mt_rand(0,$width);
			$y = mt_rand(0,$height);
			$color = imagecolorallocate($image, mt_rand(200,255), mt_rand(200,255), mt_rand(200,255));
			imagesetpixel($image, $x, $y, $black);
		}
	}


	//画线
	$line = true;
	if($line)
	{
		for($i=0;$i<$length;$i++)
		{	
			$color = imagecolorallocate($image, mt_rand(0,255), mt_rand(0,255), mt_rand(0,255));
			$x1 = mt_rand(0,$width);
			$y1 = mt_rand(0,$height);
			$x2 = mt_rand(0,$width);
			$y2 = mt_rand(0,$height);
			imageline($image, $x1, $y1, $x2, $y2, $color);
		}
	}


	ob_clean(); 

	//输出图片
	header('Content-type:image/png');
	imagepng($image);
	imagedestroy($image);
}



