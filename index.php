<!DOCTYPE html>
<html lang="en">
<head>
	<title>Rest API Client Side Demo</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
</head>
<body>
	<div class="container">
		<h2>Rest API Client Side Demo</h2>
		<form class="form-inline" action="" method="POST">
			<div class="form-group">
				<label for="name">Name</label>
				<input type="text" name="name" class="form-control"  placeholder="Enter Product Name" required/>
			</div>
			<button type="submit" name="submit" class="btn btn-default">Curl submit</button>
			<button type="button" id="ajaxbtn" class="btn btn-default">Ajax submit</button>
			
		</form>
		<p>&nbsp;</p>
		<h3>
			<!-- curl -->
			<?php 
			if(isset($_POST['submit']))
			{
				$name = $_POST['name'];

				$url = "192.168.33.10/API/api.php?name=".$name;
				//添加了.htaccess文件可以使用下面这种
				// $url = "192.168.33.10/API/api/".$name;

				$client = curl_init($url);
				curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
				$response = curl_exec($client);

				$result = json_decode($response);
				echo $result->data;
			}
			?>
		</h3>
	</div>
	<!-- 用ajax不要用form 用form不要用submit button form里的submit button会自动刷新页面-->
	<script type="text/javascript">
		$(document).ready(function(){
			$("#ajaxbtn").click(function(){
				var i_name = $("input[name='name']").val();
				$.ajax({
					url:"api.php?name="+i_name,
					type:"GET",
					dataType:"json",
					success:function(data){
						$("h3").text(data.data);
					}
				})

			})

			//如果用POST方法，api.php也要相应更改成_POST方法
			// $("#ajaxbtn").click(function(){
			// 	var i_name = $("input[name='name']").val();
			// 	$.ajax({
			// 		url:"api.php",
			// 		data:{name:i_name},
			// 		type:"POST",
			// 		dataType:"json",
			// 		success:function(data){
			// 			$("h3").text(data.data);
			// 		}
			// 	})

			// })

		});
	</script>
</body>

</html>