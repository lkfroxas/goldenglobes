<?php
// require_once('../mysqli_connect.php');
require_once('../mssql_connect.php');
$num = $_POST['numprod'];
$query = "SELECT production.title, COUNT(winner.prodid) AS numWins
FROM winner
LEFT OUTER JOIN production ON (winner.prodid = production.prodid)
GROUP BY production.title
HAVING COUNT(winner.prodid) >= '$num'
ORDER BY 2 DESC";

// $response = @mysqli_query($dbc, $query);
$response = sqlsrv_query($dbc, $query);

if ($response->num_rows > 0) {
	echo '<p>Productions with at least ' . $num . ' awards:</p><table>
	<tr><th>Title</th><th>Awards</th></tr>';
	// while ($row = @mysqli_fetch_array($response)) {
    while ($row = sqlsrv_fetch_array($response)) {
		echo '<tr><td><em>' . $row['title'] . 
		'</em></td><td>'	. $row['numWins'] . '</td></tr>';
	}
	echo '</table>';
} else if ($response) {
	echo '<p>Productions with at least ' . $num .
	' awards: Nothing found!</p>';
} else {
	echo "Couldn't issue database query";
	// echo mysqli_error($dbc);
    echo sqlsrv_errors();
}

// mysqli_close($dbc);
sqlsrv_free_stmt($response);
sqlsrv_close($dbc);
?>