<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<title>PS CRUD</title>
</head>
 
<body>
    <div class="container">
            <div class="row">
                <h3>PS CRUD</h3>
            </div>
            <div class="row">
				<p>
                    <a href="1project.php" class="btn btn-success">Main Page</a>
                    <a href="logout.php" class="btn btn-success">logout</a>
                </p>
			    <p>
                    <a href="PS_create.php" class="btn btn-success">Create</a>
                </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Part Name</th>
                      <th>Supplier Name</th>
					  <th>Price</th>
					  <th>Delivery Days</th>
					  <th>Action</th>
                    </tr>
                  </thead>
				  <?php
				  session_start();
				  
                   include 'database.php';
                   $pdo = Database::connect();
                   //$sql = 'SELECT * FROM P_S ORDER BY id DESC';
				   $sql = "SELECT * FROM P_S 
						LEFT JOIN parts ON parts.id = P_S.part_id 
						LEFT JOIN suppliers ON suppliers.id = P_S.supp_id;";
						
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['partName'] . '</td>';
                            echo '<td>'. $row['suppName'] . '</td>';
                            echo '<td>'. $row['price'] . '</td>';
                            echo '<td>'. $row['delivery_days'] . '</td>';
							echo '<td width=250>';
                            echo '<a class="btn" href="PS_read.php?id='.$row[0].'">Read</a>';
                            echo ' ';
                            echo '<a class="btn btn-success" href="PS_update.php?id='.$row[0].'">Update</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="PS_delete.php?id='.$row[0].'">Delete</a>';
                            echo '</td>';
                            echo '</tr>';
                   }
                   Database::disconnect();
                  ?>
                  <tbody>
            </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>