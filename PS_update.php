<!DOCTYPE html>
<?php
    require 'database.php';
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: PS_crud.php");
    }
     
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
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE P_S  set part_id = ?, supp_id = ?, price = ?, delivery_days =? WHERE id = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($part_id,$supp_id,$price,$delivery_days,$id));
            Database::disconnect();
            header("Location: PS_crud.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM P_S where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $part_id = $data['part_id'];
        $supp_id = $data['supp_id'];
        $price = $data['price'];
        $delivery_days = $data['delivery_days'];
        Database::disconnect();
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
                        <h3>Update a PS</h3>
                    </div>
             
                    <form class="form-horizontal" action="PS_update.php?id=<?php echo $id?>" method="post">
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
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="PS_crud.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>