<?php
require_once './../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('./../templates/');
$twig = new \Twig\Environment($loader, [
    'cache' => './../cache',
]);
$template = $twig->load('createList.twig');

echo $template->render();