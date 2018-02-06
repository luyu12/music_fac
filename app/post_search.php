

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

<form action="post_search.php" class="navbar-form navbar-left" role="search" method="post">
    <div class="form-group">
        <input name="keyword" type="text" class="form-control" />
    </div> <button name="submit" type="submit" class="btn btn-default">Search</button>
</form>
<br />
<p >
    <a href="post.php">Back To Posting </a>
</p>
<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column">
<?php
if(isset($_POST['submit'])) {
    include_once("connect.php");
    $userid = $_COOKIE['userid'];
    $sql_getname = "SELECT * FROM users WHERE userid=$userid";
    $keyword = $_POST['keyword'];

    $result_getname = mysqli_query($dbcon, $sql_getname) or die("result_getname fails");
    $row_getname = mysqli_fetch_array($result_getname);
    $username = $row_getname['username'];
    $sql = "SELECT * FROM posting where userid=$userid and (title like '%$keyword%' or body like '%$keyword%') order by post_timestamp desc";
    $result = mysqli_query($dbcon, $sql);
    $url = $_COOKIE['imgurl'];
    $temp="null";

    while ($row = mysqli_fetch_array($result)) {
        $postid = $row['postid'];
        $title = $row['title'];
        $category = $row['category'];
        $body = $row['body'];
        $post_time = $row['post_timestamp'];
        $post_imgurl = $row['link'];
       if($title!='') {
           $temp="not null";
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
                   <h2><?php echo $title; ?> -
                       <small><?php echo $category; ?> </small>
                   </h2>
                   <p align="right">
                       <small><?php echo $post_time; ?></small>
                   </p>
                   <p><?php echo $body; ?></p>
                   <?php
                   if ($category == 'photo') {
                       ?>
                       <p><img width="200" height="200" src=<?php echo $post_imgurl; ?>></p>
                       <?php
                   } else if ($category == 'video') {
                       ?>

                       <video src=<?php echo $post_imgurl; ?> width="320" height="240" controls>
                       </video>
                       <?php
                   }
                   ?>

               </div>
           </div>
           <hr/>
           <?php
       }
    }
    if($temp=="null")
    {
        echo "no result";
    }

        }
        ?>
        </div>
    </div>
</div>

</body>
</html>
