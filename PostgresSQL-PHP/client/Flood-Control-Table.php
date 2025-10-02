<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flood Control</title>
    <link rel="stylesheet" href="flood-control.css">
</head>
<body>
    

<?php
    include_once '../config/Flood-Control-Db.php';
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
                <td><button>Edit</button></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<button id="addBtn"> ADD </button>

<!-- Modal -->
<div id="addModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Add Contractor</h2>

        <form method="POST" action="insert.php">
            <label>Contractor Name:</label><br>
            <input type="text" name="contractor_name" required><br><br>

            <label>Classification:</label><br>
            <input type="text" name="classification" required><br><br>

            <label>Blacklisted:</label><br>
            <select name="is_blacklisted">
                <option value="0">No</option>
                <option value="1">Yes</option>
            </select><br><br>

            <label>Contact Person:</label><br>
            <input type="text" name="contact_person" required><br><br>

            <label>Contact Number:</label><br>
            <input type="text" name="contact_number" required><br><br>

            <button type="submit">Save</button>
        </form>

    </div>
</div>

<script>
    const modal = document.getElementById("addModal");
    const btn = document.getElementById("addBtn");
    const closeBtn = document.querySelector(".close");

    // Show modal when ADD is clicked
    btn.onclick = () => {
        modal.style.display = "flex";
    };

    // Close when X is clicked
    closeBtn.onclick = () => {
        modal.style.display = "none";
    };

    // Close when clicking outside modal
    window.onclick = (e) => {
        if (e.target === modal) {
            modal.style.display = "none";
        }
    };
</script>

</body>
</html>