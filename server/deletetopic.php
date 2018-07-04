<?php
	include'connectsql.php';
	$tid=$_POST['tid'];
	$sql="delete from topic where tid='$tid'";
	$re=$db->query($sql);
	if($re){
		echo"删除成功";
	}else{
		echo"shibai";
	}
?>