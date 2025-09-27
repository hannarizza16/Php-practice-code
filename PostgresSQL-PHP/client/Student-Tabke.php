<?php
    include_once '../config/Student-Grade.php'; 
?>

<table style="border: 1px solid #000; width: 100%; text-align: center;">
    <th>ID</th>
    <th>Student Name</th>
    <th>Grade</th>
    <tbody>
    <?php foreach ($students as $student): ?>
        <div>
        <tr>
                <td><?=  $student['id']; ?></td>
                <td><?= htmlspecialchars($student['student']); ?></td>
                <td><?= htmlspecialchars($student['grade']); ?></td>
        </tr>
        </div>
    <?php endforeach; ?>
</tbody>
</table>
