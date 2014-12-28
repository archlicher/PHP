<!DOCTYPE html>
<html>

<head>
    <title>Text Abbreviator</title>
    <meta charset="utf-8" />
</head>

<body>
<form method="get" action="problem1.php">
    List (JSON): <textarea name="list" rows="15" cols="75"></textarea> <br/>
    <input type="text" name="maxSize" value="50" />
    <input type="submit" value="Send" name="submit"/>
</form>
<?php
if(isset($_GET['submit'])){
    $text=explode("\n",$_GET['list']);
    $maxSize = intval($_GET['maxSize']);
    for($i=0;$i<count($text);$i++){
        $text[$i]=trim($text[$i]);
    }
    $output = "";
    echo "<ul>";
    foreach($text as $line){
        if($line!=''){
            if (strlen($line)>$maxSize){
                $output = substr($line,0,$maxSize)."...";
            }
            else $output = $line;
            echo "<li>".htmlspecialchars($output)."</li>";
        }
    }
    echo "</ul>";
}
?>
</body>

</html>
