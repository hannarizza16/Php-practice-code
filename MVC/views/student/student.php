

<?php
    include_once '../config/Student-Grade.php'; 
?>

<form action="" method="post" style="margin-bottom: 20px;">
    <input type="text" name="student" placeholder="Student Name"  value="<?= isset($_POST['student']) ? htmlspecialchars($_POST['student']) : '' ?>">
    <input type="number" name="grade" placeholder="Grade" value="<?= isset($_POST['grade']) ? htmlspecialchars((int)$_POST['grade']) : "" ?>" min="0" max="100" step="1">
    <input type="text" name="subject" placeholder="Subject" value="<?= isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : '' ?>">
    <button type="submit" name="submit">Add Student</button>
</form>

<table style="border: 1px solid #000; width: 100%; text-align: center;">
    <th>ID</th>
    <th>Student Name</th>
    <th>Grade</th>
    <th>Subject</th>
    <th>Action</th>

    <tbody>
    <?php
    $counter = 1;
    foreach ($students as $student): ?>
        <div>
        <tr>
                <td> <?= $counter++ ?> </td>
                <td><?= htmlspecialchars($student['student']); ?></td>
                <td><?= htmlspecialchars($student['grade']); ?></td>
                <td><?= htmlspecialchars($student['subject']); ?></td>
                <td>
                    <a href="edit.php?id=<?= $student['id']; ?>">Edit</a> | 
                    <a href="../config/Student-Grade.php?delete= <?= $student['id']; ?>" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                </td>
        </tr>
        </div>
    <?php endforeach; ?>
</tbody>
</table>


