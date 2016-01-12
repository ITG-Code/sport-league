<div class="col-md-3"></div>
<div class="row col-md-6 well">
	<div class="row">
	<div class="col-md-12">
	<table class="table table-hover">
		<tr>
			<th>Player name</th>
			<th>Team name</th>
		</tr>
		<?php
			$pageNum = 0;
			$total = 0;
			if (isset($_REQUEST['pageNum'])) {
				$pageNum = intval($_REQUEST['pageNum']);
			}
			
			$players_per_page = 15;

			$select = new Select();
			$players = $select->getPlayers(($players_per_page * $pageNum), $players_per_page);
			$total = ($select->totalPlayers()->total / $players_per_page);
			foreach ($players as $player) {
				echo '<tr class="tableLink" onclick="document.location = \'/sportleague/?page=player_profile.php&player=' . $player->getId() . '\'">';
				echo '<td>' . $player->getFName() . ' ' . $player->getSName() . '</td>';
				echo '<td>' . $select->getFullTeamName($player->getCurTeam()[0]) . '</td>';
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
			echo '<li><a href="?page=players.php&pageNum=' . ($pageNum - 1) . '">«</a></li>';
		}else{
			echo '<li class="disabled"><a href="javascript:void(0)">«</a></li>';
		}
		for ($i=round(($pageNum - 5)); $i < ($pageNum + 5); $i++) {
			if($i >= 0 && $i <= $total){
				if ($i == $pageNum) {
					echo '<li class="active"><a href="?page=players.php&pageNum=' . $i . '">' . ($i + 1) . '</a></li>';
				}else{
					echo '<li><a href="?page=players.php&pageNum=' . $i . '">' . ($i + 1) . '</a></li>';
				}
			}
		}
		if ($pageNum <= $total - 1) {
			echo '<li><a href="?page=players.php&pageNum=' . ($pageNum + 1) . '">»</a></li>';
		}
		echo '</ul></center>';
		?>
	</div>
</div>
</div>
<div class="col-md-3"></div>