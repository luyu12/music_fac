<?php
/**
 * Created by PhpStorm.
 * User: Irinalu
 * Date: 12/6/17
 * Time: 11:50 PM
 */
session_start();
include_once ('connect.php');
$user=$_GET['user_request'];
$userid=$_COOKIE['userid'];
$sql_delete = "DELETE FROM relationship WHERE status='pending' and (user1=$userid and user2=$user) or (user2=$userid and user1=$user)";
$result_delete = mysqli_query($dbcon, $sql_delete) or die("delete fails");
$sql_insert="INSERT INTO relationship(user1,user2,status,user_from) VALUES ($userid,$user,'decline',$userid)";
$result_insert = mysqli_query($dbcon, $sql_insert) or die("insert fails");
exit (header("Location: friend.php/declinesuccessfully"));
?>