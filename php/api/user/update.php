<?php
    header("content-type:text/html;charset=utf-8");

    error_reporting(E_ALL || ~E_NOTICE);
    include'../../common/connectsql.php';
    include'../../common/resp.php';
    $resp = new Resp();
    session_start();
    $uid = $_SESSION['uid'];
    $type = $_POST['type'];
    $sql = "";
    if ($type == '1') {
        $nickname = $_POST['nickname'];
        $profile = $_POST['profile'];
        $sql = $sql."update user set nickname = '$nickname', user_profile = '$profile' where uid = $uid";
    } else {
        $password = $_POST['password'];
        $sql = $sql."update user set password = '$password' where uid = $uid";
    }
    $result = $db->query($sql);
    $resp->result = 0;
    echo json_encode($resp, JSON_UNESCAPED_UNICODE);
?>