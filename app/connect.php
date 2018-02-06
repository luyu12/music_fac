<?php
/**
 * Created by PhpStorm.
 * User: Irinalu
 * Date: 11/12/17
 * Time: 11:37 PM
 */

DEFINE ('DB_USER','root');
DEFINE ('DB_PSWD','root');
DEFINE ('DB_HOST','localhost');
DEFINE ('DB_NAME','musicfanapp');

$dbcon=mysqli_connect(DB_HOST,DB_USER,DB_PSWD,DB_NAME);

if(!$dbcon)
{
    die('error connecting to database');
}


?>