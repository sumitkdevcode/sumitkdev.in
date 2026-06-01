<?php
$c = file_get_contents('database/seeders/SeoBlogSeeder.php');
$c = str_replace('Apex Byte', 'SumitKDev', $c);
file_put_contents('database/seeders/SeoBlogSeeder.php', $c);
