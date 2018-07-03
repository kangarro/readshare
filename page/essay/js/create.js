$(function(){
	var eid;
	$.ajax({
        type:"GET",
        url:"/readshare/php/api/topic/list.php",
        async:true,
        success:function(result){
            console.log(result);
            var obj = JSON.parse(result);
            console.log(obj);
            if (obj.result == 0) {
                for (topic of obj.data) {
                    $("#topic-begin").after('<label class="radio-inline">'
							                +  '<input type="radio" name="essay-topic" id="inlineRadio1" value="' + topic.tid + '">' + topic.title
							                + '</label>');
                }
            } else {
            }
        },
        error:function(){
            alert("登录失败");
        }
    });

	function commit() {
		var tid = $("input[name='essay-topic']:checked").val();
		$.ajax({
	        type:"POST",
	        data:{
	        	title: $("#essay-title").val(),
	        	content: $("#essay-content").val(),
	        	tid:tid
	        },
	        url:"/readshare/php/api/essay/create.php",
	        async:true,
	        success:function(result){
	        	var obj = JSON.parse(result);
	            if (obj.result == 0){
	            	eid = obj.data;
	            	$("#successModal").modal('show');
	            }
	        },
	        error:function(){
	            alert("登录失败");
	        }
	    });
	}
	$('#commitBtn').click(function(){
		commit();
	});
	$('#okBtn').click(function(){
		window.location = "/readshare/page/essay/detail.html?eid=" + eid;
	});
	$('#returnBtn').click(function(){
		window.location = "/readshare/page/index/index.html";
	});
});