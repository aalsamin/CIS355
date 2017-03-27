<!DOCTYPE html>
<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $part_idError = null;
        $supp_idError = null;
        $priceError = null;
        $delivery_daysError = null;
         
        // keep track post values
        $part_id = $_POST['part_id'];
        $supp_id = $_POST['supp_id'];
        $price = $_POST['price'];
        $delivery_days = $_POST['delivery_days'];
         
        // validate input
        $valid = true;
        if (empty($part_id)) {
            $part_idError = 'Please enter Part ID';
            $valid = false;
        }
         
        if (empty($supp_id)) {
            $supp_idError = 'Please enter Supplier ID';
            $valid = false;
        }
         
        if (empty($price)) {
            $priceError = 'Please enter Price';
            $valid = false;
        }
		
		if (empty($delivery_days)) {
            $priceError = 'Please enter Delivery Days';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO P_S (part_id,supp_id,price,delivery_days) values(?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($part_id,$supp_id,$price,$delivery_days));
            Database::disconnect();
            header("Location: PS_crud.php");
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
                        <h3>Create a PS</h3>
                    </div>
             
                    <form class="form-horizontal" action="PS_create.php" method="post">
                      <div class="control-group <?php echo !empty($part_idError)?'error':'';?>">
                        <label class="control-label">Part ID</label>
                        <div class="controls">
                            <input name="part_id" type="text"  placeholder="Part ID" value="<?php echo !empty($part_id)?$part_id:'';?>">
                            <?php if (!empty($part_idError)): ?>
                                <span class="help-inline"><?php echo $part_idError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($supp_idError)?'error':'';?>">
                        <label class="control-label">Supplier ID</label>
                        <div class="controls">
                            <input name="supp_id" type="text" placeholder="Supplier ID" value="<?php echo !empty($supp_id)?$supp_id:'';?>">
                            <?php if (!empty($supp_idError)): ?>
                                <span class="help-inline"><?php echo $supp_idError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($priceError)?'error':'';?>">
                        <label class="control-label">Price</label>
                        <div class="controls">
                            <input name="price" type="text"  placeholder="Price" value="<?php echo !empty($price)?$price:'';?>">
                            <?php if (!empty($priceError)): ?>
                                <span class="help-inline"><?php echo $priceError;?></span>
                            <?php endif;?>
                        </div>
                      </div>                      
					  <div class="control-group <?php echo !empty($delivery_daysError)?'error':'';?>">
                        <label class="control-label">Delivery Days</label>
                        <div class="controls">
                            <input name="delivery_days" type="text"  placeholder="Delivery Days" value="<?php echo !empty($delivery_days)?$delivery_days:'';?>">
                            <?php if (!empty($delivery_daysError)): ?>
                                <span class="help-inline"><?php echo $delivery_daysError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="PS_crud.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>