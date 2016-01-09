<?php
  require_once("database/select.php");
  $db = new Select();

  $player = $db->getPersonProfile($_REQUEST['player']);
?>
<div class="row well">
  <!-- player picture  -->
  <div>
    <?php echo "<h1 style='text-align: center;'>". $player->getFName() . " " . $player->getSName() . "</h1>"; ?>
    <div class="col-md-4">
      <?php
        if(strlen($player->getAvatar()) <= 0){
          echo '<img src="https://medienkulturwissenschaft.uni-freiburg.de/dateien/Bilder/Portraits/StandardAvatar.png/image_preview" style="max-width: 100%;" class="img-rounded"/>';
        }
        else{
          echo '<img src="' . $player->getAvatar() . '" style="max-width: 100%;" class="img-rounded"/>';
        }

       ?>
    </div>
    <div class="col-md-4">
      <h4>Basic stats</h4>
      <ul>
        <li>Name: <?php echo $player->getFName() . " " . $player->getSName();?></li>
        <!-- make: Get organization per ID since last club contains IDs-->
        <li>Original Club: <?php echo $db->getFullTeamName($player->getcurTeam()); ?></li>
        <li>Current Club: Uppsala Birdsnest</li>
        <li>Nationality: United Birds of Sweden</li>
        <li>Shirt nr: <?php echo $player->getShirtNr()[0]; ?></li>
        <li>Weight: <?php echo $player->getWeight(); ?></li>
        <li>Height: <?php echo $player->getHeight(); ?></li>
        <li>Birthday: 1997-2-1</li>
        <li>Position: <?php echo $player->getRoleName(); ?></li>
      </ul>
    </div>
    <div class="col-md-4">
      <h4>Advanced stats</h4>
      <ul>
        <li>Goals in current team: <?php echo $player->getCurTeamGoals(); ?></li>
        <li>Goals of all time: <?php echo $player->getGoals(); ?></li>
        <li>Finnishes: <?php echo $player->getFinishes(); ?></li>
        <?php
        if($player->getFinishes() <= 0){
          ?><li>Goals/Finishes ratio: <?php echo "Infinite"?></li><?php
        }
        else{
          ?><li>Goals/Finishes ratio: <?php echo $player->getGoals() / $player->getFinishes() * 100;?></li><?php
        }
        ?>
        <li>Total passes: 7000</li>
        <li>Complete passes: 6000</li>
        <li>Interuped passes: 500</li>
        <li>Current blood pressure: 100</li>
        <li>Deseases: Fever, Tuberculosis, Hyponeurikostiskadiafragmakontravibrationer</li>
      </ul>
    </div>
</div>
  </div>

<!-- Player stats -->
<div class="row">
  <div class="col-md-12 well">
    <h3>Player Matches</h3>
    <table class="table">
      <tr>
        <th></th>
        <th>Player Team</th>
        <th>Enemy Team</th>
        <th>Match Score</th>
        <th>Player goals</th>
        <th>Passes</th>
        <th>Finishes</th>
      </tr>
      <tr>
        <td><span class="glyphicon glyphicon-resize-full"></span></td>
        <td>Uppsala Birdsnest</td>
        <td>Rickardhs Cool Guy Club</td>
        <td>8-5</td>
        <td>5</td>
        <td>40</td>
        <td>9</td>
      </tr>
      <tr>
        <td><span class="glyphicon glyphicon-resize-small"></span></td>
        <td>Uppsala Birdsnest</td>
        <td>Rickardhs Cool Guy Club</td>
        <td>8-5</td>
        <td>5</td>
        <td>40</td>
        <td>9</td>
      </tr>
      <div class="row">
        <div class="col-md-11 col-md-offset-1">
          <tbody class="table table-hover">
            <h4>Events</h4>
            <tr class="info">
              <td>09:25</td>
              <td>Recieves ball</td>
            </tr>
            <tr class="info">
              <td>09:40</td>
              <td>Passes</td>
            </tr>
            <tr class="info">
              <td>11:45</td>
              <td>Recieves ball</td>
            </tr>
            <tr class="warning">
              <td>12:00</td>
              <td>Shoots</td>
            </tr>
            <tr class="success">
              <td>12:01</td>
              <td>Score!</td>
            </tr>

          </tbody>
        </div>
      </div>

      <tr>
        <td><span class="glyphicon glyphicon-resize-full"></span></td>
        <td>Uppsala Birdsnest</td>
        <td>Rickardhs Cool Guy Club</td>
        <td>8-5</td>
        <td>5</td>
        <td>40</td>
        <td>9</td>
      </tr>
      <tr>
        <td><span class="glyphicon glyphicon-resize-full"></span></td>
        <td>Uppsala Birdsnest</td>
        <td>Rickardhs Cool Guy Club</td>
        <td>8-5</td>
        <td>5</td>
        <td>40</td>
        <td>9</td>
      </tr>
      <tr>
        <td><span class="glyphicon glyphicon-resize-full"></span></td>
        <td>Uppsala Birdsnest</td>
        <td>Rickardhs Cool Guy Club</td>
        <td>8-5</td>
        <td>5</td>
        <td>40</td>
        <td>9</td>
      </tr>
      <tr>
        <td><span class="glyphicon glyphicon-resize-full"></span></td>
        <td>Uppsala Birdsnest</td>
        <td>Rickardhs Cool Guy Club</td>
        <td>8-5</td>
        <td>5</td>
        <td>40</td>
        <td>9</td>
      </tr>
      <tr>
        <td><span class="glyphicon glyphicon-resize-full"></span></td>
        <td>Uppsala Birdsnest</td>
        <td>Rickardhs Cool Guy Club</td>
        <td>8-5</td>
        <td>5</td>
        <td>40</td>
        <td>9</td>
      </tr>
    </table>
  </div>
</div>
