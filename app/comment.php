<?php
/**
 * Created by PhpStorm.
 * User: Irinalu
 * Date: 12/7/17
 * Time: 1:22 PM
 */
session_start();
include_once 'connect.php';
$userid=$_COOKIE['userid'];
$content=$_POST['comment'];
$postid=$_POST['postid'];
$comment_userid=$_POST['comment_userid'];
if(isset($_POST['save'])) {
    $sql_insert="INSERT INTO comments(userid,postid,comment_user,content,likes) 
values ($userid,$postid,$comment_userid,'$content','')";
    //echo $sql_insert;
    $result_insert=mysqli_query($dbcon,$sql_insert) or die("insert fails");
    header("Location: post.php?commentsuccess");
}
?>