<php include 'connect.php';

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

<h1 style="text-align:center">My Posting</h1>


<p align="right">
    <a href="post_search.php"><button name="submit" type="submit" class="btn btn-default">Search</button></a>
</p>
<p align="right">
<a href="index.php">Back to home page</a> | <a href="newpost.php">Create a new post</a>
</p>
<?php
	include_once("connect.php");
	$userid=$_COOKIE['userid'];
    $sql_getname="SELECT * FROM users WHERE userid=$userid";
    //echo $sql_getname;
    $result_getname=mysqli_query($dbcon,$sql_getname) or die("result_getname fails");
    $row_getname=mysqli_fetch_array($result_getname);
    $username=$row_getname['username'];
	$sql="SELECT * FROM posting where userid=$userid order by post_timestamp desc";
	$result=mysqli_query($dbcon,$sql);
	$url=$_COOKIE['imgurl'];
	
	while($row=mysqli_fetch_array($result))
	{
		$postid=$row['postid'];
		$title=$row['title'];
		$category=$row['category'];
		$body=$row['body'];
		$post_time=$row['post_timestamp'];
		$post_imgurl=$row['link'];


?>

<div class="row clearfix">
	<div class="col-md-3 column">
	<p align="center">
        <img width="150" height="150" src=<?php echo $url ?> class="img-circle"/>
	</p>

	<p align="center">
		<?php echo "$username"; ?>
	</p>

	</div>

<div class="col-md-9 column">
<h2><?php echo $title; ?> -<small><?php echo $category; ?> </small></h2>
<p align="right"><small ><?php echo $post_time; ?></small><p>
<p><?php echo $body; ?></p>
    <?php
    if($category=='photo') {
    ?>
    <p><img width="200" height="200" src=<?php echo $post_imgurl; ?>></p>
    <?php
    }
    else if($category=='video') {
        ?>

        <video src=<?php echo $post_imgurl; ?> width="320" height="240" controls>
        </video>
        <?php
    }
    ?>

<br />
    <a id="modal-838867" href="#modal-container-838867" role="button" class="btn" data-toggle="modal">COMMENT</a>

    <div class="modal fade" id="modal-container-838867" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="myModalLabel">
                        COMMENT
                    </h4>
                <form name="fr" method="post" action="comment.php">
                <div class="modal-body">
                    <input type="hidden" name="comment_userid" value='<?php echo $userid;?>'>
                    <input type="hidden" name="postid" value='<?php echo $postid;?>'>
                    <input autocomplete="off" type="text" name="comment">

                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">cancel</button>
                        <button type="submit" name="save" class="btn btn-primary">save</button>
                    </div>
                    </form>
    <!--                <script type='text/javascript'>-->
<!--                    document.fr.submit();-->
<!--                </script>-->

            </div>

        </div>
        </div>
    </div>

    <div class="container">
        <div class="row clearfix">
            <div class="col-md-12 column">
                <table class="table table-condensed table-hover table-striped">
                    <thead>
                    <tr>
                        <th>
                            content
                        </th>
                        <th>
                            comment username
                        </th>
                        <th>
                            comment time
                        </th>
                    </tr>
                    </thead>
    <?php
    $sql_comment="SELECT * FROM comments where userid=$userid and postid=$postid";
    $result_comment=mysqli_query($dbcon,$sql_comment) or die("sql_comment fails");
   // $row=mysqli_fetch_assoc($result_comment);


    while($row_comment=mysqli_fetch_array($result_comment)) {
        $comment_userid= $row_comment['comment_user'];
        $sql_username="SELECT * FROM users where userid=$comment_userid";
        $result_username=mysqli_query($dbcon,$sql_username) or die("sql_username fails");
        $row_username=mysqli_fetch_array($result_username);
        $comment_username=$row_username['username'];

        $content = $row_comment['content'];
        $comment_time = $row_comment['commenttime'];
        $likes = $row_comment['likes'];
        ?>

                        <tbody>
                        <tr >
                            <td>
                                <strong> <?php echo $content;?></strong>
                            </td>
                            <td>
                                <small><?php echo $comment_username;?></small>
                            </td>
                            <td>
                                <small><?php echo $comment_time?></small>
                            </td>

                        </tr>
                        </tbody>

        <?php
    }
?>
                </table>
            </div>
        </div>
    </div>


    <hr />
</div>

</div>

<?php

}
?>
<!--<div class="row clearfix">-->
<!--    <div class="col-md-12 column">-->
<!--        <ul class="pagination">-->
<!--            <li>-->
<!--                <a href=>Prev</a>-->
<!--            </li>-->
<!--            <li>-->
<!--                <a href="post.php?page=1">1</a>-->
<!--            </li>-->
<!--            <li>-->
<!--                <a href="post.php?page=2">2</a>-->
<!--            </li>-->
<!--            <li>-->
<!--                <a href="post.php?page=3">3</a>-->
<!--            </li>-->
<!--            <li>-->
<!--                <a href="post.php?page=4">4</a>-->
<!--            </li>-->
<!--            <li>-->
<!--                <a href="post.php?page=5">5</a>-->
<!--            </li>-->
<!--            <li>-->
<!--                <a href="#">Next</a>-->
<!--            </li>-->
<!--        </ul>-->
<!--    </div>-->
<!--</div>-->


</body>
</html>