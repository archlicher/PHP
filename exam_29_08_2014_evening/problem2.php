<!DOCTYPE html>
<html>

<head>
    <title>Uppercase Words</title>
    <meta charset="utf-8" />
</head>

<body>
<form method="get" action="problem2.php">
    Price List: <textarea name="text" rows="15" cols="120"></textarea> <br/>
    <input type="submit" value="Send" name="submit"/>
</form>
<?php
if (isset($_GET['submit'])){
    $text = $_GET['text'];
    $temp = '';
    $newText = '';
    for ($i=0;$i<strlen($text);$i++){
        $char = $text[$i];
        if(ctype_alpha($char)){
            $temp .=$char;
        } else {
            $newText .= processWord($temp);
            $newText.=$char;
            $temp = '';
        }
    }
    $newText .= processWord($temp);
    echo "<p>".htmlspecialchars($newText)."</p>";
}
function processWord($arg){
    if(ctype_upper($arg)){
        $reversed = strrev($arg);
        if($reversed == $arg){
            return doubleLetters($reversed);
        } else return $reversed;
    } else return $arg;
}
function doubleLetters($arg1){
    $doubledLetters = '';
    for($j = 0;$j<strlen($arg1);$j++){
        $doubledLetters.=$arg1[$j].$arg1[$j];
    }
    return $doubledLetters;
}
?>
</body>

</html>
