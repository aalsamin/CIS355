<?php
    require 'database.php';
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: PS_crud.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
        $sql = "SELECT * FROM P_S where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        $data = $q->fetch(PDO::FETCH_ASSOC);
		
		$sql = "SELECT * FROM parts where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($data['part_id']));
        $partData = $q->fetch(PDO::FETCH_ASSOC);
		
		$sql = "SELECT * FROM suppliers where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($data['supp_id']));
        $suppData = $q->fetch(PDO::FETCH_ASSOC);
		
        Database::disconnect();
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<title>Read PS</title>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Read a PS</h3>
                    </div>
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Part Name</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $partData['partName'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Supplier Name</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $suppData['suppName'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Price</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['price'];?>
                            </label>
                        </div>
                      </div>
					  <div class="control-group">
                        <label class="control-label">Delivery Days</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['delivery_days'];?>
                            </label>
                        </div>
                      </div>
                        <div class="form-actions">
                          <a class="btn" href="PS_crud.php">Back</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>