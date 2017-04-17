<?php
//  ini_set('file-uploads', true);
//	  
//  if($_FILES['file1']['size']>0 && $_FILES['file1']['size']<2000000){
//	  
//	$filename = $_FILES['file1']['name'];
//	$tempname = $_FILES['file1']['temp_name'];
//	$filesize = $_FILES['file1']['size'];
//	$filetype = $_FILES['file1']['type'];
//	
//	$filetype = (get_magic_quotes_gpc() == 0
//		? mysql_real_escape_string($filetype)
//		: mysql_real_escape_string(stripslashes($_FILES['file1'])));
//		
//	$fp = fopen($tempname, 'r');
//	$content = fread($fp, filesize($tempname));
//	$content = addslashes($content);
//	
//	echo 'filename: ' . $filename . '<br />';
//	echo 'filesize: ' . $filesize . '<br />';
//	echo 'filetype: ' . $filetype . '<br />';
//	
//	fclose($fp);
//	
//	if(!get_magic_quotes_gpc()){
//		$filename = addslashes($filename);
//	}
//	$con = mysql_connect('localhost','aalsamin','Aal4242samin') 
//                     or die(mysql_error());
//                   $db  = mysql_select_db('aalsamin',$con);
//                   if($db)
//                   {
//                     $query = "INSERT INTO upload (name, size, type, content) ".
//                 	  "VALUES ('$fileName', '$fileSize', '$fileType', '$content')";
//                 	mysql_query($query) or die('Error... query failed!');
//                 	mysql_close();
//                 	echo "<br />File $fileName uploaded successfully <br />";
//                   }
//                   else
//                   {
//                     echo "file upload failed: " . mysql_error();
//                   }
//
//  }
//  
//?>

<?php
$id = null;
if ( !empty($_GET['id'])) {
  $id = $_REQUEST['id'];
}
ini_set('file-uploads', true);
if($_FILES['file1']['size']>0 && $_FILES['file1']['size'] < 2000000){
	
	$tempname = $_FILES['file1']['tmp_name'];
	$fp = fopen($tempname, 'rb');
	$content = fread($fp, filesize($tempname));
	fclose($fp);
	
	include 'database.php';
	$pdo = Database::connect();
	$sql = "UPDATE suppliers set picture = ? WHERE id = ?";
	$q = $pdo->prepare($sql);
	$q->execute(array($content,$id));
	Database::disconnect();
	//header('Location: suppliers_update.php?id=' . $id);
}
?>

<!DOCTYPE html>
<form action='upload.php?id=<?php echo $id?>' enctype='multipart/form-data' method='post'>
	Choose File:
	<input type='file' name='file1' id='file1'>
	<br/>
	<input type='submit' />
</form>