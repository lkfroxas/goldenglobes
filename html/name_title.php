<?php
// require_once('../mysqli_connect.php');
require_once('../mssql_connect.php');
$name = $_POST['name'];
$query = "SELECT winner.year, award.name AS globe, person.name, production.title, award.recipient
FROM winner
LEFT OUTER JOIN award ON (winner.globeid = award.globeid)
LEFT OUTER JOIN person ON (winner.personid = person.personid)
LEFT OUTER JOIN production ON (winner.prodid = production.prodid)
WHERE person.name LIKE '$name' OR production.title = '$name'";

// $response = @mysqli_query($dbc, $query);
$response = sqlsrv_query($dbc, $query);

if ($response->num_rows > 0) {							
	echo '<p>' . $name . '</p><table id="nt">
	<tr><th>Year</th><th>Award</th></tr>';
	// while ($row = @mysqli_fetch_array($response)) {
    while ($row = sqlsrv_fetch_array($response)) {
		echo '<tr><td>' . $row['year'] . '</td>
			<td>' . $row['globe'];
		if ($row['recipient'] == 'b') {
			if ($name == $row['title']) {
				echo ' (' . $row['name'] . ')';
			} else if ($name == $row['name']) {
				echo '<em>(' . $row['title'] . ')</em>';
			}
		}
		echo '</td></tr>';
	}
	echo '</table>';
} else if ($response) {
	echo '<p>' . $name . ': Nothing found!</p>';
} else {
	echo "Couldn't issue database query";
	// echo mysqli_error($dbc);
    echo sqlsrv_errors();
}

// mysqli_close($dbc);
sqlsrv_free_stmt($response);
sqlsrv_close($dbc);
?>