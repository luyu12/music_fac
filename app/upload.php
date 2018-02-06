<?php
session_start();
include_once 'connect.php';
$userid=$_COOKIE['userid'];
if(isset($_POST['upload']))
{
	$file=$_FILES['file'];
	//print_r($file);
	$fileName=$_FILES['file']['name'];
	$fileTmpName=$_FILES['file']['tmp_name'];
	$fileSize=$_FILES['file']['size'];
	$fileError=$_FILES['file']['error'];
	$fileType=$_FILES['file']['type'];

	$fileExt=explode('.',$fileName);
	$fileActualExt=strtolower(end($fileExt));

	$allowed=array('jpg','jpeg','png','pdf');
	if(in_array($fileActualExt, $allowed))
	{
		if($fileError===0)
		{
			if($fileSize<1000000)
			{
				
				$fileNameNew="profile".$userid.".".$fileActualExt;
				$fileDestination='uploads/'.$fileNameNew;
				move_uploaded_file($fileTmpName, $fileDestination);
				$sql="UPDATE profile SET status=0 where userid=$userid";
				$result=mysqli_query($dbcon,$sql) or die("error to db");

				header("Location: manage.php?uploadsuccess");
			}
			else
			{
				echo "Your file is too big!";
			}
		}
		else
		{
			echo "There was an error uploading your file!";
		}
	}
	else
	{
		echo "You cannot upload files of this type!";
	}

}




?>

