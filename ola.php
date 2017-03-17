<?php
/**
 * Created by PhpStorm.
 * User: cserrao
 * Date: 17/03/2017
 * Time: 10:33
 */

echo 'ola mundo';

$arr = array("a" => 1, 3, "Carlos", 5, 6, 7, 9);

print_r($arr);

foreach ($arr as $v) {
    echo "<h1>$v</h1><br>";
}

?>