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


<div class="container">
	<div class="row clearfix">
		<div class="col-md-12 column">
            <div class="row clearfix">
                <div class="col-md-4 column">
                    <h1> <?php
                        include_once('connect.php');


                        $userid=$_COOKIE['userid'];

                        $sql_getname="SELECT * FROM users WHERE userid=$userid";
                        // echo $sql_getname;
                        $result_getname=mysqli_query($dbcon,$sql_getname) or die("result_getname fails");
                        $row_getname=mysqli_fetch_array($result_getname);
                        $username=$row_getname['username'];
                        echo $username;?>'s friends </h1>
                </div>
                <div class="col-md-4 column">
                    <br />
                    <form class="navbar-form navbar-left" method="post" role="search">
                        <div class="form-group">
                            <input name='keyword' type="text" class="form-control" />
                        </div> <button name="submit" type="submit" class="btn btn-default">Search</button>
                    </form>
                </div>
                <div class="col-md-4 column">
                    <br />
                    <br />
                    <p align="right">
                        <a  href="index.php">back to home page</a>
                    </p>
                </div>
            </div>
            <br />
			<table class="table table-striped" >
				<thead>
					<tr>
					<th>
					userid 
					</th>
						<th>
							username
						</th>
						<th>
							email
						</th>
						<th>
							status
						</th>
                        <th>
                            datetime
                        </th>
                        <th>
                            request
                        </th>
					</tr>
				</thead>
				

<?php 

//display the result by keyword
if(isset($_POST['submit'])) {
    $keyword=$_POST['keyword'];
    $sql_keyword = "SELECT * FROM users WHERE userid<>$userid and (username like '%$keyword%' or email like '%$keyword%') ORDER BY userid ASC";
    $result_keyword = mysqli_query($dbcon, $sql_keyword) or die("sql_keyword fails to connect db");

    while ($row_keyword = mysqli_fetch_array($result_keyword)) {
        $user = $row_keyword['userid'];
        $username = $row_keyword['username'];
        $email = $row_keyword['email'];

        $sql_status = "SELECT * FROM relationship where (user1='$userid' and user2='$user') or (user2='$userid' and user1='$user') ORDER BY datetime DESC ";
        $result_status = mysqli_query($dbcon, $sql_status) or die("sql_status fails to connect db");
        $row_status = mysqli_fetch_array($result_status);
        //$result = "";
        $status = $row_status['status'];
        $datetime= $row_status['datetime'];
        if ($status == 'accept') {
            $result = "not null";
            ?>
            <tbody>
            <tr class="error">
                <td>
                    <?php echo $user; ?>
                </td>
                <td>
                    <?php echo $username; ?>
                </td>
                <td>
                    <?php echo $email; ?>
                </td>
                <td>
                    friend
                </td>
                <td>
                    <?php echo $datetime; ?>
                </td>

                <td>
                    <!--                    --><?php
                    //                    echo "<a href='addfriend.php?user=$user' id='add' >";
                    //                    ?>
                    <!--                    <button type="submit" name="add" value="add as friend">-->
                    <!--                        add as friend-->
                    <!--                    </button>-->
                    <!--                    </a>-->
                    <!--                    <script>-->
                    <!--                        document.getElementById("add").addEventListener("click", myFunction);-->
                    <!---->
                    <!---->
                    <!--                        function myFunction() {-->
                    <!--                            document.getElementById("add").innerHTML = "pending";-->
                    <!---->
                    <!--                        }-->
                    <!--                    </script>-->
                    <?php echo "<a href='deletefriend.php?user=$user'>"; ?>
                    <button href="deletefriend.php" value="delete friend">delete friend</button>
                    </a>
                </td>
            </tr>
            </tbody>
            <?php
        }

        //displaying all the pending request

//$sql_pending="SELECT * FROM relationship where status='pending' and user_from=$userid and (user1=$userid or user2=$userid)";
//$result_pending=mysqli_query($dbcon,$sql_pending) or die("sql_pending fails to connect db");
//
//while($row_pending=mysqli_fetch_array($result_pending))
//{
//    if($row_pending['user1']==$userid)
//    {
//        $user_pending=$row_pending['user2'];
//    }
//    else{
//        $user_pending=$row_pending['user1'];
//    }
//    $sql_user_pending="SELECT * FROM users where userid=$user_pending";
//    $result_user_pending=mysqli_query($dbcon,$sql_user_pending) or die("sql_user_pending fails to connect db");
//    $row_user_pending=mysqli_fetch_array($result_user_pending);
//
//    ?>
        <!---->
        <!--    <tbody>-->
        <!--    <tr class="error">-->
        <!--        <td>-->
        <!--            --><?php //echo $row_user_pending['userid'];?>
        <!--        </td>-->
        <!--        <td>-->
        <!--            --><?php //echo $row_user_pending['username'];?>
        <!--        </td>-->
        <!--        <td>-->
        <!--            --><?php //echo $row_user_pending['email'];?>
        <!--        </td>-->
        <!--        <td>-->
        <!--            pending-->
        <!--        </td>-->
        <!--        <td>-->
        <!---->
        <!--        </td>-->
        <!--    </tr>-->
        <!--    </tbody>-->
        <!---->
        <!--    --><?php

        //add friends and decline by the keyword
    }
    if($keyword!=null&&$result!="not null")
    {
        echo "No result";
    }
}
else
{
    $sql_friend = "SELECT * FROM relationship where status='accept' and (user1=$userid or user2=$userid) ORDER BY datetime DESC";
    $result_friend = mysqli_query($dbcon, $sql_friend) or die("sql_friend fails to connect db");

    while ($row_friend = mysqli_fetch_array($result_friend)) {
        if ($row_friend['user1'] == $userid) {
            $user_friend = $row_friend['user2'];
        } else {
            $user_friend = $row_friend['user1'];
        }
        $datetime=$row_friend['datetime'];
        $sql_user = "SELECT * from users where userid=$user_friend ORDER BY userid ASC";
        $result_user = mysqli_query($dbcon, $sql_user) or die("sql_user fails to connect db");
        $row_user = mysqli_fetch_array($result_user);
        ?>
        <tbody>
        <tr class="error">
            <td>
                <?php echo $row_user['userid']; ?>
            </td>
            <td>
                <?php echo $row_user['username']; ?>
            </td>
            <td>
                <?php echo $row_user['email']; ?>
            </td>
            <td>
                friend
            </td>
            <td>
                <?php echo $datetime; ?>
            </td>
            <td>
                <?php echo "<a href='deletefriend.php?user=$user_friend'>"; ?>
                <button href="deletefriend.php" value="delete friend">delete friend</button>
                </a>
            </td>
        </tr>
        </tbody>
        <?php

    }
}


