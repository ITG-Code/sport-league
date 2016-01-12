<?php
$s = new Select();
$m = $s->getSeasonMatches(1,0,false);
?>
<div class="row well col-md-12">
  <table class="table table-striped">
    <tr>

      <th>Home team</th>

      <th>Gone team</th>

      <th>Score</th>
      <th>Audience</th>
      <th>Date</th>

    </tr>
    <?php
      for($i = 0; $i < count($m);$i++){
        if($m[$i]->getStatus() == "Ended"){
          echo "<tr>\n";
          echo "\t<td>". $s->getFullTeamName($m[$i]->getHomeTeam()) . "</td>\n";
          echo "\t<td>". $s->getFullTeamName($m[$i]->getGoneTeam()) . "</td>\n";
          echo "\t<td>" . $s->getTeamGoal($m[$i]->getId(), $m[$i]->getHomeTeam()) . " - " . $s->getTeamGoal($m[$i]->getId(), $m[$i]->getGoneTeam()) . "</td>\n";
          echo "\t<td>" . $s->getAudienceSimple($m[$i]->getId()) . "</td>\n";
          echo "\t<td>" . $m[$i]->getStartTime() . "</td>\n";
          echo "</tr>\n";
        }


      }

     ?>
   </table>
</div>
