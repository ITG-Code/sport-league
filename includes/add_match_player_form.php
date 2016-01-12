<?php
  $s = new Select();
  $t = $s->getHomerFromGame($_REQUEST['match_player']);
  $title = $s->getFullTeamName($t->home_team_id) . " vs " .$s->getFullTeamName($t->gone_team_id);

$p = $s->getTeamPlayers($t->home_team_id);
?>
<div class="row">
  <h1><?php echo $title; ?></h1>
  <div class="well col-md-5">
    <form class="form-horizontal" action="admin/addplayertomatch.php" method="post">
      <legend>Home Team</legend>
      <input type="hidden" name="matchid" value="<?php echo $_REQUEST['match_player']; ?>">
      <fieldset>
        <select class="form-control" name="addplayer">
          <?php
            for($i = 0; $i < count($p); $i++){
              echo "<option value='" . $p[$i]->getId() . "'>" . $p[$i]->getFName() . " " . $p[$i]->getSName();
            }
          ?>
        </select>
        <input type="submit" class="btn btn-primary" name="name" value="Add Player">
      </fieldset>
    </form>
  </div>
  <div class="col-md-2">
    <?php
    $p = $s->getTeamPlayers($t->gone_team_id);
    ?>
  </div>
  <div class="well col-md-5">
    <form class="form-horizontal" action="admin/addplayertomatch.php" method="post">
      <legend>Gone Team</legend>
      <input type="hidden" name="matchid" value="<?php echo $_REQUEST['match_player']; ?>">
      <fieldset>
        <select class="form-control" name="addplayer">
          <?php
            for($i = 0; $i < count($p); $i++){
              echo "<option value='" . $p[$i]->getId() . "'>" . $p[$i]->getFName() . " " . $p[$i]->getSName();
            }
          ?>
        </select>
        <input type="submit" class="btn btn-primary" name="name" value="Add Player">
      </fieldset>
    </form>
  </div>
</div>
