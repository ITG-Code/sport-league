<?php
	require_once('database/select.php');
	require_once('objects/team.php');

	$id = intval($_REQUEST['id']);
	$select = new Select();
	$team = new Team($id);
	$team->getData();
	$MVP = $team->getMVP();
	$matches = $select->getTeamSeasonMatches(1, $id, 0, 15);
?>
<div class="row well">
	<!-- player picture  -->
	<div>
		<?php echo "<h1 style='text-align: center;'>". $select->getFullTeamName($id) . "</h1>"; ?>
		<div class="col-md-4">
			<?php
			if(strlen($team->getAvatar()) <= 0){
				echo '<img src="http://www.rickardhforslund.se/sportleague/img/team.png" style="max-width: 100%;" class="img-rounded"/>';
			}
			else{
				echo '<img src="' . $team->getAvatar() . '" style="max-width: 100%;" class="img-rounded"/>';
			}

			?>
		</div>
		<div class="col-md-4">
			<h4>Basic stats</h4>
			<ul>
				<li>Name: <?php echo $select->getFullTeamName($id);?></li>
				<li>Wins: <?php echo $team->getWins(); ?></li>
				<li>Loses: <?php echo $team->getLoses(); ?></li>
				<li>Ties: <?php echo $team->getTies(); ?></li>
				<li>Amount of members: <?php echo count($team->getMembers()); ?></li>
			</ul>
		</div>
		<div class="col-md-2">
			<h4>MVP</h4>
			<ul>
				<li>Name: <?php echo $MVP->getFName() . " " . $MVP->getSName();?></li>
				<li>Shirt nr: <?php echo $MVP->getShirtNr(1); ?></li>
				<li>Position: <?php echo $MVP->getRoleName(); ?></li>
			</ul>
		</div>
		<div class="col-md-2">
			<?php
			if(strlen($MVP->getAvatar()) <= 0){
				echo '<img src="https://medienkulturwissenschaft.uni-freiburg.de/dateien/Bilder/Portraits/StandardAvatar.png/image_preview" style="max-width: 100%;" class="img-rounded"/>';
			}
			else{
				echo '<img src="' . $MVP->getAvatar() . '" style="max-width: 100%;" class="img-rounded"/>';
			}
			?>
		</div>
	</div>
</div>

<!-- Latest matches and members -->
<div class="row">
  <div class="col-md-6 well">
    <h3>Members</h3>
    <table class="table table-hover">
    <tr>
        <th></th>
        <th>Player Name</th>
        <th>Player Role</th>
    </tr>
    <?php
    	$members = $team->getMembers();
    	foreach ($members as $member) {
    		echo '<tr class="tableLink" onclick="document.location = \'/sportleague/?page=player_profile.php&player=' . $member->getId() . '\'">';
    		echo '<td></td>';
    		echo '<td>' . $member->getFName() . ' ' . $member->getSName() . '</td>';
    		echo '<td>' . $member->getRoleName() . '</td>';
    		echo '</tr>';
    	}
    ?>
    </table>
  </div>
    <div class="col-md-6 well">
    <h3>Team Matches</h3>
    <table class="table table-hover">
      <tr>
        <th></th>
        <th>Home Team</th>
        <th>Gone Team</th>
        <th>Status</th>
        <th>Goals</th>
        <th>Arena</th>
        <th>Start</th>
      </tr>
      <?php
      	foreach ($matches as $match) {
      		echo '<tr>';
      		echo '<td></td>';
      		echo '<td>' . $select->getFullTeamName($match->getHomeTeam()) . '</td>';
      		echo '<td>' . $select->getFullTeamName($match->getGoneTeam()) . '</td>';
      		echo '<td>' . $match->getStatus() . '</td>';
      		echo '<td>' . $match->getGoalsAsString() . '</td>';
      		echo '<td>' . $match->getArena() . '</td>';
      		echo '<td>' . $match->getStartTime() . '</td>';
      		echo '</tr>';
      	}
      ?>
    </table>
  </div>
</div>