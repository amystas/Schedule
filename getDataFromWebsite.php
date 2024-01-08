<?php 
@include("functions.php");
$pagelink = "http://www.sci.edu.pl/cwicz/plan.html";
$pageHTML = file_get_contents($pagelink);
$dom = new DOMDocument;
libxml_use_internal_errors(true);
// ^ usuwa bledy dot. DOMDocument c:
$pageHTML = deleteDates($pageHTML);

$dom->loadHTML($pageHTML);

$head = $dom->getElementsByTagName('head')->item(0);

$head->parentNode->removeChild($head);

$rows = $dom->getElementsByTagName('tr');

$rowsData = array(array());

foreach ($rows as $row) {
    $cells = $row->getElementsByTagName('td');
    $oneRowData = array();
        
    foreach ($cells as $cell) {
        $oneRowData[] = $cell->nodeValue;
    }

    array_push($rowsData, $oneRowData);
}

print_r($rowsData);
?>
