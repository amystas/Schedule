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

// var_dump($data);

// dni tygodnia :D
$indexesToExtractforweekdays = array(2, 3, 4, 6, 7, 8, 9); //6 a nie 5

$weekdays = array();
foreach ($indexesToExtractforweekdays as $index) {
    if (isset($data[$index])) {
        $weekdays[] = $data[$index];
    }
}
// print_r($weekdays);


// // godziny lekcyjne >:P
// $indexesToExtractforhours = array(12, 23, 34, 45, 56, 67, 78, 89, 100, 111, 122, 133, 144);
// $studyhours = array();
// foreach ($indexesToExtractforhours as $index) {
//     if (isset($data[$index])) {
//         $studyhours[] = $data[$index];
//     }
// }

$studyhours = array();
for ($i = 12; $i < 145; $i += 11) {
    if (isset($data[$i])) {
        array_push($studyhours, $data[$i]);
    }
}
// print_r($studyhours);

// podzielenie liczb na hour start i end zeby ladnie do bazy to wchodzilo
$hour_start = [];
$hour_end = [];
foreach ($studyhours as $rekord) {
    $hour_start[] = substr($rekord, 0, 5);
    $hour_end[] = substr($rekord, 10, 13); //10 a nie 9
}

///przedmioty, klasy, sale ^.^
$indexesToExtractforsubjects = array(58, 68, 69, 73, 79, 80, 84, 90, 91, 95, 101, 102, 106, 112, 113, 123, 124,);

$threeinonearraywithsubj = array();
foreach ($indexesToExtractforsubjects as $index) {
    if (isset($data[$index])) {
        $threeinonearraywithsubj[] = $data[$index];
    }
}
// print_r($threeinonearraywithsubj);

// dzielenie tego na sale, klasy, przedmioty

$subj = [];
$classes = [];
$room = [];

foreach ($threeinonearraywithsubj as $rekord) {
    $typ = strtoupper($rekord[0]);
    if ($typ === 'B') {
        $subj[] = substr($rekord, 0, 11);
        $classes[] = substr($rekord, 13, 10);
        $room[] = substr($rekord, 23);
    } elseif ($typ === 'S') {
        $subj[] = substr($rekord, 0, 18);
        $classes[] = substr($rekord, 20, 10);
        $room[] = substr($rekord, 30);
    }
}
//usuniecie (liczba) z klas

//usuniecie duplikacji
$uniqueSubj = array_unique($subj);
$uniqueClass = array_unique($classes);
$uniqueRoom = array_unique($room);
// print_r($uniqueSubj);

// print_r($uniqueClass);

// print_r($uniqueRoom);
//print_r($data);

// if(!mysqli_connect("localhost", "root", "", "bazy_danych_proj")) {
// 	echo "no i spierdolone to jest";
// } else {
// 	echo "jest git";
// }
try{
    $link = mysqli_connect("localhost", "root", "");
    $countTables = mysqli_query($link, "SELECT COUNT(*) AS total_tables FROM information_schema.tables WHERE table_schema = 'bazy_danych_proj'");
    if ($countTables) {
        $row = $countTables->fetch_assoc();
        $totalTables = $row['total_tables'];
    }
    if ($totalTables != 6) {
        $database = file_get_contents("bazy_danych_proj.sql");
        mysqli_multi_query($link, $database);
        
    }
    echo"Ami jest taka hotowa";
}   
    
 catch(Exception){      
    $database = file_get_contents("bazy_danych_proj.sql");
    mysqli_multi_query(mysqli_connect("localhost", "root", ""), $database);
    $link = mysqli_connect("localhost", "root", "", "bazy_danych_proj");
    if (!$link) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $result = mysqli_multi_query($link, $database);
    
    if (!$result) {
        die("Error executing multi-query: " . mysqli_error($link));
    }
    
    // Consume all results to clear the buffer
    do  if($result=mysqli_store_result($link)){ mysqli_free_result($result); } while(mysqli_more_results($link) && mysqli_next_result($link));
}
$link = mysqli_connect("localhost", "root", "", "bazy_danych_proj");
    foreach ($weekdays as $weekday) {
        $sql = "INSERT INTO `weekdays` (`id_weekdays`, `weekday`) VALUES (NULL, '$weekday');";
        mysqli_query($link, $sql, MYSQLI_USE_RESULT);
    }


    // godziny lekcyjne
    $i = 0;
    foreach ($hour_start as $hourst) {
        $sql = "INSERT INTO `hours` (`id_hours`, `hour_start`, `hour_end`) VALUES ('$i', '$hourst', '$hour_end[$i]');";
        $i++;
        mysqli_query($link, $sql);
    }

    // klasy, np. 3C
    foreach ($uniqueClass as $class) {
        $sql = "INSERT INTO `classes` (`id_classes`, `class_name`) VALUES (NULL, '$class');";
        mysqli_query($link, $sql);
    }


    // sale
    foreach ($uniqueRoom as $room_v) {
        $sql = "INSERT INTO `rooms` (`id_rooms`, `room_num`) VALUES (NULL, '$room_v');";
        mysqli_query($link, $sql);
    }


    // przedmioty
    foreach ($uniqueSubj as $subject) {
        $sql = "INSERT INTO `subjects` (`id_subjects`, `subject_name`) VALUES (NULL, '$subject');";
        mysqli_query($link, $sql);
    }

    sendmonday();
    sendchewsday();
    sendfriday();
    echo "kocham moja dziewczyne";
 

// WYSYLANIE DO SQL
// if ($link) {
//     var_dump($uniqueSubj);
//     foreach ($weekdays as $weekday) {
//         $sql = "INSERT INTO `weekdays` (`id_weekdays`, `weekday`) VALUES (NULL, '$weekday')";
//         mysqli_query($link, $sql);
//     }


//     // godziny lekcyjne
//     $i = 0;
//     foreach ($hour_start as $hourst) {
//         $sql = "INSERT INTO `hours` (`id_hours`, `hour_start`, `hour_end`) VALUES ('$i', '$hourst', '$hour_end[$i]')";
//         $i++;
//         mysqli_query($link, $sql);
//     }

//     // klasy, np. 3C
//     foreach ($uniqueClass as $class) {
//         echo $class;
//         $sql = "INSERT INTO `classes` (`id_classes`, `class_name`) VALUES (NULL, '$class')";
//         mysqli_query($link, $sql);
//     }


//     // sale
//     foreach ($uniqueRoom as $room_v) {
//         $sql = "INSERT INTO `rooms` (`id_rooms`, `room_num`) VALUES (NULL, '$room_v')";
//         mysqli_query($link, $sql);
//     }


//     // przedmioty
//     foreach ($uniqueSubj as $subject) {
//         $sql = "INSERT INTO `subjects` (`id_subjects`, `subject_name`) VALUES (NULL, '$subject')";
//         mysqli_query($link, $sql);
//     }
// }
// else{
//     echo 'Error connecting database :c';
// }

// echo $data;
