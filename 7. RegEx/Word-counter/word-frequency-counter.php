<?php

function WordCount($string) {
    $counts = [];
    $splitwords = explode(" ", $string);

    foreach ($splitwords as $word) {
        $word = strtolower(preg_replace('/[^a-z]/i', '', $word));

        if ($word === '') continue; // skip those empty,

        if (array_key_exists($word, $counts)){
            $counts[$word]++;
        } else {
            $counts[$word] = 1;
        }

    }

    foreach ($counts as $word => $count) {
        echo "$word => $count" . PHP_EOL;
        // PHP_EOL -> php end of line
    }



}

$wordCount = WordCount('Alice loves the rabbit. The rabbit loves Alice.');

// echo print_r($wordCount);

?>