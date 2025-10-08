<form action="" method="post">
    <input type="text" name="todo" placeholder="add new todo" value="<?= isset($_POST['task']) ? htmlspecialchars($_POST['task']) : ''?>">
    <button type="submit" name="submit">Add</button>
</form>

<?php

// foreach($tasks as $task) {

// }

?>