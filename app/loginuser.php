<?php

session_start();
$_session['loggin']=0;
if(isset($_session['loggin'])&&$_session['loggin']==1)
{
	header("Location:index.php");
	exit;
}

DEFINE ('DB_USER','root');
DEFINE ('DB_PSWD','root');
DEFINE ('DB_HOST','localhost');
DEFINE ('DB_NAME','app');

$dbcon=mysqli_connect(DB_HOST,DB_USER,DB_PSWD,DB_NAME);


$email = $_POST['loginemail'];
$password = $_POST['loginpw'];

$query1="SELECT * FROM users WHERE email='$email'";
$query1_result=mysqli_query($dbcon,$query1);
$result1=mysqli_fetch_array($query1_result);

$query2="SELECT * FROM users WHERE email='$email' and password='$password'";
$query2_result=mysqli_query($dbcon,$query2);
$result2=mysqli_fetch_array($query2_result);



if($result1[0]==null)
{
	echo "this account does not exist!";
}
else
{
	if($result2[0]==null)
	{
		echo "wrong password, please try again.";
	}
	else
	{
		$username=$result2['username'];
		$userid=$result2['userid'];
		$sql="INSERT INTO profile(userid,status,photo) values ($userid,1,'')";
		mysqli_query($dbcon,$sql);

		$_session['loggin']=1;
		setcookie("email","$email");
		setcookie("username","$username");
		setcookie("userid","$userid");
		exit(header("Location:index.php"));
		echo "you've loged in";

	}
}



?>