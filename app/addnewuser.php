<?php

session_start();

DEFINE ('DB_USER','root');
DEFINE ('DB_PSWD','root');
DEFINE ('DB_HOST','localhost');
DEFINE ('DB_NAME','app');

$dbcon=mysqli_connect(DB_HOST,DB_USER,DB_PSWD,DB_NAME);


$email = $_POST['email'];
$password = $_POST['password'];
$username = $_POST['username'];

$insertnew = "INSERT INTO users(email,password,username) Values('$email','$password', '$username')";
$result_insertnew = mysqli_query($dbcon,$insertnew);


?>

<!DOCTYPE html> 
<html>
<head>
	 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link href="https://cdn.bootcss.com/bootstrap-select/1.12.1/css/bootstrap-select.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap-select/1.12.1/js/bootstrap-select.min.js"></script>
</head>

<body>
	<!--start-main-->
	<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
			<h3 class="text-center">
				<?php  
				$dup="SELECT * FROM users where email='$email'";
				$dup_result=mysqli_query($dbcon,$dup);
				$result1=mysqli_fetch_array($dbcon,$dup_result);

				if($result_insertnew)
				{
					echo "You have successfully registered";
				}
				else {
					echo "The email has been registered, Please try again!";
				}
				?>
			</h3>
		</div>
	</div>
	<div class="row clearfix">
		<div class="col-md-12 column">
		<a href="login.php" >
			 <button type="button" class="btn btn-lg btn-link btn-block">return back to login</button>
		</a>
		</div>
	</div>
</div>
	
				
				

	<!---//end-main-->	 	
</body>
</html>