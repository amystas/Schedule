<?php
function deleteBetweenWords($string, $startWord, $endWord) {
    $pattern = "/$startWord(.*?)$endWord/s";
    $replacement = "$startWord$endWord";
    $result = preg_replace($pattern, $replacement, $string);
    
    return $result;
}
function extractBetweenWords($string, $startWord, $endWord) {
    $pattern = "/.*?$startWord(.*?)$endWord.*/s";
    $result = preg_replace($pattern, '$1', $string);
    
    return $result;
}
function deleteDates($string) {
    $pattern = "/\b\d{4}-\d{2}-\d{2}\b/";
    $result = preg_replace($pattern, '', $string);

    return $result;
}
?>