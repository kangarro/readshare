<?php
	include'connectsql.php';
	$topic=$_POST['topic'];
	$sql="insert into topic(title) values('$topic')";
	$re=$db->query($sql);
	if($re){
		echo"插入成功";
	}else{
		echo"插入失败";
	}
?>