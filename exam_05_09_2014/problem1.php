<!DOCTYPE html>
<html>
<head>
    <title>Rainbow Letters</title>
    <style>
        input {
            margin: 3px;
        }
        label {
            display: inline-block;
            width: 70px;
        }
    </style>
</head>
<body>
<form action="problem1.php" method="get">
    <label for="text">Text:</label>
    <input type="text" name="text" id="text"/><br>
    <label for="red">Red:</label>
    <input type="text" name="red" id="red"/><br>
    <label for="green">Green:</label>
    <input type="text" name="green" id="green"/><br>
    <label for="blue">Blue:</label>
    <input type="text" name="blue" id="blue"/><br>
    <label for="nth">Nth letter:</label>
    <input type="text" name="nth" id="nth"/><br>
    <input type="submit" value="SUBMIT" name="submit"/>
</form>
<?php
if(isset($_GET['submit'])){
    $text = $_GET['text'];
    $red = intval($_GET['red']);
    $green = intval($_GET['green']);
    $blue = intval($_GET['blue']);
    $index = intval($_GET['nth']);
    $redHex = dechex($red);
    if(strlen($redHex)==1) $redHex = '0'.$redHex;
    $greenHex = dechex($green);
    if(strlen($greenHex)==1) $greenHex = '0'.$greenHex;
    $blueHex = dechex($blue);
    if(strlen($blueHex)==1) $blueHex = '0'.$blueHex;
    $color = strtolower("#".$redHex.$greenHex.$blueHex);
    $output = "";
    for($i=0;$i<strlen($text);$i++){
        if (($i+1)%$index == 0){
            $output .= '<span style="color: '.htmlspecialchars($color).'">'.htmlspecialchars($text[$i]).'</span>';
        } else $output.=htmlspecialchars($text[$i]);
    }
    echo "<p>".$output."</p>";
}
?>
</body>
</html>