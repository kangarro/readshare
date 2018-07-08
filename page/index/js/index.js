$(function () {
    $.ajax({
        type:"GET",
        url:"/readshare/php/api/topic/list.php",
        async:true,
        success:function(result){
            console.log(result);
            var obj = JSON.parse(result);
            
            if (obj.result == 0) {
                for (topic of obj.data) {
                    $("#topic-title").after("<a class=\"list-group-item\" href='../essay/list.html?tid=" + topic.tid + "'>" + topic.title + "</a>");
                }
            } else {
            }
        },
        error:function(){
            alert("登录失败");
        }
    });

    listEssay("all", 0);




    $("#searchBtn").click(function() {
        listEssay("search");
    });

    function listEssay(type, tid) {
        var data = "";
        if (type == "search") {
            data = "searchKey=" + $("#searchKey").val()
        } else if (type == "topic") {
            data = "tid=" + tid;
        }
        $.ajax({
            type:"GET",
            url:"/readshare/php/api/essay/list.php",
            data: data,
            async:true,
            success:function(result){
                var obj = JSON.parse(result);
                if (obj.result == 0) {
                    $("#essay-body").html("");
                    for (essay of obj.data) {   
                        essay.content = essay.content.substr(0,200) + "...";
                        $("#essay-body").append(
                            "<div class=\"essay\">" +
                            "<div><h4><a href='/readshare/page/essay/detail.html?eid=" + essay.eid + "'>" + essay.title +"</a></h4></div>" +
                            "<br>" +
                            "<div class=\"content\">" +
                            "<span>" + essay.content +"</span>" +
                            "</div>" +
                            "<div class=\"essay-footer\">" +
                            "<br>" +
                            "<span class='pull-left'>分类：<span class='essay-topic'>" + essay.topic + "</span></span>" +
                            "<span class='pull-left' >&nbsp;&nbsp;<span class=\"glyphicon glyphicon-thumbs-up\" aria-hidden=\"true\"></span>&nbsp;(" + essay.agree + ")</span></span>" +
                            "<span class='pull-left' >&nbsp;&nbsp;<span class=\"glyphicon glyphicon-pencil\" aria-hidden=\"true\"></span>&nbsp;(" + essay.commentCount + ")</span></span>" +
                            "<span class=\"pull-right\">作者：<a href='/readshare/page/user/userDetail.html?uid=" + essay.uid + "'>"+ essay.writer+ "</a> &nbsp;&nbsp;" + essay.writetime + "</span>" +
                            "</div>" +
                            "</div>" +
                            "<br>" +
                            "<hr>"
                        );
                    }
                } else {
                }
            },
            error:function(){
                alert("获取失败");
            }
        });
    }
});