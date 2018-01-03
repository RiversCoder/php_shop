<?php
	
	//弹出信息跳转页面
	function alertMes($mes,$url)
	{
		echo('<script>alert("'.$mes.'");</script>');
		echo('<script>location.href = "'.$url.'";</script>');
	}
?>