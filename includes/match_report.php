<div class="well">
  <div class="row">
    <form class="form-horizontal" action="admin/match_report.php" method="post">
      <fieldset>
        <legend>Report Match</legend>
          <label for="">X vs Y at date</label>
          <input id="match_id" type="hidden" name="match_id" value="<?php echo $_REQUEST['match'];?>">
          <div class="col-md-12">


            <div class="row">
              <div class="form-group col-md-5" id="match_home_team">
                <script src="scripts/admin.js" charset="utf-8"></script>
                <legend id="hometeam">Home team</legend>
                <input id="match_home_goals_nr" type="number" name="home_goals" placeholder="Goals made by the home team" class="form-control">
                <button type="button" class="btn btn-raised" name="button" value="Get Goals" onclick="addHomeGoals();">Get Goals</button>
                <!-- One of many goal entries -->
                <div class="form-group" id="match_home_goals">
                </div>
              </div>
              <div class="col-md-2">

              </div>
              <div class="form-group col-md-5" id="match_gone_team">
                <script src="scripts/admin.js" charset="utf-8"></script>
                <legend id="goneteam">Gone team</legend>
                <input id="match_gone_goals_nr" type="number" name="gone_goals" placeholder="Goals made by the gone team" class="form-control">
                <button type="button" class="btn btn-raised" name="button" value="Get Goals" onclick="addGoneGoals();">Get Goals</button>
                <div class="form-group" id="match_gone_goals">
                </div>
              </div>
              <div class="form-group col-md-5">
                <label for="audience">Visitors</label>
                <input type="number" class="form-control" name="audience" value="" placeholder="Number of visitors" required="required">

                </div>
              </div>




            </div>



          </div>
        </div>
        <input type="submit" name="match_report" class="btn btn-primary" value="Report">
      </fieldset>

    </form>
  </div>

</div>



<?php



?>
