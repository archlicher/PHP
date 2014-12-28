<!DOCTYPE html>
<html>
<head>
    <title>Drop it</title>
</head>
<body>
<form action="problem1.php" method="get">
    <input type="text" name="text"/>
    <input type="text" name="minFontSize"/>
    <input type="text" name="maxFontSize"/>
    <input type="text" name="step"/>
</form>
<?php
$text=$_GET["text"];
$minFont = intval($_GET["minFontSize"]);
$currentFont = $minFont;
$changeDirection = true;
$maxFont = intval($_GET["maxFontSize"]);
$step = intval($_GET["step"]);
$output="";
$stroke = "";
for($i=0;$i<strlen($text);$i++){
    if(ord($text[$i])%2==0){
        $stroke = "text-decoration:line-through;";
    }
    echo "<span style='font-size:$currentFont;$stroke'>".htmlspecialchars($text[$i])."</span>";
    $stroke = "";
    if (isLetter($text[$i])){
        if($changeDirection){
            $currentFont+=$step;
        }
        else {
            $currentFont-=$step;
        }
    }
    if (isLetter($text[$i]) && ($currentFont>=$maxFont || $currentFont<=$minFont)) $changeDirection =!$changeDirection;
}
function isLetter($arg){
    if ((ord($arg)>=ord('a') && ord($arg)<=ord('z')) ||
        (ord($arg)>=ord('A') && ord($arg)<=ord('z'))) return true;
    else return false;
}
?>
</body>
</html>