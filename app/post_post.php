<?php
session_start();
include_once 'connect.php';
$userid=$_COOKIE['userid'];
$postid=$_COOKIE['postid'];


if(isset($_POST['upload']))
{
	// $sql="INSERT INTO posting(userid,postid,post_timestamp,title,body,category) values ($userid, $postid,'getdate()','$title','$body','$category')";
	// echo $sql;
	// $sqlget=mysqli_query($dbcon,$sql)or die("error!!");

	$file=$_FILES['file'];
	

	$fileName=$_FILES['file']['name'];
	$fileTmpName=$_FILES['file']['tmp_name'];
	$fileSize=$_FILES['file']['size'];
	$fileError=$_FILES['file']['error'];
	$fileType=$_FILES['file']['type'];

	$fileExt=explode('.',$fileName);
	$fileActualExt=strtolower(end($fileExt));

	
		if($fileError===0)
		{
			if($fileSize<100000000)
			{
				$fileNameNew="profile"."$userid"."_"."$postid".".".$fileActualExt;
				$fileDestination='posts/'.$fileNameNew;
				
				move_uploaded_file($fileTmpName, $fileDestination);
				header("Location: newpost.php?postsuccess");
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

?>