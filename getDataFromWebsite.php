<?php 
@include("functions.php");
$pagelink = "http://www.sci.edu.pl/cwicz/plan.html";
$pageHTML = file_get_contents($pagelink);
$dom = new DOMDocument;

$dom->loadHTML($pageHTML);

$head = $dom->getElementsByTagName('head')->item(0);

$head->parentNode->removeChild($head);

$rows = $dom->getElementsByTagName('tr');

$array[] = $var;

foreach ($rows as $row) {
    $cells = $row->getElementsByTagName('td');
    $rowData = array();
        
    foreach ($cells as $cell) {
        $rowData[] = $cell->nodeValue;
    }

    print_r($rowData);

    echo '<br>';
}
?>
