<!--提交按钮不要用submit-->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<style type="text/css">
			.box-body{
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
		<div class="box-body">
			<div class="panel panel-primary">
		      	<div class="panel-heading">
		        	<h3 class="panel-title">查询条件</h3>
		      	</div>
		      	<div class="panel-body">
		        	<form class="navbar-form navbar-left" role="search">
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1">标题</span>
							<input type="text" class="form-control"  aria-describedby="basic-addon1" id="title">
						</div>
						<div class="input-group">
							<span class="input-group-addon" id="basic-addon1">作者</span>
							<input type="text" class="form-control"  aria-describedby="basic-addon1" id="writer">
						</div>

						<div class="input-group">
							分类:
							<select name="label" id="label">
								<option value="">-请选择</option>
								<?php
									header("content-type:text/html;charset=utf-8");
									include'connectsql.php';
									$sql="select * from topic";
									$re=$db->query($sql);
									while($obj=$re->fetch_object()){
										$a=$obj->title;
										echo "<option value='$a'>".$a."</option>";
									}
								?>
							</select>
						</div>
						<button type="button" class="btn btn-default search" id="search">搜索</button>
					</form>
		      	</div>
		    </div>
		    
		    <div class="panel panel-primary">
		      <div class="panel-heading">查询结果</div>
		      <!-- Table -->
		      <table class="table">
		        <thead>
		          <tr>
		            <th >类别</th>
		            <th >标题</th>
		            <th >作者</th>
		            <th >发表时间</th>
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
					var	title=$("#title").val();
					var	writer=$("#writer").val();
					var label=$("#label").val();
					$.ajax({
						type:"POST",
						url:"searchessay.php",
						async:true,
						dataType:"json",
						data:{
							"title":title,
							"writer":writer,
							"label":label
						},
						success:function(result){
							if(result==""){
								var tr =$("<tr></tr>").appendTo("tbody");
								tr.append("查无此信息");
							}else{
								for(var i of result){
									 tr=$("<tr></tr>").appendTo($("tbody"));
									 arr=i.split(',');
									for(var k of arr){
										var td=$("<td></td>").appendTo(tr);
										if(!isNaN(k)){
											var btn=$("<button></button>").appendTo(td);
											btn.append("删除");
											btn.val(k);
											btn.addClass("delete btn-danger btn btn-default");
										}else{
											td.append(k);
										}
									}
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
						url:"deletepassage.php",
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
