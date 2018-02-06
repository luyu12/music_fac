<?php
/**
 * Created by PhpStorm.
 * User: Irinalu
 * Date: 12/10/17
 * Time: 1:57 PM
 */
include_once ('connect.php');
$sql="SELECT * FROM test";
$query=mysqli_query($dbcon,$sql);
while($row=mysqli_fetch_array($query))
{
    echo $row['video'];
}
?>