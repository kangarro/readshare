$(function(){
	var type = location.search.substr(1).split("=")[1];
	$("#returnBtn").click(function(){
		window.location = "myInfo.html";
	});

	function follow(uid) {
		$.ajax({
	        type:"GET",
	        url:"/readshare/php/api/user/follow.php",
	        data: "type=follow&uid=" + uid,
	        async:true,
	        success:function(result){
	            var obj = JSON.parse(result);
	            if (obj.result == 0) {
	                init();
	            } else {
	            }
	        },
	        error:function(){
	            alert("获取失败");
	        }
	    });
	}
	function unfollow(uid) {
		$.ajax({
	        type:"GET",
	        url:"/readshare/php/api/user/follow.php",
	        data: "type=unfollow&uid=" + uid,
	        async:true,
	        success:function(result){
	            var obj = JSON.parse(result);
	            if (obj.result == 0) {
	                init();
	            } else {
	            }
	        },
	        error:function(){
	            alert("获取失败");
	        }
	    });
	}
	function init(){
	    $.ajax({
	        type:"GET",
	        url:"/readshare/php/api/user/list.php",
	        data: "type=" + type,
	        async:true,
	        success:function(result){
	            var obj = JSON.parse(result);
	            if (obj.result == 0) {
	            	$("#list-group").html('<a href="#" class="list-group-item disabled" id="user-list-heading">User List</a>');
	                for(user of obj.data) {
	                	var str = ' <a class="list-group-item disable">'+ user.nickname 
	                		+ '<span class="pull-right"><button class="btn btn-default btn-xs" flag="d" uid="'+user.uid+'">Profile</button>&nbsp;';

	                	if (user.isFollow == 'N') {

	                		str += '<button class="btn btn-success btn-xs" flag="f" uid="'+user.uid+'">Follow</button>';
	                	} else {
	                		str += '<button class="btn btn-success btn-xs" flag="u" uid="'+user.uid+'">Unfollow</button>';
	                	}
	                	str += '</span></a>';
	                	$("#user-list-heading").after(str);
	                }

	                var btns = $("[flag]");
	                console.log(btns.length);
	                for (btn of btns) {
	                	console.log(btn.getAttribute('flag'));
	                	if (btn.getAttribute('flag') == 'd') {
	                		btn.onclick = function(){alert(1)};
	                	} else if (btn.getAttribute('flag') == 'f') {
	                		btn.onclick = function(){follow(btn.getAttribute('uid'))};
	                	} else {
	                		btn.onclick = function(){unfollow(btn.getAttribute('uid'))};
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
});