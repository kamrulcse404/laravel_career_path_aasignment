<?php

$filename = './public/population.txt';

$resource = fopen($filename, 'r');

if ($resource) {
    $contents = fread($resource, filesize($filename));
    // echo gettype($contents);

    $len = strlen($contents);
    $count = 0;

    for ($i = 0; $i < $len - 1; $i++) {
        if ($contents[$i] === " " && $contents[$i + 1] !== " ") {
            $count++;
        }
    }

    echo $count + 1;
} else {
    echo "Something wrong with the file open with read mode";
}
