<?php
	$select = new Select();
	$arenor = $select->getAllArenor();
?>
<div class="row">
<div class="col-md-5">
  <form class="form-horizontal well" action="?page=audience.php" method="POST">
    <fieldset>
      <legend>Select arena</legend>
      <select class="form-control col-md-5" name="arena">
        <?php
        	while ($row = $arenor->fetch_object()) {
        		echo '<option value="'.$row->arena_id.'">' . $row->arena_name . "</option>\n";
        	}
        ?>
      </select>
      <select class="form-control col-md-5" name="order">
      	<option value="amount_asc">Amount ascending</option>
      	<option value="date_asc">Date ascending</option>
      	<option value="amount_desc">Amount descending</option>
      	<option value="date_desc">Date descending</option>
      </select>
      <input type="submit" class="btn btn-primary" value="Select arena">
    </fieldset>
  </form>
</div>
<?php
	if(isset($_REQUEST['arena'])){
		require_once('includes/audience_view.php');
	}
?>
</div>