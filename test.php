<?php
require 'vendor/autoload.php';

$m = new \Intervention\Image\ImageManager(
    new \Intervention\Image\Drivers\Gd\Driver()
);

$image = $m->decode(file_get_contents('febryan.jpeg'));
echo "Image class: " . get_class($image) . "\n";
echo "Image methods:\n";
print_r(get_class_methods($image));