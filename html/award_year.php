<?php
require_once('../mysqli_connect.php');
$award = $_POST['award'];						
$year = $_POST['year2'];
$query = "SELECT award.recipient, award.name AS globe, person.name, production.title, winner.song
FROM winner
LEFT OUTER JOIN award ON (winner.globeid = award.globeid)
LEFT OUTER JOIN person ON (winner.personid = person.personid)
LEFT OUTER JOIN production ON (winner.prodid = production.prodid)
WHERE award.globeid = '$award' AND winner.year = '$year'";

$response = @mysqli_query($dbc, $query);

if ($response) {
	$row = @mysqli_fetch_array($response); 
	echo '<p>' . $row['globe'] . ' (' . $year . '): ';
	if ($row['recipient' == 'i'] || $row['recipient'] == 'b') {
		echo $row['name'];
	}
	if ($row['recipient'] == 'b') {
		echo ' - ';
	}
	if ($row['recipient'] == 'p' || $row['recipient'] == 'b') {
		echo '<em>' . $row['title'] . '</em>';
	}
	if ($row['song']) {
		echo ', "' . $row['song'] . '"';
	}
	echo '</p>';
} else {
	echo "Couldn't issue database query";
	echo mysqli_error($dbc);
}

mysqli_close($dbc);
?>