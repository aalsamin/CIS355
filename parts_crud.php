<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	
	<title>Parts CRUD</title>
</head>
 
<body>
    <div class="container">
            <div class="row">
                <h3>Parts CRUD</h3>
            </div>
            <div class="row">
				<p>
                    <a href="1project.php" class="btn btn-success">Main Page</a>
                    <a href="logout.php" class="btn btn-success">logout</a>
                </p>
			    <p>
                    <a href="parts_create.php" class="btn btn-success">Create</a>
                </p>			    
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Description</th>
                      <th>Length</th>
					  <th>Width</th>
					  <th>Action</th>
                    </tr>
                  </thead>
				  <?php
                   include 'database.php';
                   $pdo = Database::connect();
                   $sql = 'SELECT * FROM parts ORDER BY id DESC';
                   foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<td>'. $row['partName'] . '</td>';
                            echo '<td>'. $row['description'] . '</td>';
                            echo '<td>'. $row['length'] . '</td>';
                            echo '<td>'. $row['width'] . '</td>';
							echo '<td width=250>';
                            echo '<a class="btn" href="parts_read.php?id='.$row['id'].'">Read</a>';
                            echo ' ';
                            echo '<a class="btn btn-success" href="parts_update.php?id='.$row['id'].'">Update</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="parts_delete.php?id='.$row['id'].'">Delete</a>';
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