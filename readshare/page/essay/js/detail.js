$(function () {
    if ($.cookie('uid')) {
        $("#showRegistBtn").hide();
        $("#showLoginBtn").hide();
        $("#createEssay").removeClass("hide");
        $("#personalCenter").removeClass("hide");
    }
    var eid = location.search.substr(1).split("=")[1];
    $.ajax({
        type:"GET",
        url:"/readshare/php/api/essay/detail.php",
        data: "eid=" + eid,
        async:true,
        success:function(result){
            var obj = JSON.parse(result);
            if (obj.result == 0) {
                $("#essayList").hide();

                var essay = obj.data;
                console.log(essay);
                var comments = obj.arrData;
                for (comment of comments) {
                    console.log(comment.content);
                }
            } else {
            }
        },
        error:function(){
            alert("获取失败");
        }
    });
});