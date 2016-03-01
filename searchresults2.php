<?php
	include("dbconnect.php");

	if(!isset($_POST['search'])){
		header("Location:browse.php");
	}
	$search_sql=mysql_query("SELECT * FROM media WHERE filename LIKE '%".$_POST['search']."%' OR type LIKE '%".$_POST['search']."%'");

// if($search_sql)
//  $numrows = mysql_num_rows($search_sql);
//else
//  die("something failed"); 

	$search_query=mysql_query($search_sql);

	if(mysql_num_rows($search_query)!=0){
		$search_rs=mysql_fetch_assoc($search_query);
	}
?>

<p>Search Results</p>
<?php 
	if(mysql_num_rows($search_query)!=0){	
		do{ 
?>
			<p><?php echo $search_rs['name']; ?></p>
<?php		
		} while ($search_rs=mysql_fetch_assoc($search_query));	
	}
	else{
		echo"No results found";
	}
?>
	
