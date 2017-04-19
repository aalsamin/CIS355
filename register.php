<?php
// from: https://www.youtube.com/watch?v=lGYixKGiY7Y

session_start();
//connect to database
$db=mysqli_connect("localhost","aalsamin","Aal4242samin","aalsamin");
if(isset($_POST['register_btn']))
{
	$usernameError = null;
	$emailError = null;
	$passwordError = null;
	$password2Error = null;
	
    //$username=mysql_real_escape_string($_POST['username']);
	$username=$_POST['username'];
    //$email=mysql_real_escape_string($_POST['email']);
	$email=$_POST['email'];
    //$password=mysql_real_escape_string($_POST['password']);
	$password=$_POST['password'];
    //$password2=mysql_real_escape_string($_POST['password2']);
	$password2=$_POST['password2'];
	
	$valid = true;
        if (empty($username)) {
            $usernameError = 'Please enter Username';
            $valid = false;
        }
         
        if (empty($email)) {
            $emailError = 'Please enter Email';
            $valid = false;
        }
         
        if (empty($password)) {
            $passwordError = 'Please enter Password';
            $valid = false;
        }
		
		if (empty($password2)) {
            $password2Error = 'Please re-enter Password';
            $valid = false;
        }
		
	if ($valid) {
     if($password==$password2)
     {           //Create User
            $password=md5($password); //hash password before storing for security purposes
            $sql="INSERT INTO users(username,email,password) VALUES('$username','$email','$password')";
            mysqli_query($db,$sql);  
            $_SESSION['message']="You are now logged in"; 
            $_SESSION['username']=$username;
            header("location:index.php");  //redirect home page
    }
    else
    {
      $_SESSION['message']="The two password do not match";   
     }
	}
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Register</title>
  <meta charset="utf-8">
  <link   href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="header">
<div class="container">
    <div class="span10 offset1">
        <div class="row">
			<h1>Register</h1>
		</div>
<?php
    if(isset($_SESSION['message']))
    {
         echo "<label class='control-label'><font color='red'>".$_SESSION['message']."</font></label>";
         unset($_SESSION['message']);
    }
?>
<form method="post" action="register.php">

		   <div class="control-group <?php echo !empty($usernameError)?'error':'';?>">
		   <label class="control-label">Username</label>
           <div class="controls">
		   <input type="text" name="username" class="textInput">
		   <?php if (!empty($usernameError)): ?>
		       <span class="help-inline"><?php echo $usernameError;?></span>
		   <?php endif; ?>
		   </div><br>

		   <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
		   <label class="control-label">Email</label>
           <div class="controls">
		   <input type="email" name="email" class="textInput">
		   <?php if (!empty($emailError)): ?>
		       <span class="help-inline"><?php echo $emailError;?></span>
		   <?php endif; ?>
		   </div><br>

		   <div class="control-group <?php echo !empty($passwordError)?'error':'';?>">
		   <label class="control-label">Password</label>
           <div class="controls">
		   <input type="password" name="password" class="textInput">
		   <?php if (!empty($passwordError)): ?>
		       <span class="help-inline"><?php echo $passwordError;?></span>
		   <?php endif; ?>
		   </div><br>

		   <div class="control-group <?php echo !empty($password2Error)?'error':'';?>">
		   <label class="control-label">Password again</label>
           <div class="controls">
		   <input type="password" name="password2" class="textInput">
		   <?php if (!empty($password2Error)): ?>
		       <span class="help-inline"><?php echo $password2Error;?></span>
		   <?php endif; ?>
		   </div><br>

           <div class="controls"><input type="submit" name="register_btn" class="btn btn-success"></div><br>
     </tr>
  
</table>
</form>
</div>
</div>
</div>
</body>
</html>
