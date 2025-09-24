<?php 

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
?>
