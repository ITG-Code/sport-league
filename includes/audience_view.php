<div class="col-md-6 well">
<table class="table table-hover">
	<tr>
		<th>Amount</th>
		<th>Date</th>
		<th>Game</th>
	</tr>
<?php
	$order;
	switch ($_REQUEST['order']) {
		case 'amount_asc':
			$order = "ORDER BY viewers ASC";
			break;
		case 'amount_desc':
			$order = "ORDER BY viewers DESC";
			break;
		case 'date_asc':
			$order = "ORDER BY date_time ASC";
			break;
		case 'date_desc':
			$order = "ORDER BY date_time DESC";
			break;
		default:

			break;
	}
	$select = new Select();
	$data = $select->getAudience(intval($_REQUEST['arena']), 0 , 0, $order);
	while ($row = $data->fetch_object()) {
		echo '<tr>';
		echo '<td>' . $row->viewers . '</td>';
		echo '<td>' . date('Y-n-j', strtotime($row->date_time)) . '</td>';
		echo '<td>' . $select->getFullTeamName($row->home_team) . ' <-> ' . $select->getFullTeamName($row->gone_team) . '</td>';
		echo '</tr>';
	}
?>
</table>
</div>