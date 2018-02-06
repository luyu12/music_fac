<?php
/**
 * Created by PhpStorm.
 * User: Irinalu
 * Date: 12/6/17
 * Time: 10:16 PM
 */
session_start();
include_once ('connect.php');
$user=$_GET['user'];
$userid=$_COOKIE['userid'];
$sql_delete = "DELETE FROM relationship WHERE (user1=$userid and user2=$user) or (user2=$userid and user1=$user)";
$result_delete = mysqli_query($dbcon, $sql_delete) or die("delete fails");

exit (header("Location: friend.php"));
?>