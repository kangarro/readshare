$(function() {
    if ($.cookie('uid') && $.cookie('uid') != null) {
        $("#showRegistBtn").hide();
        $("#showLoginBtn").hide();
        $("#createEssay").removeClass("hide");
        $("#logoutBtn").removeClass("hide");
        $("#personalCenter").removeClass("hide");
        $("#createEssay").click(function(){
            window.location = "/readshare/page/essay/create.html";
        });
        $("#personalCenter").click(function(){
            window.location = "/readshare/page/user/myInfo.html";
        });
    }
    function showModal (type) {
        if (type == "login")
            $('#loginModal').modal('show');
        else
            $('#registModal').modal('show');
    }

    $("#showLoginBtn").click(function() {
        showModal("login");
    });

    $("#showRegistBtn").click(function() {
        showModal("regist");
    });


    $("#loginBtn").click(function(){
        $.ajax({
            type:"POST",
            url:"/readshare/php/api/login/login.php",
            data:'username=' + $("#username").val() + "&password=" + $("#password").val(),
            async:true,
            success:function(result){
                console.log(result);
                var obj = JSON.parse(result);
                console.log(obj);
                if (obj.result != 0) {
                    $("#loginMsg").removeClass("hide");
                } else {
                    $.cookie('uid', obj.data.uid, { path: '/'});
                    $('#logoutBtn').removeClass('hide');
                    $('#loginModal').modal('hide');
                    $("#showRegistBtn").hide();
                    $("#showLoginBtn").hide();
                    $("#createEssay").removeClass("hide");
                    $("#personalCenter").removeClass("hide");
                }
            },
            error:function(){
                alert("登录失败");
            }
        })
    });
    $("#logoutBtn").click(function(){
        $.ajax({
            type:"POST",
            url:"/readshare/php/api/login/logout.php",
            async:true,
            success:function(result){
                console.log(result);
                alert("已注销");
                $.cookie('uid', null, { path: '/', expires: 0});
                $('#logoutBtn').addClass('hide');
                $("#showRegistBtn").show();
                $("#showLoginBtn").show();
                $("#createEssay").addClass("hide");
                $("#personalCenter").addClass("hide");

            },
            error:function(){
                alert("登录失败");
            }
        })
    });
    $("#registBtn").click(function(){
        $.ajax({
            type:"POST",
            url:"/readshare/php/api/login/login.php",
            data:'nickname=' + $("#r_nickname").val() +'&username=' + $("#r_username").val() + "&password=" + $("#r_password").val(),
            async:true,
            success:function(result){
                console.log(result);
                var obj = JSON.parse(result);
                console.log(obj);
                if (obj.result != 0) {
                } else {
                    alert("注册成功");
                    $('#registModal').modal('hide');
                }
            },
            error:function(){
                alert("登录失败");
            }
        })
    });
});