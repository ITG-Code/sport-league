<?php


	$tempSel = new Select();
	$teams = $tempSel->getTeamTable(1);
	echo "<div class='well row'>";
	echo "<h2>Scoreboard</h2>";
	echo '</table>'."\n";

	echo '<table class="table table-striped">'."\n";
	echo "<tr>\n
	<th>Team name</th>\n
	<th>Points</th>\n
	<th>Goals</th>\n
	<th>Matches</th>\n
  </tr>\n";
	foreach ($teams as $team) {
		echo "<tr>\n";
			echo '<td>' . $team['name'] . "</td>\n";
			echo '<td>' . $team['points'] . "</td>\n";
			echo '<td>' . $team['goals'] . "</td>\n";
			echo '<td>' . $team['matches'] . "</td>\n";
		echo '</tr>';
	}
	echo "</table>\n";
	echo "</div>";


?>
