<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<style type="text/css">
			.box{
				width: 1000px;
				height: 900px;
				margin:0 auto;
			}
			.input-group{
				margin-right: 20px;
			}
			.search{
				width: 100px;
			}
			select{
				width: 70px;
				height: 30px;
				border-radius: 3px;
				border-color:#CBCBCB ;
			}
		</style>
	<link href="https://cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
	</head>

	<body>
		<div class="box">
			<div class="panel panel-primary">
		      	<div class="panel-heading">
		        	<h3 class="panel-title">查询条件</h3>
		      	</div>
		      	<div class="panel-body">
		        	<form class="navbar-form navbar-left" role="search">
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1">昵称</span>
							<input type="text" class="form-control"  aria-describedby="basic-addon1" id="nickname">
						</div>
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1">用户名</span>
							<input type="text" class="form-control"  aria-describedby="basic-addon1" id="username">
						</div>

						<button type="button" class="btn btn-default search" id="search">搜索</button>
					</form>
		      	</div>
		    </div>
		    
		    <div class="panel panel-primary">
		      <div class="panel-heading">查询结果</div>
		      <table class="table">
		        <thead>
		          <tr>
		            <th >用户编号</th>
		            <th >用户名</th>
		            <th >昵称</th>
		            <th >密码</th>
		            <th>操作</th>
		          </tr>
		        </thead>
		        <tbody>
		          
		        </tbody>
		      </table>
   			 </div>
		</div>
		<script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
		<script src="https://cdn.bootcss.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
		<script src="https://cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script type="text/javascript">
			$(function(){
				$("#search").click(function(){
					$("tbody").empty();
					var	nickname=$("#nickname").val();
					var	username=$("#username").val();
					$.ajax({
						type:"POST",
						url:"searchadmin.php",
						async:true,
						dataType:"json",
						data:{
							"nickname":nickname,
							"username":username,
						},
						success:function(result){
							if(result==""){
								var tr =$("<tr></tr>").appendTo("tbody");
								tr.append("查无此信息");
							}else{
								for(var i of result){
									 tr=$("<tr></tr>").appendTo($("tbody"));
									 arr=i.split(',');
									for(var k=0;k<arr.length;k++){
										var deletduid = arr[0];
										var td=$("<td></td>").appendTo(tr);
											td.append(arr[k]);
									}
									var td=$("<td></td>").appendTo(tr);
									var btn=$("<button></button>").appendTo(td);
									btn.append("删除");
									btn.val(deletduid);
									btn.addClass("delete btn-danger btn btn-default");
								}
							}
						},
						error:function(){
							alert("11");
						}
					});
				})
//				删除按钮为动态生成，用on绑定事件 $("tbody")不为动态元素
				$("tbody").on("click",".delete",function(){
					var val=$(this).val();
					var tr=$(this).parent().parent();
					$.ajax({
						type:"post",
						url:"deleteadmin.php",
						async:true,
						data:{
							"value":val
						},
						success:function(result){
							tr.hide();
						},
						error:function(){
							
						}
					})
				})
			})
			
		</script>
	</body>
</html>