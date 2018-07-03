<?php
	header("content-type:text/html;charset=utf-8");
    error_reporting(E_ALL || ~E_NOTICE);
    include'../../common/connectsql.php';
    include'../../common/resp.php';

    $eid = $_GET['eid'];
    $sql = "update essay set agree = agree + 1 where eid = $eid";

    $db->query($sql);
    $resp = new Resp();
    $resp->result = 0;

    echo json_encode($resp, JSON_UNESCAPED_UNICODE);
?>