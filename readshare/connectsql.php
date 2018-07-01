<?php
	header("content-type:text/html;charset=utf-8");
	$db =@new mysqli('localhost','root','123','writeshare');
	if($db->connect_error){
		echo"连接错误：".$db->connect_error;
	}
	$db->query("set names utf8");
?>