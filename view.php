<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schedule</title>
    <style>
        body {
            background: rgb(2,0,36);
            background: linear-gradient(180deg, rgba(2,0,36,1) 0%, rgba(121,9,103,1) 51%, rgba(255,141,0,1) 100%);
            font-family: 'Arial', sans-serif;
            display:flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
           
        }

        form {
            background: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            width: 300px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
            margin-bottom: 3%;
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-size: 18px;
        }

        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            outline: none;
            transition: border-color 0.3s ease-in-out;
        }

        select:focus {
            border-color: #ff6f61;
        }

        input[type="submit"] {
            background: rgb(2,0,36);
            background: linear-gradient(180deg, rgba(2,0,36,1) 0%, rgba(121,9,103,1) 51%, rgba(255,141,0,1) 100%);
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease-in-out;
        }

        input[type="submit"]:hover {
            background: #ff4f42;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .schedule-table {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }

        table {
            
            border-collapse: collapse;
            width: 40%;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }
        td{
            color:whitesmoke;
        }
        th {
            background-color: gray;
        }
        h1, h2{
            color:white;
        }
    </style>
</head>
<body>
    <form action="" method="POST">
        <label for="days">Check your schedule for the specific day:</label>
        <select name="days" id="days">
            <option value="">--Choose the day--</option>
            <option value="monday">Monday</option>
            <option value="tuesday">Tuesday</option>
            <option value="wednesday">Wednesday</option>
            <option value="thursday">Thursday</option>
            <option value="friday">Friday</option>
            <option value="saturday">Saturday</option>
            <option value="sunday">Sunday</option>
        </select>
        <input type="submit" value="Check">
    </form>

    <?php
   
    $day = @$_POST["days"];
    $link = mysqli_connect("localhost", "root", "", "bazy_danych_proj");
    switch($day){
        case "monday":
            $sql = "SELECT hours.hour_start,hours.hour_end,classes.class_name, main.subjects_id, rooms.room_num, subjects.subject_name
            FROM main
            JOIN weekdays ON main.weekdays_id = weekdays.id_weekdays
            JOIN hours ON main.hours_id = hours.id_hours
            JOIN subjects ON main.subjects_id = subjects.id_subjects
            JOIN classes ON main.classes_id = classes.id_classes
            JOIN rooms ON main.rooms_id = rooms.id_rooms
            WHERE weekdays.weekday = 'Poniedziałek'
            ORDER BY hours.id_hours";


            $result = $link->query($sql);


            if ($result->num_rows > 0) {
                          echo "<h2>Rozkład na Poniedziałek </h2>";
                       echo "<table>";
                    echo "<tr><th>Godzina</th><th>Klasa</th><th>Przedmiot</th><th>Sala</th></tr>";

                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>{$row['hour_start']}-{$row['hour_end']}</td>";
                            echo "<td>{$row['class_name']}</td>";
                            echo "<td>{$row['subject_name']}</td>";
                            echo "<td>{$row['room_num']}</td>";
                            echo "</tr>";
                        }

                        echo "</table>";
                    } else {
                        echo "<p>Brak zaplanowanych lekcji na ten dzień.</p>";
                    }
                    $link->close();
            break;
        case "tuesday":
            $sql = "SELECT hours.hour_start,hours.hour_end, classes.class_name, main.subjects_id, rooms.room_num, subjects.subject_name
            FROM main
            JOIN weekdays ON main.weekdays_id = weekdays.id_weekdays
            JOIN hours ON main.hours_id = hours.id_hours
            JOIN subjects ON main.subjects_id = subjects.id_subjects
            JOIN classes ON main.classes_id = classes.id_classes
            JOIN rooms ON main.rooms_id = rooms.id_rooms
            WHERE weekdays.weekday = 'Wtorek'
            ORDER BY hours.id_hours";

$result = $link->query($sql);


if ($result->num_rows > 0) {
              echo "<h2>Rozkład na Wtorek </h2>";
           echo "<table>";
        echo "<tr><th>Godzina</th><th>Klasa</th><th>Przedmiot</th><th>Sala</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['hour_start']}-{$row['hour_end']}</td>";
                echo "<td>{$row['class_name']}</td>";
                echo "<td>{$row['subject_name']}</td>";
                echo "<td>{$row['room_num']}</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>Brak zaplanowanych lekcji na ten dzień.</p>";
        }

        $link->close();
                break;
        case "wednesday":
            $sql = "SELECT hours.hour_start,hours.hour_end,classes.class_name, main.subjects_id, rooms.room_num, subjects.subject_name
            FROM main
            JOIN weekdays ON main.weekdays_id = weekdays.id_weekdays
            JOIN hours ON main.hours_id = hours.id_hours
            JOIN subjects ON main.subjects_id = subjects.id_subjects
            JOIN classes ON main.classes_id = classes.id_classes
            JOIN rooms ON main.rooms_id = rooms.id_rooms
            WHERE weekdays.weekday = 'Środa'
            ORDER BY hours.id_hours";

$result = $link->query($sql);


if ($result->num_rows > 0) {
              echo "<h2>Rozkład na Środę</h2>";
           echo "<table>";
        echo "<tr><th>Godzina</th><th>Klasa</th><th>Przedmiot</th><th>Sala</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['hour_start']}-{$row['hour_end']}</td>";
                echo "<td>{$row['class_name']}</td>";
                echo "<td>{$row['subject_name']}</td>";
                echo "<td>{$row['room_num']}</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>Brak zaplanowanych lekcji na ten dzień.</p>";
        }
        $link->close();
            break;
        case "thursday":
            $sql = "SELECT hours.hour_start,hours.hour_end, classes.class_name, main.subjects_id, rooms.room_num, subjects.subject_name
            FROM main
            JOIN weekdays ON main.weekdays_id = weekdays.id_weekdays
            JOIN hours ON main.hours_id = hours.id_hours
            JOIN subjects ON main.subjects_id = subjects.id_subjects
            JOIN classes ON main.classes_id = classes.id_classes
            JOIN rooms ON main.rooms_id = rooms.id_rooms
            WHERE weekdays.weekday = 'Czwartek'
            ORDER BY hours.id_hours";

$result = $link->query($sql);


if ($result->num_rows > 0) {
              echo "<h2>Rozkład na Czwartek </h2>";
           echo "<table>";
        echo "<tr><th>Godzina</th><th>Klasa</th><th>Przedmiot</th><th>Sala</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['hour_start']}-{$row['hour_end']}</td>";
                echo "<td>{$row['class_name']}</td>";
                echo "<td>{$row['subject_name']}</td>";
                echo "<td>{$row['room_num']}</td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p>Brak zaplanowanych lekcji na ten dzień.</p>";
        }
        $link->close();
            break;
        case "friday":
            $sql = "SELECT hours.hour_start,hours.hour_end, classes.class_name, main.subjects_id, rooms.room_num, subjects.subject_name
            FROM main
            JOIN weekdays ON main.weekdays_id = weekdays.id_weekdays
            JOIN hours ON main.hours_id = hours.id_hours
            JOIN subjects ON main.subjects_id = subjects.id_subjects
            JOIN classes ON main.classes_id = classes.id_classes
            JOIN rooms ON main.rooms_id = rooms.id_rooms
            WHERE weekdays.weekday = 'Piątek'
            ORDER BY hours.id_hours";
             $result = $link->query($sql);


             if ($result->num_rows > 0) {
                           echo "<h2>Rozkład na Piątek </h2>";
                        echo "<table>";
                     echo "<tr><th>Godzina</th><th>Klasa</th><th>Przedmiot</th><th>Sala</th></tr>";
 
                         while ($row = $result->fetch_assoc()) {
                             echo "<tr>";
                             echo "<td>{$row['hour_start']}-{$row['hour_end']}</td>";
                             echo "<td>{$row['class_name']}</td>";
                             echo "<td>{$row['subject_name']}</td>";
                             echo "<td>{$row['room_num']}</td>";
                             echo "</tr>";
                         }
 
                         echo "</table>";
                     } else {
                         echo "<p>Brak zaplanowanych lekcji na ten dzień.</p>";
                     }
                     $link->close();
            break;
            case "saturday":
             
                echo "<h1>WEEKEND!!!!</h1>";
                echo '<iframe src="https://giphy.com/embed/THlB4bsoSA0Cc" width="480" height="432" frameBorder="0" class="giphy-embed" allowFullScreen></iframe><p><a href="https://giphy.com/gifs/skeleton-dancing-tellmeohtellme-THlB4bsoSA0Cc">via GIPHY</a></p>';
                break;

            case "sunday":
                echo "<h1>WEEKEND!!!!</h1>";
                echo '<iframe src="https://giphy.com/embed/THlB4bsoSA0Cc" width="480" height="432" frameBorder="0" class="giphy-embed" allowFullScreen></iframe><p><a href="https://giphy.com/gifs/skeleton-dancing-tellmeohtellme-THlB4bsoSA0Cc">via GIPHY</a></p>';
                break;



    }
    ?>
</body>
</html>
