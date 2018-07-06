$(function() {
	var uid = location.search.substr(1).split("=")[1];
	function follow(uid) {
		$.ajax({
	        type:"GET",
	        url:"/readshare/php/api/user/follow.php",
	        data: "type=follow&uid=" + uid,
	        async:true,
	        success:function(result){
	            var obj = JSON.parse(result);
	            if (obj.result == 0) {
	                getMyINfo();
	            } else {
	            }
	        },
	        error:function(){
	            alert("获取失败");
	        }
	    });
	}
	function getMyINfo() {
		$.ajax({
	        type:"GET",
	        url:"/readshare/php/api/user/myInfo.php",
	        data: "uid=" + uid,
	        async:true,
	        success:function(result){
	            console.log(result);
	            var obj = JSON.parse(result);
	            console.log(obj);
	            if (obj.result == 0) {
	            	user = obj.data;
	                $("#my-name").html(obj.data.nickname);
	                $("#my-profile").html(obj.data.profile == null ? "nothing." : obj.data.profile);
	                $("#my-follower").html(obj.data.followerCount);
	                $("#my-follow-to").html(obj.data.followToCount);
	                if (obj.pageData == 'N') {
	                	$("#profile-panel").append('<span class="col-sm-12"><button class="col-sm-12 btn btn-success" id="followBtn">Follow it</button></span>');
	                	$("#followBtn").click(function() {
	                		follow(uid);
	                	});
	                }
	            } else {

	            }
	        },
	        error:function(){
	            alert("error");
	        }
	    });
	}
	function getEssays() {
		$.ajax({
	        type:"GET",
	        url:"/readshare/php/api/essay/list.php",
	        data: "isUid=Y&uid=" + uid,
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
	}
	
	getEssays();
	getMyINfo();
});