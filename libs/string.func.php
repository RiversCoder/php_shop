<?php

//随机字符串方法

function buildRandomString($type = 3,$length = 4){

	if($type == 1)
	{
		$char = join('',range(0,9));
	}
	else if($type == 2)
	{
		$char = join('',array_merge(range('a','z'),range("A","Z")));
	}
	else if($type == 3)
	{
		$char = join('',array_merge(range(0,9),range('a','z'),range("A","Z")));
	}

	if($length > strlen($char)){
		exit('字符串长度不够!');
	}

	$char = str_shuffle($char);
	
	return substr($char,0,$length);
}



	/*
		获取随机唯一字符串
		参数：
		返回值：string 文件后缀名
	*/

	function getUniName()
	{
		return md5(uniqid(microtime(true),true));
	}



	/*
		获取后缀
		参数：string 文件名
		返回值：string 文件后缀名
	*/

	function getExt($filename)
	{
		$array = explode(".",$filename);
		return strtolower(end($array));
	}



