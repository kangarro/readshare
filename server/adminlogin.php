<?php
	header('content-type:text/html;charset=utf-8');
	include'connectsql.php';
	$admin=$_POST['admin'];
	$psw=$_POST['psw'];
	$sql="select * from admin where auser='$admin' and apass='$psw' ";
	$re=$db->query($sql);
	$rows=$re->num_rows;
	$obj=$re->fetch_object();
	if($rows!=0){
		setcookie("aid",$obj->aid);
		echo"成功";
	}else{
		echo"失败";
	}
?>