?>
            </table>
        </div>
    </div>
    <hr />
    <div class="row clearfix">
        <div class="col-md-12 column">
            <h1>notification</h1>

                   <?php
                    $sql_notif="SELECT * FROM relationship where status='pending' and user_from<>$userid and (user1=$userid or user2=$userid)";
                    //echo $sql_notif;
                    $result_notif=mysqli_query($dbcon,$sql_notif)or die("result_notif fails");
                    while($row_notif=mysqli_fetch_array($result_notif))
                    {
                        if($row_notif['user1']==$userid)
                        {
                            $user_notif=$row_notif['user2'];
                        }
                        else{
                            $user_notif=$row_notif['user1'];
                        }
                        $sql_name="SELECT * FROM users where userid=$user_notif";
                        $result_name=mysqli_query($dbcon,$sql_name)or die("result_name fails");
                        $row_name=mysqli_fetch_array($result_name);
                        $username_notif=$row_name['username'];
                        echo "<div class='alert alert-dismissable alert-info'>"."<h4>";
                        echo "<strong>"."$username_notif"."</strong>"." has sent you a friend request.";
                    ?>
                </h4>
            <a <?php echo "href='acceptfriend.php?user_request=$user_notif & username_request=$username_notif'";?> class="alert-link"><button>accept</button></a>  <a <?php echo "href='declinefriend.php?user_request=$user_notif'";?> class="alert-link"><button>decline</button></a>
            <?php
            }
            ?>
        </div>
        </div>
    </div>
</div>


</body>

</html>