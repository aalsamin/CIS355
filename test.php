<!DOCTYPE html>
<html>
<head>
<title>Abdulmohsen Alsamin</title>
</head>
<body>
<h1>Cubic Equation</h1>
<form action="test.php" method="post">
a: <input type="text" name="a"><br><br>
b: <input type="text" name="b"><br><br>
c: <input type="text" name="c"><br><br>
d: <input type="text" name="d"><br><br>
<input type="submit" value="Calculate"></button><br><br>
</form>

<?php
	$a = $_POST['a'];
	$b = $_POST['b'];
	$c = $_POST['c'];
	$d = $_POST['d'];
	$Q1 = (2 * $b ** 3 - 9 * $a * $b * $c + 27 * $a ** 2 * $d) ** 2; 
    $Q2 = (4 * ($b ** 2 - 3 * $a * $c)) ** 3; 
    $Q = (pow($Q1 - $Q2, 0.5)); 
             
    $C = pow(($Q + 2 * pow($b, 3) - 9 * $a * $b * $c + 27 * pow($a, 2) * $d) / 2, 1 / 3); 
	$x = 0 - (($b) / (3 * $a)) - (($C) / (3 * $a)) - ((pow(b, 2) - 3 * $a * $c) / (3 * $a * $C));
	echo 'X = ' . $x . '<br/>';
	echo '<br/>';
	echo '-----------------------------------------';
	echo '<br/><br/>';
	show_source(__FILE__);
?>
</body>
</html>