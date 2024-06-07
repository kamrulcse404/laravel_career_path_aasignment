<?php

$number = readline('Enter a integer number: ');

$number = (intval($number));

if ($number < 0) {
    $number *= -1;
}

$sum = 0;
while($number != 0)
{
    $reminder = $number % 10;
    $sum += $reminder;
    $number = $number / 10;
}

printf($sum);