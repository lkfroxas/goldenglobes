<?php
// require_once('../mysqli_connect.php');
require_once('../mssql_connect.php');
$cat = $_POST["cat"];
$year = $_POST["year1"];
$query = "SELECT award.name AS globe, award.recipient, person.name AS personname, production.title, winner.song
FROM winner
LEFT OUTER JOIN award ON (winner.globeid = award.globeid)
LEFT OUTER JOIN person ON (winner.personid = person.personid)
LEFT OUTER JOIN production ON (winner.prodid = production.prodid)
WHERE award.type = '$cat' AND winner.year = '$year'";

// $response = @mysqli_query($dbc, $query);
$response = sqlsrv_query($dbc, $query);

if ($response) {
	echo '<p>';
	echo ($cat == 'm') ? 'Motion Picture' : 'Television';
	echo ' Awards (' . $year . ')</p><table id="cy">
	<tr><th>Award</th><th>Winner</th></tr>';
	// while ($row = @mysqli_fetch_array($response)) {
    while ($row = sqlsrv_fetch_array($response)) {
		echo '<tr><td>' . $row['globe'] . '</td><td>';
		if ($row['recipient' == 'i'] || $row['recipient'] == 'b') {
			echo $row['personname'];
		}
		if ($row['recipient'] == 'b') {
			echo ' - ';
		}
		if ($row['recipient'] = 'p' || $row['recipient'] == 'b') {
			echo '<em>' . $row['title'] . '</em>';
		}
		if ($row['song']) {
			echo ', "' . $row['song'] . '"';
		}
		echo '</td>';
	}
	echo '</table>';
} else {
	echo "Couldn't issue database query";
	// echo mysqli_error($dbc);
    echo sqlsrv_errors();
}

// mysqli_close($dbc);
sqlsrv_free_stmt($response);
sqlsrv_close($dbc);
?>