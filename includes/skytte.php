<?php
	$tempSel = new Select();
	$personer = $tempSel->getSkytte(1);
	?>



	<table class="table table-striped table-hover">'
	<tr>
	<th>Position</th>
	<th>First Name</th>
	<th>Surname</th>
	<th>Goals</th>
	<th>Normal Goals</th>
	<th>Penalty Goals</th>
	</tr>



	<?php
	$pos = 1;
	foreach ($personer as $person) {
		echo '<tr>';
			echo '<td>' . $pos . '</td>';
			echo '<td>' . $person['first_name'] . "</td>";
			echo '<td>' . $person['sur_name'] . "</td>";
			echo '<td>' . $person['total'] . "</td>";
			echo '<td>' . $person['goals'] . "</td>";
			echo '<td>' . $person['straff'] . "</td>";
		echo '</tr>';
		$pos++;
	}
	unset($tempSel);

?>
