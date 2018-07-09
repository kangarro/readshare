$(function(){
    if ($.cookie('uid')) {
        $("#showRegistBtn").hide();
        $("#showLoginBtn").hide();
        $("#createEssay").removeClass("hide");
        $("#personalCenter").removeClass("hide");
    }

	//获取链接参数
    var tid = location.search.substr(1).split("=")[1];
//   页码
    var pageIndex = 1;
    //页面容量
    var pageSize = 10;
    //是否搜索
    var isSearch;

    function listEssay(type, tid) {
        isSearch = false;
        var data = "tid=" + tid + "&pageSize=" + pageSize + "&pageIndex=" + pageIndex;
        if (type == "search") {
            data += "&searchKey=" + $("#searchKey").val();
            isSearch = true;
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
                    $("#topicTitle").html(obj.data[0].topic + "&nbsp;&nbsp;(总共" + obj.pageData.total + "篇文章)");
                    for (essay of obj.data) {
                        console.log(essay);
                        essay.content = essay.content.substr(0,200) + "...";
                        $("#essay-body").append(
                            "<div class=\"essay\">" +
                            "<div><h4><a href='detail.html?eid=" + essay.eid + "'>" + essay.title +"</a></h4></div>" +
                            "<br>" +
                            "<div class=\"content\" >" +
                            "<span>" + essay.content

                             +"</span>" +
                            "</div>" +
                            "<div class=\"essay-footer\">" +
                            "<br>" +
                            "<span class='pull-left' ><span class=\"glyphicon glyphicon-thumbs-up\" aria-hidden=\"true\"></span>&nbsp;(" + essay.agree + ")</span></span>" +
                            "<span class='pull-left' >&nbsp;&nbsp;<span class=\"glyphicon glyphicon-pencil\" aria-hidden=\"true\"></span>&nbsp;(" + essay.commentCount + ")</span></span>" +
                            "<span class=\"pull-right\">作者：<a href='/readshare/page/user/userDetail.html?uid="+ essay.uid +"'>"+ essay.writer+ "</a> &nbsp;&nbsp;" + essay.writetime + "</span>" +
                            "</div>" +
                            "</div>" +
                            "<br>" +
                            "<hr>"
                        );
                    }

                    $("#next").removeAttr("disabled");

                    console.log(obj.pageData.total - pageIndex * pageSize);
                    //如果没有更多就不能加载更多
                    if (obj.pageData.total <= pageIndex * pageSize) {
                        $("#next").attr("disabled", "true");
                    }
                } else {
                }
            },
            error:function(){
                alert("获取失败");
            }
        });
    }
    function changePage(args) {
        pageSize += args;
        if (isSearch) {
            listEssay("search", tid);
        } else {
            listEssay("all", tid);
        }

    }
    $("#searchBtn").click(function() {
        listEssay("search", tid);
    });
   
    $("#next").click(function(){
        changePage(1);
    });
    listEssay("all", tid);
});