<?php
session_start();
include_once('connect.php');
$userid=$_COOKIE['userid'];
$sql0="SELECT postid from posting where userid=$userid ORDER BY postid desc";
$result0=mysqli_query($dbcon,$sql0);
$row=mysqli_fetch_array($result0);
$postid=$row[0]+1;
setcookie("postid","$postid");

   $post_img='posts/profile'."$userid"."_"."$postid";
    $post_imgurl_jpg=$post_img.'.jpg';
    $post_imgurl_png=$post_img.'.png';
    $post_imgurl_flv=$post_img.'.flv';
    $post_imgurl_mp4=$post_img.'.mp4';
    if(file_exists($post_imgurl_jpg)!=null)
    {
        $post_imgurl=$post_imgurl_jpg;
    }
    else if(file_exists($post_imgurl_png)!=null){
        $post_imgurl= $post_imgurl_png;
    }
    else if(file_exists($post_imgurl_flv)!=null)
    {
        $post_imgurl=$post_imgurl_flv;
    }
    else
    {
        $post_imgurl=$post_imgurl_mp4;
    }
    //echo $post_imgurl;

 
if(isset($_POST['submit']))
{
	$title=$_POST['title'];
	$body=$_POST['body'];
	$category=$_POST['category'];
	$locationname=$_POST['locationname'];

    if($category=='text') {
        $sql = "INSERT INTO posting(userid,postid,title,body,category) values 
($userid,$postid,'$title','$body','$category')";
    }
    else if($category=='photo'){

        $sql = "INSERT INTO posting(userid,postid,title,body,category,link) values 
($userid,$postid,'$title','$body','$category','$post_imgurl')";
    }
    else {
        $sql = "INSERT INTO posting(userid,postid,title,body,category,link) values 
($userid,$postid,'$title','$body','$category','$post_imgurl')";
    }
    //echo $sql;
	mysqli_query($dbcon,$sql) or die("fail to connect db");
	echo "blog entry posted!";

}

?>

<html>
<head>
<meta charset="utf-8">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link href="https://cdn.bootcss.com/bootstrap-select/1.12.1/css/bootstrap-select.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap-select/1.12.1/js/bootstrap-select.min.js"></script>
</head>
<body>

<form method="post" action="newpost.php">
<div class="container">
<br />
<br />
	<div class="row clearfix">
		<div class="col-md-12 column">
			<form role="form">
				<div class="form-group">
					 <label for="title">Title</label><input type="text" class="form-control" name="title" required="required"/>
				</div>
				<div class="form-group">
					<label for="category">Category:</label>      
						<select name="category" id="category" class="selectpicker show-menu-arrow form-control">

							<option value="text">text</option>
							<option value="photo">photo</option>
							<option value="video">video</option>
			        	</select>
				</div>
				<div class="form-group">
					 <label for="body">Body:</label>
					 <p>
					 <textarea name="body"></textarea>
					 </p>
				</div>
                <div class="form-group">
                    <label for="locationname">Location name:</label>
                    <p>
                        <input name="locationname" type="text">
                    </p>
                </div>
				
				<button type="submit" name="submit" class="btn btn-default">Post</button>
			</form>
		</div>
	</div>
</div>
	


<form action="post_post.php" method="post" enctype="multipart/form-data">
    <?php
    if($post_imgurl!=null||$post_imgurl!='')
    {
        ?>
        <img height="200" width="200" src=<?php echo $post_imgurl;
        ?> />
    <?php
    }
    ?>
										<p align="left">
										
									  <label for="file">Choose images to upload (PNG, JPG)</label>

									
									<input align="middle" type="file" name="file">
									
									<button type="submit" name="upload">UPLOAD</button>
									
									</p>
									</form>


<br />
<a href="post.php"> View Post page</a> | <a href="logout.php">Logout</a>


</body>
</html>