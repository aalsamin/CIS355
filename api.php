<?php
                   include 'database.php';
                   $pdo = Database::connect();
				   if($_GET['id'])
					   $sql = "SELECT * from suppliers WHERE id=" . $_GET['id'];
				   else
					   $sql = "SELECT * from suppliers";
				   
				   $arr = array();
				   
                   foreach ($pdo->query($sql) as $row) {
					   array_push($arr, $row['suppName']);
					   
                   }
                   Database::disconnect();
				   echo '{"names": ' . json_encode($arr) . '}';
?>