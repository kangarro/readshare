<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title></title>
		<style type="text/css">
			.box{
				width: 600px;
				height: 900px;
				margin:0 auto;
			}
			.input-group{
				margin-right: 20px;
			}
			.input-group{
				margin:10px 50px;
			}
			.fade{
				overflow: hidden;
			}
			.modal-dialog{
				animation: show 1s;
				animation-fill-mode: forwards;
			}
			@keyframes show{
			from{
				transform:  rotate(-180deg) translate(-200%,200%) scale(0.1,0.1);
				}
				to{}
			}
		</style>
		<link href="https://cdn.bootcss.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
		<div class="box">
			<a href="javascript:void(0)" class="btn btn-primary" data-toggle="modal" data-target="#Modal" style="margin:20px 80px">新增</a>
			<div class="modal fade" id="Modal">  
				    <div class="modal-dialog" style="width: 40%;">  
				        <div class="modal-content">  
				            <div class="modal-header">  
				                <button type="button" class="close" data-dismiss="modal" aria-label="Close">  
				                    <span aria-hidden="true">×</span>  
				                </button>  
				                <h4 class="modal-title" id="myModalLabel">新增主题</h4>  
				            </div> 
							<form action="otherinsert.php" method="post">
								<div class="input-group">
									<span class="input-group-addon" id="sizing-addon2">主题</span>
									<input type="text" class="form-control" aria-describedby="sizing-addon2"  style="width: 200px;" required="required" name="cname" id="topic">
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
									<input class="btn btn-primary" value="提交" id="submit" type="button">
								</div>
							</form>
						</div>
					</div>
				</div>
			
			<div class="panel panel-primary">
			      <div class="panel-heading">主题分类表</div>
			      <!-- Table -->
			      <table class="table">
			        <thead>
			          <tr>
			            <th >编号</th>
			            <th >主题</th>
			            <th>操作</th>
			          </tr>
			        </thead>
			        <tbody>
			        	<?php
			        		include'connectsql.php';
			        		$sql="select * from topic";
			        		$re=$db->query($sql);
			        		while($obj=$re->fetch_object()){
			        			echo"<tr>
			        					<td>$obj->tid</td>
			        					<td>$obj->title</td>
			        					<td>
			        						<button value='$obj->tid' class='btn-danger btn btn-default'>删除</button>
			        					</td>
			        				</tr>";
			        		}
			        	?>
			        </tbody>
			      </table>
   				</div>
   			</div>
   			
		</div>
		
		<script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
		<script src="https://cdn.bootcss.com/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
		<script src="https://cdn.bootcss.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
		<script type="text/javascript">
			$(function(){
				$(".btn-danger").click(function(){
					var tr=$(this).parent().parent();
					var tid=$(this).val();
					$.ajax({
						type:"POST",
						url:"deletetopic.php",
						data:{
							"tid":tid
						},
						success:function(result){
							tr.hide();
						},
						error:function(){
							
						}
					})
				})
				$("#submit").click(function(){
					var topic=$("#topic").val();
					$.ajax({
						type:"POST",
						url:"inserttopic.php",
						data:{
							"topic":topic
						},
						success:function(result){
							window.location="showtopic.php";
						}
					})
				})
			})
		</script>
	</body>
</html>
