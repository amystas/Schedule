<?php 
@include("functions.php");
$pagelink = "http://www.sci.edu.pl/cwicz/plan.html";
$pageHTML = file_get_contents($pagelink);
$dom = new DOMDocument;

$dom->loadHTML($pageHTML);

$rows = $dom->getElementsByTagName('tr');

foreach ($rows as $row) {
    $cells = $row->getElementsByTagName('td');

    foreach ($cells as $cell) {
        echo $cell->nodeValue . ' ';
    }
    
    echo '<br>';
}
?>
