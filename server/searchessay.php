<?php
	header('content-type:text/html;charset=utf-8');
	include'connectsql.php';
	$title=$_POST['title'];
	$writer=$_POST['writer'];
	$label=$_POST['label'];
	$sql="select user.nickname,essay.eid,essay.writetime,essay.title,topic.title as label from topic,essay,user where topic.tid=essay.tid and essay.uid=user.uid ";	
	if(empty($title)==false){
		$sql=$sql."and essay.title='$title'";
	}
	if(empty($writer)==false){
		$sql=$sql."and user.nickname='$writer' ";

	}
	if(empty($label)==false){
		$sql=$sql."and topic.title='$label'";

	}
	$re=$db->query($sql);
	$rows=$re->num_rows;
	if($rows!=0){
		while($obj=$re->fetch_object()){
			$arr[]=$obj->label.",".$obj->title.",".$obj->nickname.",".$obj->writetime.",".$obj->eid;
		}
	}
	else{
		$arr[]="";
	}
	echo json_encode($arr);
//echo $sql;
?>