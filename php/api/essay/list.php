<?php
    header("content-type:text/html;charset=utf-8");
    error_reporting(E_ALL || ~E_NOTICE);
    include'../../common/connectsql.php';
    include'../../common/resp.php';
    include'../../common/PageData.php';
    $resp = new Resp();

    $sql = "select e.uid, 1 as commentCount, e.agree, t.title as topic , e.eid,e.title,e.content,u.nickname as writer,e.writetime from essay e ";
    $sql = $sql."LEFT JOIN user u ON e.uid = u.uid LEFT JOIN topic t ON t.tid = e.tid WHERE 1=1 ";
    $searchKey = $_GET['searchKey'];
    $isUid = $_GET['isUid'];
    if ($isUid == 'Y') {
        $uid = $_GET['uid'];
        if (!isset($uid)){
            session_start();
            $uid = $_SESSION['uid'];
        }
        $sql = $sql."AND u.uid = $uid ";
    }
    if (isset($searchKey)) {
         $sql = $sql."AND e.title like '%$searchKey%' or u.nickname like '%$searchKey%' ";
    }

    $tid = $_GET['tid'];
    if (isset($tid)) {
         $sql = $sql."AND e.tid = $tid ";
    }
    $pageIndex = $_GET['pageIndex'];
    $pageSize = $_GET['pageSize'];

    $sql = $sql."ORDER BY e.writetime DESC ";
    if (isset($pageIndex)){
        $offset = $pageSize * ($pageIndex - 1);
        $countSql = "SELECT COUNT(1) total FROM (".$sql.") a";
        $countResult = $db->query($countSql);
        $pageData = new PageData();
        $pageData->total = $countResult->fetch_object()->total;
        $resp->pageData = $pageData;

        $sql = $sql."LIMIT $offset, $pageSize ";
    }

    
    $result = $db-> query($sql);
    while($obj = $result->fetch_object()){
        $arr[]=$obj;
    }

    $resp->data = $arr;
    $resp->result = 0;
    echo json_encode($resp, JSON_UNESCAPED_UNICODE);
?>