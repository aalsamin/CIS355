<?php
session_start();
//connect to database
$db=mysqli_connect("localhost","aalsamin","Aal4242samin","aalsamin");
if(isset($_POST['login_btn']))
{
    //$username=mysql_real_escape_string($_POST['username']);
    $username=$_POST['username'];
    //$password=mysql_real_escape_string($_POST['password']);
    $password=$_POST['password'];
    $password=md5($password); //Remember we hashed password before storing last time
    $sql="SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result=mysqli_query($db,$sql);
    if(mysqli_num_rows($result)==1)
    {
        $_SESSION['message']="You are now Logged In";
        $_SESSION['username']=$username;
        header("location:1project.php");
    }
   else
   {
                $_SESSION['message']="Username and Password combiation incorrect";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <!--<link rel="stylesheet" type="text/css" href="style.css"/>-->
  <meta charset="utf-8">
  <link   href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="header">
<div class="container">
    <div class="span10 offset1">
        <div class="row">
			<h1>Login</h1><br>
		</div>
<?php
    if(isset($_SESSION['message']))
    {
         echo "<label class='control-label'><font color='red'>".$_SESSION['message']."</font></label>";
         unset($_SESSION['message']);
    }
?>
<form method="post" action="index.php">

		   <label class="control-label">Username</label>
           <div class="controls"><input type="text" name="username" class="textInput"></div>
		   
		   <label class="control-label">Password</label>
           <div class="controls"><input type="password" name="password" class="textInput"></div>
		   
           <br><input type="submit" name="login_btn" class="btn btn-success">
		   
		   <a class="btn btn-danger" href="register.php">Click here to sign up</a></br>
</form>
</div>
</div>
</div>
</body>
</html>
 
 
<!--
In 2 minutes 8 second you don a mistake then last time only you found
In 2 minutes 49 second you done a mistake then last time only you found
Please Change this Your Video Length is Decrease
Your Suscribers will increase
I Like and Thanks for  Who are all Helping to Create this Video
 
About Me: www.visualcv.com/karthickraja
-->