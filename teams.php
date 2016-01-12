<div class="col-md-3"></div>
<div class="row col-md-6 well">
	<div class="row">
	<div class="col-md-12">
	<table class="table table-hover">
		<tr>
			<th>Team name</th>
			<th>Number of Players</th>
		</tr>
		<?php
			$pageNum = 0;
			$total = 0;
			if (isset($_REQUEST['pageNum'])) {
				$pageNum = intval($_REQUEST['pageNum']);
			}
			
			$teams_per_page = 15;

			$select = new Select();
			$teams = $select->getTeams(($teams_per_page * $pageNum), $teams_per_page);
			$total = ($select->totalTeams()->total / $teams_per_page);
			foreach ($teams as $team) {
				echo '<tr class="tableLink" onclick="document.location = \'/sportleague/?page=team.php&id=' . $team->getId() . '\'">';
				echo '<td>' . $select->getFullTeamName($team->getId()) . '</td>';
				echo '<td>' . count($select->getTeamPlayers($team->getId()))  . '</td>';
				echo '</tr>';
			}
		?>
	</table>
	</div>
	</div>
	<div class="row">
		<div class="col-md-12">
		<?php
		echo '<center><ul class="pagination">';
		if($pageNum != 0){
			echo '<li><a href="?page=teams.php&pageNum=' . ($pageNum - 1) . '">«</a></li>';
		}else{
			echo '<li class="disabled"><a href="javascript:void(0)">«</a></li>';
		}
		for ($i=round(($pageNum - 5)); $i < ($pageNum + 5); $i++) {
			if($i >= 0 && $i <= $total){
				if ($i == $pageNum) {
					echo '<li class="active"><a href="?page=teams.php&pageNum=' . $i . '">' . ($i + 1) . '</a></li>';
				}else{
					echo '<li><a href="?page=teams.php&pageNum=' . $i . '">' . ($i + 1) . '</a></li>';
				}
			}
		}
		if ($pageNum <= $total - 1) {
			echo '<li><a href="?page=teams.php&pageNum=' . ($pageNum + 1) . '">»</a></li>';
		}
		echo '</ul></center>';
		?>
	</div>
	</div>
</div>
<div class="col-md-3"></div>