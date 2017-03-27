<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
            <div class="row">
                <h3>PS CRUD</h3>
            </div>
            <div class="row">
			    <p>
                    <a href="PS_create.php" class="btn btn-success">Create</a>
                </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Part ID</th>
                      <th>Supplier ID</th>
					  <th>Price</th>
					  <th>Delivery Days</th>
					  <th>Action</th>
                    </tr>
                  </thead>
				  <?php
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM P_S ORDER BY id DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['part_id'] . '</td>';
                            echo '<td>'. $row['supp_id'] . '</td>';
                            echo '<td>'. $row['price'] . '</td>';
                            echo '<td>'. $row['delivery_days'] . '</td>';
							echo '<td width=250>';
                            echo '<a class="btn" href="PS_read.php?id='.$row['id'].'">Read</a>';
                            echo ' ';
                            echo '<a class="btn btn-success" href="PS_update.php?id='.$row['id'].'">Update</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="PS_delete.php?id='.$row['id'].'">Delete</a>';
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