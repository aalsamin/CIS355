<!DOCTYPE html>
<?php
	 
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $descriptionError = null;
        $lengthError = null;
        $widthError = null;
         
        // keep track post values
        $name = $_POST['name'];
        $description = $_POST['description'];
        $length = $_POST['length'];
        $width = $_POST['width'];
         
        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter Name';
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
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO parts (name,description,length,width) values(?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($name,$description,$length,$width));
            Database::disconnect();
            header("Location: parts_crud.php");
        }
    }
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Create a Part</h3>
                    </div>
             
                    <form class="form-horizontal" action="parts_create.php" method="post">
                      <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <input name="name" type="text"  placeholder="Name" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
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
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="parts_crud.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>