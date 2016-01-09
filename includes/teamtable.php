<?php


	$tempSel = new Select();
	$teams = $tempSel->getTeamTable(1);
	echo '</table>';

	echo '<table class="table table-striped">';
	echo '<tr>
	<th>Team name</th>
	<th>Points</th>
	<th>Goals</th>
	<th>Matches</th>
  </tr>';
	foreach ($teams as $team) {
		echo '<tr>';
			echo '<td>' . $team['name'] . "</td>";
			echo '<td>' . $team['points'] . "</td>";
			echo '<td>' . $team['goals'] . "</td>";
			echo '<td>' . $team['matches'] . "</td>";
		echo '</tr>';
	}
	echo '</table>';


?>
