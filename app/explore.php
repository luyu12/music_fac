<?php
  $connect=mysqli_connect("localhost","root","root","app");
  if(isset($_POST["insert"]))
  {
    echo "click";
    $file=addslashes(file_get_contents($_FILES["image"]["tmp_name"]));
    $query="INSERT INTO profile(userid,photo) values (2,'$file') ";
    
    mysqli_query($connect,$query) or die("insert fails");
    
      //echo '<script>alert("image inserted into db")</script>';
    
  }

?>

<!DOCTYPE html>
<html>
  
     <meta charset="UTF-8">
  <title>Sign-Up/Login Form</title>
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  
      <link rel="stylesheet" href="css/style.css">

<body>
 
          
 <form method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="image" id="image" />
    <br />
    <input type="submit" id="insert" value="insert" name="insert" />
</form> 
<br />
<br />
<table class="table table-bordered">
<tr>
<th>image</th>
</tr>
<?php 
$query="SELECT photo from profile ";
echo $query;
$result=mysqli_query($connect,$query);
while($row=mysqli_fetch_array($result))
{
  echo '
  <tr>
  <td>
  <img src="data:image/jpeg;base64,'.base64_encode($row['photo']).'"/>
  </td>
  </tr>

  ';
}
?>
</table>


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


