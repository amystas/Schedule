<?php 
@include("functions.php");
$pagelink = "http://www.sci.edu.pl/cwicz/plan.html";
$pageHTML = file_get_contents($pagelink);

$pageHTML = deleteDates($pageHTML);

$dom = new DOMDocument;
libxml_use_internal_errors(true);
// ^ usuwa bledy dot. DOMDocument c:
$dom->loadHTML($pageHTML);
libxml_clear_errors();

//removing head section
$head = $dom->getElementsByTagName('head')->item(0);

$head->parentNode->removeChild($head);

$xpath = new DOMXPath($dom);
//removing tags with line0 class
$line0Class = $xpath->query("//*[@class='line0']");
foreach ($line0Class as $element) {
    $element->parentNode->removeChild($element);
}

//getting data from td and th cells
$cells = $xpath->query('//td | //th');
$data = array();
foreach ($cells as $cell) {
    $data[] = $cell->nodeValue;
}

print_r($data);
?>
