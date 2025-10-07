<?php
function view($path, $toVars = [])
{
    $basePath = 'views';
    $replacedPath = str_replace('.', '/', $path);
    $viewPath = sprintf('%s/%s.php', $basePath, $replacedPath);

    //extracting associative array into variable
    extract($toVars);
    // require_once('views/cases/cases.php');
    require_once($viewPath);
    // return;
}
