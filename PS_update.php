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
		
		$exPartError = null;
		$exSuppError = null;
         
        // keep track post values
        //$part_id = $_POST['part_id'];
        //$supp_id = $_POST['supp_id'];
        $price = $_POST['price'];
        $delivery_days = $_POST['delivery_days'];
		
		$exPart = $_POST['exPart'];
		$exSupp = $_POST['exSupp'];
         
        // validate input
        $valid = true;
        //if (empty($part_id)) {
        //    $part_idError = 'Please enter Part Name';
        //    $valid = false;
        //}
        // 
        //if (empty($supp_id)) {
        //    $supp_idError = 'Please enter Supplier Name';
        //    $valid = false;
        //}
         
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
            $q->execute(array($exPart,$exSupp,$price,$delivery_days,$id));
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
        $exPart = $data['part_id'];
        $exSupp = $data['supp_id'];
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
	
	<title>Update PS</title>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Update a PS</h3>
                    </div>
             
                    <form class="form-horizontal" action="PS_update.php?id=<?php echo $id?>" method="post">
                      <div class="control-group">
                        <label class="control-label">Part Name</label>
                        <div class="controls">
                            <?php
							$pdo = Database::connect();
							$sql = 'SELECT * FROM parts ORDER BY partName ASC';
							
							echo "<select name='exPart' id='part_id'>";
							//if($eventid) // if $_GET exists restrict person options to logged in user
								foreach ($pdo->query($sql) as $row) {
									//if($personid==$row['id'])
									if($row["id"]==$exPart)
										echo "<option selected value='" . $row['id'] . " '> " . $row['partName'] . "</option>";
									else
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
									if($row["id"]==$exSupp)
										echo "<option selected value='" . $row['id'] . " '> " . $row['suppName'] . "</option>";
									else
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
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="PS_crud.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>