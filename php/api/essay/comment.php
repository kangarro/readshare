<?php
	header("content-type:text/html;charset=utf-8");
    error_reporting(E_ALL || ~E_NOTICE);
    include'../../common/connectsql.php';
    include'../../common/resp.php';


    $eid = $_POST['eid'];
    $content = $_POST['content'];
    session_start();
    $uid = $_SESSION['uid'];
    $sql = "insert into comment (content, eid, uid, created) values('$content', $eid, $uid, now())";

    $db->query($sql);
    $resp = new Resp();
    $resp->result = 0;

    echo json_encode($resp, JSON_UNESCAPED_UNICODE);
?>