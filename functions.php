<?php
function checkdatabase()
{
    try{
    $link = mysqli_connect("localhost", "root", "", "bazy_danych_proj");
    $countTables = mysqli_query($link, "SELECT COUNT(*) AS total_tables FROM information_schema.tables WHERE table_schema = 'bazy_danych_proj'");
    if ($countTables) {
        $row = $countTables->fetch_assoc();
        $totalTables = $row['total_tables'];
    }
    if($totalTables != 6){
        $database = file_get_contents("bazy_danych_proj.sql");
        mysqli_multi_query($link, $database);
    }
}
    catch(Exception){
        $database = file_get_contents("bazy_danych_proj.sql");
        mysqli_multi_query(mysqli_connect("localhost", "root", ""), $database);
    }
}


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
function deleteTagsWithClass($html, $classname)
{
    $pattern = '/<[^>]*\bclass\s*=\s*["\'][^"\']*?\b' . preg_quote($classname, '/') . '\b[^"\']*?["\'][^>]*>(.*?)<\/[^>]+>/i';
    $htmlStringWithoutClass = preg_replace($pattern, '', $html);
    $htmlStringWithoutClass = preg_replace('/\s+/', ' ', $htmlStringWithoutClass);
    return $htmlStringWithoutClass;
}
function sendmonday()
{
    try {
        $link = mysqli_connect("localhost", "root", "", "bazy_danych_proj");
    } catch (Exception) {
        echo 'Error connecting database :c';
    }
    if ($link) {
        $h = 5;
        for ($i = 1; $i < 7; $i++) {

            $c = 2;
            $s = 1;
            if ($i == 1 || $i == 2) {
                $c = 2;
            }
            if ($i == 3 || $i == 5) {
                $c = 5;
            }
            if ($i == 4) {
                $c = 3;
            }
            if ($i == 6) {
                $s = 2;
                $c = 7;
            }
            $sql = "INSERT INTO `main` (`id`, `weekdays_id`, `hours_id`, `subjects_id`, `classes_id`, `rooms_id`) VALUES (NULL, '1', '$h', '$s', '$c', '1')";
            $h++;
            mysqli_query($link, $sql);
        }
    }
}
function sendchewsday()
{
    try {
        $link = mysqli_connect("localhost", "root", "", "bazy_danych_proj");
    } catch (Exception) {
        echo 'Error connecting database :c';
    }
    if ($link) {
        $h = 4;
        for ($i = 1; $i < 8; $i++) {
            if ($i == 1 || $i == 2 || $i == 6 || $i == 7) {
                $s = 1;
            } else {
                $s = 2;
            }
            if ($i == 1) {
                $c = 1;
            }
            if ($i == 2) {
                $c = 3;
            }
            if ($i == 3 || $i == 4) {
                $c = 4;
            }
            if ($i == 5) {
                $c = 7;
            }
            if ($i == 6 || $i == 7) {
                $c = 8;
            }
            $sql = "INSERT INTO `main` (`id`, `weekdays_id`, `hours_id`, `subjects_id`, `classes_id`, `rooms_id`) VALUES (NULL, '2', '$h', '$s', '$c', '1')";
            $h++;
            mysqli_query($link, $sql);
        }
    }
}
function sendfriday()
{
    try {
        $link = mysqli_connect("localhost", "root", "", "bazy_danych_proj");
    } catch (Exception) {
        echo 'Error connecting database :c';
    }

    if ($link) {
        $h = 5;
        for ($i = 1; $i < 5; $i++) {
            if ($i == 1 || $i == 2) {
                $c = 1;
            } else {
                $c = 6;
            }
            $sql = "INSERT INTO `main` (`id`, `weekdays_id`, `hours_id`, `subjects_id`, `classes_id`, `rooms_id`) VALUES (NULL, '5', '$h', '1', '$c', '2')";
            $h++;
            mysqli_query($link, $sql);
        }
    }
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
