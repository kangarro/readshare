<?php
	header('content-type:text/html;charset=utf-8');
	include'connectsql.php';
	$aid=$_COOKIE["aid"];
	$oldpass=$_POST['oldpass'];
	$newpass=$_POST['newpass'];
	$sql="select * from admin where apass='$oldpass' and aid=$aid";
	$re=$db->query($sql);
	$rows=$re->num_rows;
	if($rows!=0){
		$sql="update admin set apass='$newpass' where aid=$aid";
		$re=$db->query($sql);
		if($re){
			echo"成功修改";
		}
	}
	else{
		echo"修改失败";
	}
?>