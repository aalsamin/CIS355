<!DOCTYPE html>
<?php
    require 'database.php';
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: suppliers_crud.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $suppNameError = null;
        $emailError = null;
        $mobileError = null;
		$pictureError = null;
         
        // keep track post values
        $suppName = $_POST['suppName'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $picture = $_POST['picture'];
		
		$fileName = $_FILES['userfile']['name'];
		$tmpName  = $_FILES['userfile']['tmp_name'];
		$fileSize = $_FILES['userfile']['size'];
		$fileType = $_FILES['userfile']['type'];
		$filecontent = file_get_contents($tmpName);
		
        // validate input
        $valid = true;
        if (empty($suppName)) {
            $suppNameError = 'Please enter suppName';
            $valid = false;
        }
         
        if (empty($email)) {
            $emailError = 'Please enter Email Address';
            $valid = false;
        } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
            $emailError = 'Please enter a valid Email Address';
            $valid = false;
        }
         
        if (empty($mobile)) {
            $mobileError = 'Please enter Mobile Number';
            $valid = false;
        }
         
        // update data
     if ($valid) {
		if($fileSize > 0) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE suppliers set suppName = ?, email = ?, mobile =?, filename = ?,filesize = ?,filetype = ?,filecontent = ? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($suppName,$email,$mobile,$fileName,$fileSize,$fileType,$filecontent,$id));
            Database::disconnect();
            header("Location: suppliers_crud.php");
			}
        
		else {
			$pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE suppliers  set suppName = ?, email = ?, mobile =? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($suppName,$email,$mobile,$id));
            Database::disconnect();
            header("Location: suppliers_crud.php");
		}
	}
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM suppliers where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $suppName = $data['suppName'];
        $email = $data['email'];
        $mobile = $data['mobile'];
        Database::disconnect();
    }
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<title>Update Supplier</title>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Update a Supplier</h3>
                    </div>
             
                    <form class="form-horizontal" action="suppliers_update.php?id=<?php echo $id?>" method="post" enctype="multipart/form-data">
                      <div class="control-group <?php echo !empty($suppNameError)?'error':'';?>">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <input name="suppName" type="text"  placeholder="Name" value="<?php echo !empty($suppName)?$suppName:'';?>">
                            <?php if (!empty($suppNameError)): ?>
                                <span class="help-inline"><?php echo $suppNameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($emailError)?'error':'';?>">
                        <label class="control-label">Email Address</label>
                        <div class="controls">
                            <input name="email" type="text" placeholder="Email Address" value="<?php echo !empty($email)?$email:'';?>">
                            <?php if (!empty($emailError)): ?>
                                <span class="help-inline"><?php echo $emailError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($mobileError)?'error':'';?>">
                        <label class="control-label">Mobile Number</label>
                        <div class="controls">
                            <input name="mobile" type="text"  placeholder="Mobile Number" value="<?php echo !empty($mobile)?$mobile:'';?>">
                            <?php if (!empty($mobileError)): ?>
                                <span class="help-inline"><?php echo $mobileError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
					  
						<div class="control-group <?php echo !empty($pictureError)?'error':'';?>">
						<label class="control-label">Picture</label>
						<div class="controls">
						<input type="hidden" name="MAX_FILE_SIZE" value="16000000">
						<input name="userfile" type="file" id="userfile">
						</div>
						</div>
					  
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="suppliers_crud.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>