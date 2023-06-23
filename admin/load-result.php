<?php

$conn = mysqli_connect("localhost","root","","ebms") or die("Connection Failed");

$search_term = $_POST['searchInput'];

$sql = "SELECT distinct payMathod,trxID FROM payments WHERE payMathod LIKE '%{$search_term}%' OR trxID LIKE '%{$search_term}%' and paystats='Approve'";
$result = mysqli_query($conn, $sql) or die("SQL Query Failed.");

$output = "<ul style='padding: 5px 10px;z-index: 9999;position: absolute;background: #fff;cursor: pointer;width: 100px;'>";

	if(mysqli_num_rows($result) > 0){  
		while($row = mysqli_fetch_assoc($result)){
			$output .= "<li style='list-style:none; margin-left:0;'>{$row['payMathod']}</li>
			<li style='list-style:none; margin-left:0;'>{$row['trxID']}</li>";
		}
  }else{  
  	$output .= "<li style='list-style:none; margin-left:0;'>City Not Found</li>";exit;
  } 
$output .= "</ul>";

echo $output;

?>
