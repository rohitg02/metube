

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Search Engine - Search</title>
<!--<link href="search.css" type="text/css" rel="stylesheet" />-->

</head>

<body>
	<center>
	<form action='searchresults.php' method='post'>
		<input type='text' name='search' placeholder='Search' required /> 
		<input type='submit' value='Search' />
	</form>
    </center>
    <br/>
    


<?php
$output=NULL;
	
	include "dbconnect.php";
	$output=NULL;
	$download= NULL;
	$link="media.php?id=";
	if(isset($_POST['search'])!=NULL){
		$searchq = $_POST['search'];
		$searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
		
		$query = mysql_query("SELECT * FROM media WHERE filename LIKE '%".$searchq."%';") or die("Could not find: ".mysql_error($con));
		//checking number of rows.
		
		$count = mysql_num_rows($query);
		if($count == NULL){
			$output = 'There were no search results';
		}
		
		else{
			while($row = mysql_fetch_array($query)){
				$filename = $row['filename'];
				$mediaid =$row['mediaid'];
				$path = $row['path'];
				$output .="<a href=$link$mediaid> $filename</a><br>";
				$download .="<a href= $path onclick=javascript:saveDownload($path)> Download</a><br>";
			}
		}
	}
	else
	print($_POST['search']);
?>

<!-- Print search results-->
<?php 
Echo($output);
Echo($download);
?>
	
	


</body>
</html>
