<?php
	error_reporting(E_ALL || ~E_NOTICE);
	header("content-type:text/html;charset=utf-8");
	$db =@new mysqli('106.12.29.105','root','root','readshare');
	if($db->connect_error){
		echo"连接错误：".$db->connect_error;
	}
	$db->query("set names utf8");
?>