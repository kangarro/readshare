$(function () {
    if ($.cookie('uid')) {
        $("#showRegistBtn").hide();
        $("#showLoginBtn").hide();
        $("#createEssay").removeClass("hide");
        $("#personalCenter").removeClass("hide");
    }
    var essay;
    var eid = location.search.substr(1).split("=")[1];
    function init() {
        $.ajax({
        type:"GET",
        url:"/readshare/php/api/essay/detail.php",
        data: "eid=" + eid,
        async:true,
        success:function(result){
            var obj = JSON.parse(result);
            if (obj.result == 0) {
                $("#essayList").hide();

                essay = obj.data;
                $('#essay-title').html(essay.title);
                $('#essay-writer').html(essay.writer);
                $('#essay-writetime').html(essay.writetime);
                $('#essay-topic').html(essay.topic);
                $('#essay-content').html(essay.content);
                $('#essay-agree').html(essay.agree);
                console.log(essay);
                var comments = obj.arrData;
                if (comments){
                    console.log(comments);
                    for (comment of comments) {
                        $('#commentbox').append('<br><div class="media">'
                            + '<div class="media-left">'
                            +     '<a href="#">'
                            +         '<img width="40px" class="media-object" src="https://timgsa.baidu.com/timg?image&quality=80&size=b9999_10000&sec=1531066677&di=ac08c3d7c602a4cf4b3c5008a991c490&imgtype=jpg&er=1&src=http%3A%2F%2Ffiles.cnblogs.com%2Ffiles%2FE-WALKER%2Fgithub-sociocon.gif" alt="...">'
                            +    '</a>'
                            + '</div>'
                            + '<div class="media-body">'
                            +     '<h4 class="media-heading">' + comment.nickname+ '</h4>'
                            +     comment.content + '<span class="pull-right">' + comment.created + '</span>'
                            + '</div>'
                        + '</div>');
                    }
                }
            } else {
            }
        },
        error:function(){
            alert("获取失败");
        }
    });
    }
    init();

    function agree(){
        $.ajax({
            type:"GET",
            url:"/readshare/php/api/essay/agree.php",
            data: "eid=" + eid,
            async:true,
            success:function(result){
                var obj = JSON.parse(result);
                if (obj.result == 0) {
                    $("#agreeBtn").attr("disabled", "true");
                    init();
                } else {
                }
            },
            error:function(){
                alert("获取失败");
            }
        });
    }

    function sendComment() {
        $.ajax({
            type:"POST",
            url:"/readshare/php/api/essay/comment.php",
            data: {
                content: $("#comment-content").val(),
                eid: eid
            },
            async:true,
            success:function(result){
                var obj = JSON.parse(result);
                if (obj.result == 0) {
                    console.log("ok");
                    $("#commentbox").html('');
                    init();
                } else if (obj.result == 401){
                    alert("you have to log in !");
                }
            },
            error:function(){
                alert("获取失败");
            }
        });
    }

    $("#agreeBtn").click(function() {
        agree();
    });
    $("#send-button").click(function() {
        if($.cookie('uid')){
            sendComment();
        } else {
            $('#loginModal').modal('show');
        }
        
    });
});