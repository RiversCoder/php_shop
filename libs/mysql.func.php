<?php

	/*
		func : 连接数据库
		return : resource
	*/

	function connect(){

		$link = mysqli_connect(DB_HOST,DB_USER,DB_PWD,DB_DBNAME);//连接数据库
		mysqli_set_charset($link,DB_CHARSET);//设置数据库字体格式
		//mysqli_select_db($link,) or die('数据库打开失败');//选择数据库

		if(mysqli_connect_errno())
		{
			die('数据库连接失败 : '.mysqli_connect_errno());
		}

		return $link;
	}

	/*
		func : 数据表插入(insert into) 
		return : bool
		$link : 数据库连接资源句柄 
		$table : (string)数据表
		$array : (string)insert语句
	*/

	function insert($link,$table,$array){
		$keys = join(',',array_keys($array));
		$values = "'".join("','",array_values($array))."'";
		$sql = "insert into {$table}({$keys}) values({$values})";

		mysqli_query($link,$sql);

		return mysqli_insert_id($link);
	}	


	/*
		func : 数据表修改(update) 
		$link : 数据库连接资源句柄 
		$table : (string)数据表
		$array : (string)update数组格式化语句
		$where : (string)where条件语句
		return : 函数返回前一次 MySQL 操作（SELECT、INSERT、UPDATE、REPLACE、DELETE）所影响的记录行数(>0,0,-1)
	*/

	// 格式 ： update 表名 set 键名 = 键值 wheare 条件
	function update($link,$table,$array,$where = null)
	{	
		$setstr = '';
		foreach ($array as $key => $value) {

			//$setstr .= (' '.$key.'='.$value.' ');

			if(!$setstr){
				$sep = '';
			}else{
				$sep = ',';
			}

			$setstr .= $sep.$key.'='."'".$value."'";
		}

		$sql = "update {$table} set {$setstr}".($where ? 'where '.$where : '');

		mysqli_query($link,$sql);

		//mysqli_affected_rows() 

		return mysqli_affected_rows($link);
	}

	/*
		func : 删除数据表（行）
		$link : 数据库连接资源句柄 
		$table : (string)数据表
		$where : (string)where条件语句
		return : 函数返回前一次 MySQL 操作（SELECT、INSERT、UPDATE、REPLACE、DELETE）所影响的记录行数(>0,0,-1)
	*/
	function delete($link,$table,$where = null)
	{
		$sql = "delete from {$table} ".($where ? 'where '.$where : '');

		
		mysqli_query($link,$sql);

		return mysqli_affected_rows($link); 
	}

	/*
		func : 查找一条记录
		$link : 数据库连接资源句柄
		$sql : (string)select语句

	*/	

	function fetchOne($link,$sql,$result_type=MYSQLI_ASSOC)
	{
		$result = mysqli_query($link,$sql);

		$row = mysqli_fetch_array($result,$result_type);

		return $row;
	}	


	/*
		func : 查找所有记录
		$link : 数据库连接资源句柄
		$sql : (string)select语句
	*/		

	function fetchAll($link,$sql,$result_type=MYSQLI_ASSOC)
	{
		$result = mysqli_query($link,$sql);
		$rows = array();

		while($row = mysqli_fetch_array($result,$result_type))
		{
			$rows[] = $row;
		}
		
		return $rows;
	}	


	/*	
		func : 返回结果集中行的数量
	*/

	function getResultNum($link,$sql)
	{
		$result = mysqli_query($link,$sql);

		return mysqli_num_rows($result);
	}


	function closeSql($link){
		mysqli_close($link);
	}

	/*
		获取上一步插入数据的ID值
	*/
	function getInsertId($link)
	{
		return mysqli_insert_id($link);
	}	