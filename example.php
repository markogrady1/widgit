<?php require __DIR__ . '/vendor/autoload.php';

use Widgit\Lib\Plugin;
$widget = new Plugin("markogrady1", 15);

echo $widget->getData(true);

