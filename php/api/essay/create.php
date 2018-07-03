<?php
	header("content-type:text/html;charset=utf-8");
    include'../../common/connectsql.php';
    include'../../common/resp.php';

	$tid = $_POST['tid'];
	$title = $_POST['title'];
	$content = $_POST['content'];
	session_start();
	$uid = $_SESSION['uid'];
	$sql = "insert into essay(title, content, tid, uid, writetime) values('$title', '$content', $tid, $uid, now())";
	$resp = new Resp();
	$db->query($sql);
	$resp->result = 0;
	$sql = "select max(eid) as eid from essay";
	$result = $db->query($sql)->fetch_object()->eid;
	$resp->data = $result;
	echo json_encode($resp, JSON_UNESCAPED_UNICODE);
?>