<?php
    include_once 'config/Flood-Control-Db.php';
?>

<style>
    .error{
        color: red;
        font-weight: bold;
    }
    .text{
        color: black;
        font-weight: bold;
    }
</style>

<table style="border: 1px solid #000;width: 100%;">
	<thead>
		<tr>
			<th>ID</th>
			<th>Contractor Name</th>
			<th>Classification</th>
			<th>blacklisted</th>
            <th>Contact Person</th>
            <th>Contact Number</th>
            <th>Controls</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($floodControl as $row ): ?>
			<tr>
				<td><?= $row ['id']; ?></td>
				<td><?= $row['contractor_name']; ?></td>
				<td><?= $row['classification']; ?></td>
				<td><?= ($row['is_blacklisted'] === true)
                        ? '<span class="error"> Blacklisted </span>'
                        : '<span class ="text"> Not Blacklisted </span>'?></td>
                <td><?= $row['contact_person']; ?></td>
                <td><?= $row['contact_number']; ?></td>
                <td><button>Delete</button></td>
			</tr>
		<?php endforeach; ?>
         <button>ADD </button>
	</tbody>
</table>
