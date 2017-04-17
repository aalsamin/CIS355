<!DOCTYPE html>
<?php
    require 'database.php';
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: parts_crud.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $partNameError = null;
        $descriptionError = null;
        $lengthError = null;
        $widthError = null;
         
        // keep track post values
        $partName = $_POST['partName'];
        $description = $_POST['description'];
        $length = $_POST['length'];
        $width = $_POST['width'];
         
        // validate input
        $valid = true;
        if (empty($partName)) {
            $partNameError = 'Please enter Name';
            $valid = false;
        }
         
        if (empty($description)) {
            $descriptionError = 'Please enter Description';
            $valid = false;
        }
         
        if (empty($length)) {
            $lengthError = 'Please enter Length';
            $valid = false;
        }
		
		if (empty($width)) {
            $widthError = 'Please enter Width';
            $valid = false;
        }
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE parts  set partName = ?, description = ?, length = ?, width =? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($partName,$description,$length,$width,$id));
            Database::disconnect();
            header("Location: parts_crud.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM parts where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $partName = $data['partName'];
        $description = $data['description'];
        $length = $data['length'];
        $width = $data['width'];
        Database::disconnect();
    }
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<title>Update Part</title>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Update a Part</h3>
                    </div>
             
                    <form class="form-horizontal" action="parts_update.php?id=<?php echo $id?>" method="post">
                      <div class="control-group <?php echo !empty($partNameError)?'error':'';?>">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <input name="partName" type="text"  placeholder="Name" value="<?php echo !empty($partName)?$partName:'';?>">
                            <?php if (!empty($partNameError)): ?>
                                <span class="help-inline"><?php echo $partNameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($descriptionError)?'error':'';?>">
                        <label class="control-label">Description</label>
                        <div class="controls">
                            <input name="description" type="text" placeholder="Description" value="<?php echo !empty($description)?$description:'';?>">
                            <?php if (!empty($descriptionError)): ?>
                                <span class="help-inline"><?php echo $descriptionError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($lengthError)?'error':'';?>">
                        <label class="control-label">Length</label>
                        <div class="controls">
                            <input name="length" type="text"  placeholder="Lengthr" value="<?php echo !empty($length)?$length:'';?>">
                            <?php if (!empty($lengthError)): ?>
                                <span class="help-inline"><?php echo $lengthError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
					  <div class="control-group <?php echo !empty($widthError)?'error':'';?>">
                        <label class="control-label">Width</label>
                        <div class="controls">
                            <input name="width" type="text"  placeholder="Width" value="<?php echo !empty($width)?$width:'';?>">
                            <?php if (!empty($widthError)): ?>
                                <span class="help-inline"><?php echo $widthError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="parts_crud.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>