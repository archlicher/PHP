<!DOCTYPE html>
<html>

<head>
    <title>Email Encryptor</title>
    <meta charset="utf-8" />
</head>

<body>
<form method="get" action="problem1.php">
    To: <input type="text" name="recipient"/> <br/>
    Subject: <input type="text" name="subject"/> <br/>
    Message body: <br/><textarea rows="10" cols="80" name="body"></textarea> <br/>
    Encryption key: <input type="text" name="key"/> <br/>
    <input type="submit" value="Send" name="submit"/>
</form>
<?php
if (isset($_GET['submit'])){
    $recipient = htmlspecialchars($_GET['recipient']);
    $subject = htmlspecialchars($_GET['subject']);
    $message = htmlspecialchars($_GET['body']);
    $encryption = $_GET['key'];
    $formatMessage = "<p class='recipient'>$recipient</p><p class='subject'>$subject</p><p class='message'>$message</p>";
    $impl= " | ";
    $output = [];
    for($i=0;$i<strlen($formatMessage);$i++){
        array_push($output, ord($formatMessage[$i]));
    }
    $key = [];
    for($i=0;$i<strlen($encryption);$i++){
        array_push($key,ord($encryption[$i]));
    }
    $index = 0;
    foreach($output as $value){
        echo "|".dechex($value*$key[$index]);
        $index++;
        if($index==count($key))$index =0;
    }
    echo "|";
}
?>

</body>

</html>