<?php
session_start();
DEFINE ('DB_USER','root');
DEFINE ('DB_PSWD','root');
DEFINE ('DB_HOST','localhost');
DEFINE ('DB_NAME','app');
$dbcon=mysqli_connect(DB_HOST,DB_USER,DB_PSWD,DB_NAME) or die("error!");

   
    $userid=$_COOKIE['userid'];
    $sqlImg="SELECT * from profile where userid=$userid ";
    //echo $sqlImg;
    $resultImg=mysqli_query($dbcon,$sqlImg) or die("img fails");
    //$resultArr=mysqli_fetch_array($resultImg);
    while($rowImg=mysqli_fetch_assoc($resultImg))
    {
    	if($rowImg['status']==0)
    	{
    		//echo "null";
    		
    		$url='uploads/profile'."$userid".'.jpg';
    	
    	}
    	else
    	{
    		
    		$url='uploads/profiledefault.jpg';
    	}
    	setcookie("imgurl","$url");
    	//echo $url;
 		//echo "<img src=$url>";
 	}

?>
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
                <div class="col-md-6 column">
                    <h1>
                        profile:
                        <?php
                            $sql_getname="SELECT * FROM users WHERE userid=$userid";
                           // echo $sql_getname;
                            $result_getname=mysqli_query($dbcon,$sql_getname) or die("result_getname fails");
                            $row_getname=mysqli_fetch_array($result_getname);
                            $username=$row_getname['username'];
                            echo $username;
                        ?>
                    </h1>
                </div>
                <div class="col-md-6 column">
                    <br />
                    <br />
                    <p align="right">
                        <a href="index.php"> BACK TO HOME PAGE</a>
                    </p>
                </div>
            </div>
            <hr />
			

					
						
					<div class="container">
						    <br />
						  	
							<div class="row">
						      <!-- left column -->
						    <div class="col-md-3">
						        <div class="text-center">

						          <img src='<?php echo $url; ?>' class="img-circle" height="150" width="150">
						          <h6>Upload a different photo...</h6>
						          
						          <form action="upload.php" method="post" enctype="multipart/form-data">
						
										<p align="center">
									  <label for="file">Choose images to upload (PNG, JPG)</label>

									<input align="middle" type="file" name="file">
									
									<button type="submit" name="upload">UPLOAD</button>

                                        </p>
									</form>
									
						        </div>
						      </div>
						      

						      <div class="col-md-9 personal-info">
						        
						        
						        <?php
						        DEFINE ('DB_USER','root');
										DEFINE ('DB_PSWD','root');
										DEFINE ('DB_HOST','localhost');
										DEFINE ('DB_NAME','app');

										$dbcon=mysqli_connect(DB_HOST,DB_USER,DB_PSWD,DB_NAME) or die("error!");

						        			$userid=$_COOKIE['userid'];
						        			$username=$_COOKIE['username'];
						        			$useremail=$_COOKIE['email'];

											$sql0="SELECT * FROM profile where userid='$userid'";
											//echo $sql0;
											$sqlget0=mysqli_query($dbcon,$sql0)or die("error!!");
											$result0=mysqli_fetch_array($sqlget0);
											if($result0[0]!=null)
											{
                                            $newuser=$result0['username'];
                                            $newemail=$useremail;
                                            $newage=$result0['userage'];
                                            $newDOB=$result0['userDOB'];
                                            $newlocation=$result0['location'];
                                            $newgenre=$result0['genre'];
                                            $newfav=$result0['favoriate'];
                                            $newdes=$result0['user_description'];
											}
											
						        ?>
						        <form method="post" action="MANAGE.php"class="form-horizontal" role="form">
						        <input type="hidden" name="submitted" value="true"/>
						          <div class="form-group">
						            <label class="col-lg-3 control-label">Username:</label>
						            <div class="col-lg-8">
						              <input name='username' class="form-control" type="text" value=<?php if($newuser!=null) echo $newuser;?>>
						            </div>
						          </div>
						          <div class="form-group">
						            <label class="col-lg-3 control-label">userage:</label>
						            <div class="col-lg-8">
						              <input name='userage' class="form-control" type="text" value=<?php if($newage!=null) echo $newage;?>>
						            </div>
						          </div>
						          <div class="form-group">
						            <label class="col-lg-3 control-label">birth date:</label>
						            <div class="col-lg-8">
						              <input name='userDOB' class="form-control" type="date" value=<?php if($newDOB!=null) echo $newDOB;?>>
						            </div>
						          </div>
						          <div class="form-group">
						            <label class="col-lg-3 control-label">Email:</label>
						            <div class="col-lg-8">
						              <input name='useremail' readonly="readonly" class="form-control" type="text" value='<?php if($newemail!=null) echo $newemail;?>'>
						            </div>
						          </div>

						          <div class="form-group">
						            <label class="col-lg-3 control-label">location:</label>
						            <div class="col-lg-8">
						              <input name='location' class="form-control" type="text" value=<?php if($newlocation!=null) echo $newlocation;?>>
						            </div>
						          </div>

						          <div class="form-group">
						            <label class="col-lg-3 control-label">Favoriate bands/artists:</label>
						            <div class="col-lg-8">
						              <input name='favoriate' class="form-control" type="text" value=<?php if($newfav!=null) echo $newfav;?>>
						            </div>
						          </div>


						          <div class="form-group">
								        <label class="col-lg-3 control-label">music genres:</label>

								        <div class="col-lg-8">

								            <select name="music_genres[]" id="music genres" class="selectpicker show-menu-arrow form-control" multiple>
								                <option value="acoustic">acoustic</option>
								                  <option value="blues">blues</option>
								                  <option value="country">country</option>
								                  <option value="rock">rock</option>
								                  <option value="folk">folk</option>
								                  <option value="hiphop">hiphop</option>
								                  <option value="jazz">jazz</option>
								                  <option value="pop">pop</option>
								                  <option value="r&b">r&b</option>
								            </select>
								        </div>
								    </div>
								     <div class="form-group">
						            <label class="col-lg-3 control-label">user description:</label>
						            <div class="col-lg-8">
						              <input name='user_description' class="form-control" type="user_description:" value=<?php if($newdes!=null) echo $newdes;?>>
						            </div>
						          </div>
						          <div class="form-group">
						            <label class="col-md-3 control-label"></label>
						            <div class="col-md-8">

						              <input name="submit" method="post" type="submit" class="btn btn-primary" value="Save Changes">
