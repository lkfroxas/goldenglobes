<?php
require_once('../mysqli_connect.php');
$role = $_POST['role'];
$query = "SELECT person.name, COUNT(winner.personid) AS numWins
FROM winner
JOIN person on (winner.personid = person.personid)
WHERE winner.role = '$role'
GROUP BY person.name
HAVING numWins = (
	SELECT MAX(n.count) FROM (
		SELECT COUNT(winner.personid) AS count
		FROM winner
		JOIN person on (winner.personid = person.personid)
		WHERE winner.role = '$role'
		GROUP BY person.name
	)
	AS n
)";

$response = @mysqli_query($dbc, $query);

if ($response->num_rows > 0) {
	echo '<p>';
	echo ($_POST['role'] == 'a') ? 'Actors/Actresses' : 'Directors';
	echo ' with the most awards:</p><table><tr><th>Name</th><th>Awards</th></tr>';
	while ($row = @mysqli_fetch_array($response)) {
		echo '<tr><td>' . $row['name'] . '</td><td>' . $row['numWins'] . '</td></tr>';
	}
	echo '</table>';
} else if ($response) {
	echo '<p>';
	echo ($_POST['role'] == 'a') ? 'Actor/Actresses' : 'Directors';
	echo ' with the most awards: Nothing found!</p>';
} else {
	echo "Couldn't issue database query";
	echo mysqli_error($dbc);
}

mysqli_close($dbc);
?>