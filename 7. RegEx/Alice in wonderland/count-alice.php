<?php 

// ALice = 399
function CountAlice() {
    $file = 'alice-in-wonderland.txt';
    $text = file_get_contents($file);
    $pattern = "/\bAlice\b/i"; // \b is word boundary, i is case insensitive
    preg_match_all($pattern, $text, $matches);
    $count = count($matches[0]);
    return $count;
}
echo "The word 'Alice' appears " . CountAlice() . " times in the text.";


$originalName = 'Alice';
$replaceWith = 'Michael';

function ReplaceAlice($originalName, $replaceWith) {
    $file = 'replace-alice.txt';
    $text = file_get_contents($file); //file_get_content
    $pattern = "/$originalName/i"; //  /i case insensitive
    return preg_replace($pattern, $replaceWith, $text);
    // $replaceword = preg_replace($pattern, 'Michael', $text);
    // return $replaceword
}

$replacedWord = ReplaceAlice($originalName, $replaceWith); 
echo "<br> I replaced $originalName with $replaceWith <br>" . $replacedWord ;

$countThisWord = 'wonder';
function CountWonder($countThisWord) {
    $file = 'alice-in-wonderland.txt';
    $text = file_get_contents($file);
    $pattern = "/$countThisWord/i"; // /i
    preg_match_all($pattern, $text, $matches);
    return count($matches[0]);
    // $count = count($matches[0]);
    // return $count
}

$countedWords = CountWonder($countThisWord);

echo "<br> The word $countThisWord is a total of $countedWords";

// eugene's (Alice = 221 )
function countArray() {
$keyText = ["alice" => 0];

$textFile = fopen('alice-in-wonderland.txt', 'r');

while (!feof($textFile)) {
    $pointer = trim(fgets($textFile)); 
    // $words = preg_split('/\s+/', $pointer); // split by any whitespace

    $words = explode(" ", $pointer);

    foreach ($words as $word) {
        // 'any word that is not a letter replace it with '' - nothing 
        // eg. ALICE!! -> ALICE or strtolower - Alice, -< alice'
        $word = strtolower(preg_replace('/[^a-z]/i', '', $word));
        //array_key_exists yung nagtitingin kung nag eexist yung key sa array na $textFile
        if (array_key_exists($word, $keyText)) {
            $keyText[$word]++;
        }
    }
}
    fclose($textFile);

foreach ($keyText as $word => $count) {
    echo $word . " occured " . $count .  " times" . PHP_EOL;
}

}
countArray();
?>
