<?php
	include'connectsql.php';
	$val=$_POST['value'];
	$sql="delete from essay where eid='$val'";
	$re=$db->query($sql);
	if($re){
		echo"删除成功";
	}else{
		echo"shibai";
	}
?>