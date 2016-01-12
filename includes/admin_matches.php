<?php
  $s = new Select();
  $m = $s->getSeasonMatches(1,0,false);

?>
<div class="col-md-5">
  <form class="form-horizontal well" action="?page=admin.php" method="post">
    <fieldset>
      <legend>Select a match to report</legend>
      <select class="form-control col-md-5" name="match">
        <?php
          for($i = 0;$i < count($m);$i++){
            if($m[$i]->getStatus() == "Scheduled" || $m[$i]->getStatus() == "Playing"){

              echo '<option value="'.$m[$i]->getId().'">' . $s->getFullTeamName($m[$i]->getHomeTeam()) . " vs " .$s->getFullTeamName($m[$i]->getGoneTeam()) . " (" . $m[$i]->getStartTime() .")</option>\n";
            }
          }
        ?>
      </select>
      <input type="submit" class="btn btn-primary" name="submit" value="Report Match">
    </fieldset>
  </form>
</div>
