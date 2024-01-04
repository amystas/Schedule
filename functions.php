<?php
function deleteBetweenWords($string, $startWord, $endWord)
{
    $pattern = "/$startWord(.*?)$endWord/s";
    $replacement = "$startWord$endWord";
    $result = preg_replace($pattern, $replacement, $string);

    return $result;
}
function extractBetweenWords($string, $startWord, $endWord)
{
    $pattern = "/.*?$startWord(.*?)$endWord.*/s";
    $result = preg_replace($pattern, '$1', $string);

    return $result;
}
function deleteDates($string)
{
    $pattern = '/\b\d{4}-\d{2}-\d{2}\b/';
    $result = preg_replace($pattern, '', $string);
    
    $result = preg_replace('/\s+/', ' ', $result);
    return trim($result);
}
// function extractWords($inputString, $arg1, $arg2, $groupnr)
// {
//     $lines = explode("\n", $inputString);
//     $counter = 0;
//     $resultText = '';

//     foreach ($lines as $line) {
//         $counter += substr_count($line, $arg1);

//         if ($counter == $groupnr) {
//             $resultText .= substr($line, strpos($line, $arg1) + strlen($arg1)) . ' ';
//         }

//         $counter -= substr_count($line, $arg2);

//         if ($counter <= 0 && $resultText !== '') {
//             break;
//         }
//     }

//     // Usunięcie tekstu po arg2
//     $resultText = strstr($resultText, $arg2, true);

//     return trim($resultText);
// }
