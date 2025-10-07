<h1><?= $title ?></h1>


    <ul>
        <?php foreach($groceryLists as $groceryList): ?>
        <li><?= $groceryList['list']; ?></li>
        <?php endforeach; ?>
    </ul>
