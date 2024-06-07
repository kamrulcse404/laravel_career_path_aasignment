<?php

$number = readline('How many numbers do you want to put in your array?: ');

$number = (intval($number));
$myArray = [];

for ($i = 0; $i < $number; $i++) {
    $item = readline("Enter a integer number for make your array : ");
    $item = (intval($item));

    if ($item < 0) {
        $item *= -1;
    }
    $myArray[] = $item;
}

if (count($myArray) > 0) {
    $check = $myArray[0];

    for ($i = 1; $i < count($myArray); $i++) {
        if ($myArray[$i] <= $check) {
            $check = $myArray[$i];
        }
    }

    echo "The minimum of their absolute value is $check";
}
