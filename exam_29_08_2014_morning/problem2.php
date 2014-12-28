<!DOCTYPE html>
<html>
<head>
    <title>Chat Logger</title>
    <style>
        textarea {
            width: 400px;
            height: 100px;
        }
        select, textarea, input {
            display: block;
            margin: 5px;
        }
    </style>
</head>
<body>

<form action="problem2.php" method="get">
    <label>Current Date:</label>
    <input type="text" name="currentDate"/>
    <label>Messages:</label>
    <textarea name="messages"></textarea>
    <input type="submit" value="SUBMIT" name="submit"/>
</form>
<?php
if(isset($_GET['submit'])) {
    date_default_timezone_get('UTF');
    $currentDate = strtotime($_GET['currentDate']);
    $text = $_GET['messages'];
    $messages = preg_split("/\r?\n/", $text);
    foreach ($messages as $message) {
        $temp = explode(" / ", $message);
        $messagesAndDates[$temp[0]] = strtotime($temp[1]);
    }
    $ltime = 0;
    asort($messagesAndDates);
    foreach ($messagesAndDates as $key => $value) {
        $output = htmlspecialchars($key);
        $ltime = $value;
        echo "<div>$output</div>\n";
    }
    $time = "";
    $time = calcTimeStamp($ltime, $currentDate);
    echo "<p>Last active: <time>$time</time></p>";
}
function calcTimeStamp($arg1,$arg2){
    $lastTimeActive = '';
    $curDate = $arg2;
    $inputDate = $arg1;
    $outputDate = $curDate - $inputDate;
    $lastDay = date('z', $inputDate);
    $currentDay = date('z', $curDate);
    var_dump($lastDay);
    var_dump($currentDay);
    if ($lastDay == $currentDay) {
        if ($outputDate < 60) $lastTimeActive = 'a few moments ago';
        else if ($outputDate < 3600) {
            $minutes = floor($outputDate / 60);
            $lastTimeActive = "$minutes minute(s) ago";
        } else if ($outputDate <60*60*24) {
            $hours = floor($outputDate/3600);
            $lastTimeActive = "$hours hour(s) ago";
        }
    } else {
        if ($currentDay-1 == $lastDay) $lastTimeActive = 'yesterday';
        else $lastTimeActive= date('d-m-Y',$arg1);
    }
    return $lastTimeActive;
}
?>
</body>
</html>