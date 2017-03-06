<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Golden Globe Search</title>
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:500,600,700">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700">
		<link rel="stylesheet" type="text/css" href="globe_style.css">
	</head>
	<body>
		<a href="index2.php">
			<header class="main-header">
				<h1>Golden Globe Search</h1>
				<h3>Search Winners from 2015-2017</h3>
			</header>
		</a>
		<div class="row">
			<section class="search">
				<div class="search-header">
					<h2>By Category/Year</h2>
				</div>
				<form action="" method="post">
					<label for="cat" >Category:</label>
					<select id="cat" name="cat">
						<option value="m">Motion Pictures</option>
						<option value="t">Television</option>
					</select>
					<label for="year1">Year:</label>
					<select id="year1" name="year1">
						<option value="2017">2017</option>
						<option value="2016">2016</option>
						<option value="2015">2015</option>
					</select>
					<input type="submit" name="cy_submit" value="Search">
				</form>
				<div class="results">
					<?php
					if (isset($_POST['cy_submit'])) {
						require_once('../mysqli_connect.php');
						$cat = $_POST["cat"];
						$year = $_POST["year1"];
						$query = "SELECT award.name AS globe, award.recipient, person.name AS personname, production.title, winner.song
						FROM winner
						LEFT OUTER JOIN award ON (winner.globeid = award.globeid)
						LEFT OUTER JOIN person ON (winner.personid = person.personid)
						LEFT OUTER JOIN production ON (winner.prodid = production.prodid)
						WHERE award.type = '$cat' AND winner.year = '$year'";
						
						$response = @mysqli_query($dbc, $query);
						
						if ($response) {
							echo '<p>';
							echo ($cat == 'm') ? 'Motion Picture' : 'Television';
							echo ' Awards (' . $year . ')</p><table id="cy">
							<tr><th>Award</th><th>Winner</th></tr>';
							while ($row = @mysqli_fetch_array($response)) {
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
							echo mysqli_error($dbc);
						}

						mysqli_close($dbc);
					}
					?>
				</div>
			</section>
			<section class="search">
				<div class="search-header">
					<h2>By Name/Title</h2>
				</div>
				<form action="" method="post">
					<input id="name" type="text" name="name" value="Name or Title">
					<input type="submit" name="nt_submit" value="Search">
				</form>
				<div class="results">
					<?php
					if (isset($_POST['nt_submit'])) {
						require_once('../mysqli_connect.php');
						$name = $_POST['name'];
						$query = "SELECT winner.year, award.name AS globe, person.name, production.title, award.recipient
						FROM winner
						LEFT OUTER JOIN award ON (winner.globeid = award.globeid)
						LEFT OUTER JOIN person ON (winner.personid = person.personid)
						LEFT OUTER JOIN production ON (winner.prodid = production.prodid)
						WHERE person.name LIKE '$name' OR production.title = '$name'";
						
						$response = @mysqli_query($dbc, $query);
						
						if ($response->num_rows > 0) {							
							echo '<p>' . $name . '</p><table id="nt">
							<tr><th>Year</th><th>Award</th></tr>';
							while ($row = @mysqli_fetch_array($response)) {
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
							echo mysqli_error($dbc);
						}

						mysqli_close($dbc);
					}
					?>
				</div>
			</section>
			<section class="search">
				<div class="search-header">
					<h2>By Award/Year</h2>
				</div>
				<form action="" method="post">
					<select id="award" name="award">
						<option value="1">Best Motion Picture - Drama</option>
						<option value="2">Best Motion Picture - Musical or Comedy</option>
						<option value="3">Best Director</option>
						<option value="4">Best Actor - Motion Picture Drama</option>
						<option value="5">Best Actor - Motion Picture Musical or Comedy</option>
						<option value="6">Best Actress - Motion Picture Drama</option>
						<option value="7">Best Actress - Motion Picture Musical or Comedy</option>
						<option value="8">Best Supporting Actor - Motion Picture</option>
						<option value="9">Best Supporting Actress - Motion Picture</option>
						<option value="10">Best Screenplay</option>
						<option value="11">Best Original Score</option>
						<option value="12">Best Original Song</option>
						<option value="13">Best Foreign Language Film</option>
						<option value="14">Best Animated Feature Film</option>
						<option value="15">Best Drama Series</option>
						<option value="16">Best Comedy Series</option>
						<option value="17">Best Actor in a Television Drama Series</option>
						<option value="18">Best Actor in a Television Comedy Series</option>
						<option value="19">Best Actress in a Television Drama Series</option>
						<option value="20">Best Actress in a Television Comedy Series</option>
						<option value="21">Best Limited Series or Motion Picture Made for Television</option>
						<option value="22">Best Actor in a Limited Series or Motion Picture Made for Television</option>
						<option value="23">Best Actress in a Limited Series or Motion Picture Made for Television</option>
						<option value="24">Best Supporting Actor in a Series, Limited Series or Motion Picture Made for Television</option>
						<option value="25">Best Supporting Actress in a Series, Limited Series or Motion Picture Made for Television</option>
						<option value="26">Cecil B. DeMille Award</option>
					</select>
					<br>
					<label for="year2">Year:</label>
					<select id="year2" name="year2">
						<option value="2017">2017</option>
						<option value="2016">2016</option>
						<option value="2015">2015</option>
					</select>
					<br>
					<input type="submit" name="ay_submit" value="Search">
				</form>
				<div class="results">
					<?php
					if (isset($_POST['ay_submit'])) {
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
					}
					?>
				</div>
			</section>
			<section class="search">
				<div class="search-header">
					<h2>Productions by Number of Awards</h2>
				</div>
				<form action="" method="post">
					<select id="numprod" name="numprod">
						<option value="2">At least 2</option>
						<option value="3">At least 3</option>
						<option value="4">At least 4</option>
						<option value="5">At least 5</option>
						<option value="6">At least 6</option>
					</select>
					<input type="submit" name="np_submit" value="Search">
				</form>
				<div class="results">
					<?php
					if (isset($_POST['np_submit'])) {
						require_once('../mysqli_connect.php');
						$num = $_POST['numprod'];
						$query = "SELECT production.title, COUNT(winner.prodid) AS numWins
						FROM winner
						LEFT OUTER JOIN production ON (winner.prodid = production.prodid)
						GROUP BY production.title
						HAVING COUNT(winner.prodid) >= '$num'
						ORDER BY 2 DESC";
						
						$response = @mysqli_query($dbc, $query);
						
						if ($response->num_rows > 0) {
							echo '<p>Productions with at least ' . $num . ' awards:</p><table>
							<tr><th>Title</th><th>Awards</th></tr>';
							while ($row = @mysqli_fetch_array($response)) {
								echo '<tr><td><em>' . $row['title'] . 
								'</em></td><td>'	. $row['numWins'] . '</td></tr>';
							}
							echo '</table>';
						} else if ($response) {
							echo '<p>Productions with at least ' . $num .
							' awards: Nothing found!</p>';
						} else {
							echo "Couldn't issue database query";
							echo mysqli_error($dbc);
						}

						mysqli_close($dbc);
					}
					?>
				</div>
			</section>
			<section class="search">
				<div class="search-header">
					<h2>People with Most Awards by Role</h2>
				</div>
				<form action="" method="post">
					<select id="role" name="role">
						<option value="a">Actor/Actress</option>
						<option value="d">Director</option>
					</select>
					<input type="submit" name="mp_submit" value="Search">
				</form>
				<div class="results">
					<?php
					if (isset($_POST['mp_submit'])) {
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
					}
					?>
				</div>
			</section>
		</div>
		<footer>
			<h3>SER 322 Team 8</h3>
			<ul>
				<li>Nam Nguyen</li>
				<li>Samuel Nixon</li>
				<li>Lowell Roxas</li>
				<li>Alexander Winchester</li>
				<li>Shinya Yamamoto</li>
			</ul>
		</footer>
	</body>
</html>