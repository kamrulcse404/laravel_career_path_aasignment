<?php

$sentence = readline('Write sententence or word: ');
$len = strlen($sentence);
$total_word = str_word_count($sentence);


if ($len > 0) {
    if ($total_word === 1) {
        if ($sentence[$len - 1] === ',' || $sentence[$len - 1] === '?' || $sentence[$len - 1] === ';' || $sentence[$len - 1] === '!' || $sentence[$len - 1] === '.') {
            for ($i = $len - 2; $i >= 0; $i--) {
                echo $sentence[$i];
            }
            echo $sentence[$len - 1];
        } else {
            for ($i = $len - 1; $i >= 0; $i--) {
                echo $sentence[$i];
            }
        }
    } else {
        for ($i = 0, $k = 0; $i < $len; $i++) {
            if ($sentence[$i] === " ") {

                if ($sentence[$len - 1] === ',' || $sentence[$len - 1] === '?' || $sentence[$len - 1] === ';' || $sentence[$len - 1] === '!' || $sentence[$len - 1] === '.') {
                    for ($j = $i - 2; $j >= $k; $j--) {
                        echo $sentence[$j];
                    }
                    echo $sentence[$i - 1];
                    echo " ";
                } else {
                    for ($j = $i - 1; $j >= $k; $j--) {
                        echo $sentence[$j];
                    }
                    echo " ";
                }

                // for more white space 
                while ($sentence[$i] === " ") {
                    $i++;
                }
                $k = $i;
            }
        }

        if ($sentence[$len - 1] === ',' || $sentence[$len - 1] === '?' || $sentence[$len - 1] === ';' || $sentence[$len - 1] === '!' || $sentence[$len - 1] === '.') {
            for ($j = $len - 2; $j >= $k; $j--) {
                echo $sentence[$j];
            }
            echo $sentence[$len - 1];
        } 
        else {
            for ($j = $len - 1; $j >= $k; $j--) {
                echo $sentence[$j];
            }
        }
    }
} else {
    printf("Your input is wrong");
}
