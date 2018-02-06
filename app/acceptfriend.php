<?php
/**
 * Created by PhpStorm.
 * User: Irinalu
 * Date: 12/6/17
 * Time: 11:52 PM
 */
session_start();
include_once ('connect.php');
$user=$_GET['user_request'];
$username_request=$_GET['username_request'];
$userid=$_COOKIE['userid'];
$sql_delete = "DELETE FROM relationship WHERE status='pending' and (user1=$userid and user2=$user) or (user2=$userid and user1=$user)";
$result_delete = mysqli_query($dbcon, $sql_delete) or die("delete fails");
$sql_insert="INSERT INTO relationship(user1,user2,status,user_from) VALUES ($userid,$user,'accept',$userid)";
$result_insert = mysqli_query($dbcon, $sql_insert) or die("insert fails");
exit (header("Location: friend.php?addsuccessfully"));
?>