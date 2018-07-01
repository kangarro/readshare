$(function() {
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
                    $.cookie('uid', obj.data.uid);
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