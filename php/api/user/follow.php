<?php
	header("content-type:text/html;charset=utf-8");

    error_reporting(E_ALL || ~E_NOTICE);
    include'../../common/connectsql.php';
    include'../../common/resp.php';
    // var_dump($sql);
    $type = $_GET['type'];
    $toid = $_GET['uid'];
    session_start();
    $uid = $_SESSION['uid'];
    
    $sql = "";
    if ($type == "follow") {
        $sql = $sql."insert into user_follow (follower_id, follow_to_id, follow_time) values ($uid, $toid, now())";
    } else {
        $sql = $sql."delete from user_follow where follower_id = $uid and follow_to_id = $toid ";
    }

    $db->query($sql);
    $resp->result = 0;
    echo json_encode($resp, JSON_UNESCAPED_UNICODE);
?>