<!--                                        -->
						              <span></span>
						              <input type="reset" class="btn btn-default" value="Cancel">
						            </div>
						          </div>

								    <script type="text/javascript">

								        	var str=<?php echo json_encode($newgenre); ?>;
											//document.write(str);
								        	var arr=str.split(',');
											var sel=document.getElementById("music genres");
											var len=sel.options.length;
											for(var i=0;i<arr.length;i++){
											    for(var j=0;j<len;j++){
											        if(sel.options[j].value==arr[i]){
											            sel.options[j].setAttribute("selected",true);
											            break;
											        }
											    }
											}

								        </script>
						         

						          
						          <?php
						          	if(isset($_POST['submitted']))
						          	{
										DEFINE ('DB_USER','root');
										DEFINE ('DB_PSWD','root');
										DEFINE ('DB_HOST','localhost');
										DEFINE ('DB_NAME','app');

										$dbcon=mysqli_connect(DB_HOST,DB_USER,DB_PSWD,DB_NAME);
									

										$username=$_POST['username'];
											$email=$_POST['useremail'];
											$age=$_POST['userage'];
											$DOB=$_POST['userDOB'];
											$location=$_POST['location'];
											foreach ($_POST['music_genres'] as $selectedOption)
												$genre=$selectedOption.",".$genre;
											//echo $genre;
											$fav=$_POST['favoriate'];
											$des=$_POST['user_description'];
											
											$iniphoto=fopen("cars_0001.jpg","r");
											//echo $myfile;
											$userid=$_COOKIE['userid'];
											//echo $userid;

											$sql0="SELECT * FROM profile where userid='$userid'";
											//echo $sql0;
											$sqlget0=mysqli_query($dbcon,$sql0)or die("error!!");
											$result0=mysqli_fetch_array($sqlget0);
											if($result0[0]==null)
											{
										$sql1="INSERT INTO profile(userid,username,userage,location,photo,useremail,userDOB,genre,user_description) values ($userid,'$username',$age,'$location','$iniphoto',$email','$DOB','$genre','$des')";
										echo "create successfully!";
										$sqlget1=mysqli_query($dbcon,$sql1)or die("error!!");
									}
									else
									{
										$sql2="UPDATE profile set username='$username',userage=$age,location='$location',photo='$url',useremail='$email',userDOB='$DOB',favoriate='$fav',genre='$genre',user_description='$des' where userid=$userid";
										//echo $sql2;
										$sqlget2=mysqli_query($dbcon,$sql2)or die("sql2 fails");
                                       echo "update successfully, please refresh again.";
                                       $sql3="UPDATE users set username='$username'";
                                       $sqlget3=mysqli_query($dbcon,$sql3) or die("sql3 fails");
                                       echo $sql3;
									}

									}
									
     
						          ?>

						        </form>
						      </div>
						  </div>
						</div>
						<hr>


                    </div>


			</div>

		</div>
	</div>
</div>

</body>
</html>
<script>

$(document).ready(function(){
  $('#insert').click(function(){
    var image_name=$('#image').val();
    if(image_name=='')

    {
      alert("please select iamge:");
      return false;
    }
    else
    {
      var extension=$('#image').val().split('.').pop().toLowerCase();
      if(jQuery.inArray(extension,['gif','png','jpg','jpeg'])==-1)
      {
        alert('invalid image file');
        $('#image').val('');
        retun false;
      }
    }
  });
});
</script>

