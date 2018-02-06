<?php
include_once ('connect.php');
$sql="select * from test";
$query=mysqli_query($dbcon,$sql);
while($row=mysqli_fetch_array($query))
{
   $url=$row['video'];
   echo 'app'.$url;

   ?>
    <html>
    <head></head>
    <body>
    <video src="/posts/profile30_25.mp4" width="320" height="240" controls>
    </video>
    </body>
    <html>
<?php
}
?>