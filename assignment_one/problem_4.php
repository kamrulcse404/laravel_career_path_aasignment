<?php

$number = readline('Enter a integer number: ');

$number = (intval($number));

if ($number < 0) {
    $number *= -1;
}

for ($i=0; $i < $number; $i++) { 

    for ($j=0; $j < $number - $i - 1; $j++) { 
        echo " ";
    }

    for ($j=0; $j < $i * 2 + 1; $j++) { 
        echo "*";
    }
    echo "\n";
}