<?php 
@include("functions.php");
$pagelink = "http://www.sci.edu.pl/cwicz/plan.html";
$pageHTML = file_get_contents($pagelink);
$noHeadHTML = preg_replace('/<head>.*<\/head>/is', '<head></head>', $pageHTML);
$noTagsHTML = preg_replace('#<[^>]+>#', ' ', $noHeadHTML);
$noDates = deleteDates($noTagsHTML);

//otsochodzi
//$input = "Plan lekcji Nr Godziny Poniedziałek Wtorek Środa Nr Czwartek Piątek Sobota Niedziela Nr 0 07:15 - 08:00       0         0 08:00 - 08:00 1 08:00 - 08:45       1         1 08:45 - 08:50 2 08:50 - 09:35       2         2 09:35 - 09:40 3 09:40 - 10:25       3         3 10:25 - 10:30 4 10:30 - 11:15   Bazy Danych - 3c TI (5)  s. 304   4         4 11:15 - 11:30 5 11:30 - 12:15 Bazy Danych - 4b TI (5)  s. 304 Bazy Danych - 4e TI (4)  s. 304   5   Bazy Danych - 3c TI (5)  s. 3     5 12:15 - 12:25 6 12:25 - 13:10 Bazy Danych - 4b TI (5)  s. 304 Systemy operacyjne - 1b TI (5)  s. 304   6   Bazy Danych - 3c TI (5)  s. 3     6 13:10 - 13:20 7 13:20 - 14:05 Bazy Danych - 4a TI (5)  s. 304 Systemy operacyjne - 1b TI (5)  s. 304   7   Bazy Danych - 4f TI (4)  s. 3     7 14:05 - 14:15 8 14:15 - 15:00 Bazy Danych - 4e TI (4)  s. 304 Systemy operacyjne - 1a TI (5)  s. 304   8   Bazy Danych - 4f TI (4)  s. 3     8 15:00 - 15:05 9 15:05 - 15:50 Bazy Danych - 4a TI (5)  s. 304 Bazy Danych - 4g TI (4)  s. 304   9         9 15:50 - 15:55 10 15:55 - 16:40 Systemy operacyjne - 1a TI (5)  s. 304 Bazy Danych - 4g TI (4)  s. 304   10         10 16:40 - 16:40 11 16:40 - 17:25       11         11 17:25 - 17:25 12 17:25 - 18:10       12         12 ";
//$weekdays1 = extractBetweenWords($input, "Nr Godziny", "Nr");
//DZIAŁA

//nie działa
$weekdays1 = extractBetweenWords($noDates, "Nr Godziny", "Nr");

echo $weekdays1;
?>