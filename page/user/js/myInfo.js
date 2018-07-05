$(function() {
	var user;
	function getMyINfo() {
		$.ajax({
	        type:"GET",
	        url:"/readshare/php/api/user/myInfo.php",
	        async:true,
	        success:function(result){
	            console.log(result);
	            var obj = JSON.parse(result);
	            console.log(obj);
	            if (obj.result == 0) {
	            	user = obj.data;
	                $("#my-name").html(obj.data.nickname);
	                $("#my-profile").html(obj.data.profile == null ? "nothing." : obj.data.profile);
	                $("#my-follower").html("<a href='/readshare/page/user/list.html?type=1'>" + obj.data.followerCount + "</a>");
	                $("#my-follow-to").html("<a href='/readshare/page/user/list.html?type=2'>" + obj.data.followToCount + "</a>");
	            } else {

	            }
	        },
	        error:function(){
	            alert("error");
	        }
	    });
	}
	getMyINfo();
    $.ajax({
        type:"GET",
        url:"/readshare/php/api/essay/list.php",
        data: "isMine=Y",
        async:true,
        success:function(result){
            console.log(result);
            var obj = JSON.parse(result);
            console.log(obj);
            if (obj.result == 0) {
                $("#essay-body").html("");
                    for (essay of obj.data) {
                        $("#essay-body").append(
                            "<div class=\"essay\">" +
                            "<div><h4><a href='/readshare/page/essay/detail.html?eid=" + essay.eid + "'>" + essay.title +"</a></h4></div>" +
                            "<span class='pull-left'>分类：<span class='essay-topic'>" + essay.topic + "</span></span>" +
                            "<span class=\"pull-right\">" + essay.writetime + "</span>" +
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
            alert("error");
        }
    });

    $('#editBtn').click(function(){
    	$("#editModal").modal("show");
    	$('#nickname').val(user.nickname);
    	$("#profile").val(user.profile);
    });
    $('#pswBtn').click(function(){
    	$("#pswModal").modal("show");
    	$("#errorMsg").addClass("hide");
    });

    function updateInfo(type) {
    	$.ajax({
	        type:"POST",
	        url:"/readshare/php/api/user/update.php",
	        data: {
	        	nickname: $('#nickname').val(),
	        	password: $("#password").val(),
	        	profile: $("#profile").val(),
	        	type: type
	        },
	        async:true,
	        success:function(result){
	            console.log(result);
	            var obj = JSON.parse(result);
	            console.log(obj);
	            if (obj.result == 0) {
	            	if (type == 1){
	                	$("#editModal").modal("hide");
	                	getMyINfo();
					} else {
	                	$("#pswModal").modal("hide");
	                }
	            } else {
	            }
	        },
	        error:function(){
	            alert("error");
	        }
	    });
    }

    function errorMessage(msg){
    	$("#errorMsg").removeClass("hide").html(msg);

    }
    $('#updateBtn').click(function(){
    	updateInfo(1);
    });
    $('#updatePswBtn').click(function(){
    	if ($("#password").val() != $("#r_password").val()) {
    		errorMessage("different password!!");
    	}else {
    		updateInfo(2);
    	}
    });


});