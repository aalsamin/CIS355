<!DOCTYPE html>
<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $part_idError = null;
        $supp_idError = null;
        $priceError = null;
        $delivery_daysError = null;
		
		$exPartError = null;
		$exSuppError = null;

        // keep track post values
        $part_id = $_POST['part_id'];
        $supp_id = $_POST['supp_id'];
        $price = $_POST['price'];
        $delivery_days = $_POST['delivery_days'];
		
		$exPart = $_POST['exPart'];
		$exSupp = $_POST['exSupp'];
         
        // validate input
        $valid = true;
        //if (empty($part_id)) {
        //    $part_idError = 'Please enter Part name';
        //    $valid = false;
        //}
        // 
        //if (empty($supp_id)) {
        //    $supp_idError = 'Please enter Supplier name';
        //    $valid = false;
        //}
         
        if (empty($price)) {
            $priceError = 'Please enter Price';
            $valid = false;
        }
		
		if (empty($delivery_days)) {
            $delivery_daysError = 'Please enter Delivery Days';
            $valid = false;
        }
		//echo "part_idError: " . $part_idError;
		//echo "supp_idError: " . $supp_idError;
		//echo "priceError: " . $priceError;
		//echo "delivery_daysError: " . $delivery_daysError;
		//echo "HELLO33"; exit();

        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO P_S (part_id,supp_id,price,delivery_days) values(?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($exPart,$exSupp,$price,$delivery_days));
			//echo "HELLO 19"; exit();
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
	
	<title>Create PS</title>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Create a PS</h3>
                    </div>
             
                    <form class="form-horizontal" action="PS_create.php" method="post">
                      <div class="control-group <?php echo !empty($part_idError)?'error':'';?>">
                        <label class="control-label">Part Name</label>
                        <div class="controls">
						  <?php
							$pdo = Database::connect();
							$sql = 'SELECT * FROM parts ORDER BY partName ASC';
							
							//echo "<select class='form-control' name='exPart' id='part_id'>";
							echo "<select name='exPart' id='part_id'>";
							//if($eventid) // if $_GET exists restrict person options to logged in user
								foreach ($pdo->query($sql) as $row) {
									//if($personid==$row['id'])
										echo "<option value='" . $row['id'] . " '> " . $row['partName'] . "</option>";
								}
							//else
								//foreach ($pdo->query($sql) as $row) 
									//echo "<option value='" . $row['id'] . " '> " . $row['name'] . "</option>";
								//}
							echo "</select>";
							Database::disconnect();
						  ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($supp_idError)?'error':'';?>">
                        <label class="control-label">Supplier Name</label>
                        <div class="controls">
						  <?php
							$pdo = Database::connect();
							$sql = 'SELECT * FROM suppliers ORDER BY suppName ASC';
							
							echo "<select name='exSupp' id='supp_id'>";
							//if($eventid) // if $_GET exists restrict person options to logged in user
								foreach ($pdo->query($sql) as $row) {
									//if($personid==$row['id'])
										echo "<option value='" . $row['id'] . " '> " . $row['suppName'] . "</option>";
								}
							//else
								//foreach ($pdo->query($sql) as $row) 
									//echo "<option value='" . $row['id'] . " '> " . $row['name'] . "</option>";
								//}
							echo "</select>";
							Database::disconnect();
						  ?>
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