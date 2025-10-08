<?php

function view($path, $vars = [])
{
	$basePath = 'views';

	$replacedPath = str_replace(".", "/", $path);

	$viewPath = sprintf('%s/%s.php', $basePath, $replacedPath);

	extract($vars);

	require_once($viewPath);
}

function dd(...$params)
{
	var_dump(...$params);
	exit;
}