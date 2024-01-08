<?php 
@include("functions.php");
$pagelink = "http://www.sci.edu.pl/cwicz/plan.html";
$pageHTML = file_get_contents($pagelink);
$dom = new DOMDocument;
libxml_use_internal_errors(true);
// ^ usuwa bledy dot. DOMDocument c:
$pageHTML = deleteDates($pageHTML);
$pageHTML = deleteTagsWithClass($pageHTML, 'line0');

$dom->loadHTML($pageHTML);

$head = $dom->getElementsByTagName('head')->item(0);

$head->parentNode->removeChild($head);

$rows = $dom->getElementsByTagName('tr');

//$rowsData = array(array());

$xpath = new DOMXPath($dom);
$cells = $xpath->query('//td | //th');
$data = array();
    
foreach ($cells as $cell) {
    $data[] = $cell->nodeValue;
}

print_r($data);
?>
