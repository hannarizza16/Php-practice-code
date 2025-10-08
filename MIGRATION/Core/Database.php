<?php
use Core\Connection;

$dbconn = new Connection(
    $_ENV['DB_DBNAME'],
    $_ENV['DB_HOST'],
    $_ENV['DB_PORT'],
    $_ENV['DB_USERNAME'],
    $_ENV['DB_PASSWORD']
)

?>