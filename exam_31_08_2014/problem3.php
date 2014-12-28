<!DOCTYPE html>
<html>
<head>
    <title>Text Gravity</title>
    <style>
        label, input, textarea {
            display: block;
        }
        textarea {
            width: 300px;
            height: 100px;
        }
    </style>
</head>
<body>
<form method="get" action="problem3.php">
    <label>Text:</label>
    <textarea name="text"></textarea>
    <label>Line length:</label>
    <input type="text" name="lineLength" value="10"/>
    <input type="submit" value="SUBMIT" name="submit"/>
</form>
<?php
if(isset($_GET['submit'])){
    $input = $_GET['text'];
    $lineLength = intval($_GET['lineLength'])-1;
    $matrix = [];
    $row = 0;
    $col = 0;
    for ($i=0;$i<strlen($input);$i++){
        $matrix[$row][$col] = $input[$i];
        $col++;
        if($col>$lineLength && ($lineLength+1)!=strlen($input) && $i!=(strlen($input)-1)){
            $col=0;
            $row++;
        }
    }
    if($col<=$lineLength){
        while ($col<$lineLength+1){
            $matrix[$row][$col] = " ";
            $col++;
        }
    }
    $col--;
    $maxRow = $row;
    for($j=0;$j<$maxRow;$j++) {
        $row = $maxRow;
        for ($i = 0; $i < $maxRow; $i++) {
            $col = $lineLength;
            while ($col > -1) {
                if ($matrix[$row][$col] == " ") {
                    $matrix[$row][$col] = $matrix[$row - 1][$col];
                    $matrix[$row - 1][$col] = " ";
                }
                $col--;
            }
            $row--;
        }
    }
    echo "<table>";
    for($row=0;$row<=$maxRow;$row++){
        echo "<tr>";
        for ($col=0;$col<=$lineLength;$col++){
            echo "<td>".htmlspecialchars($matrix[$row][$col])."</td>";
        }
        echo "</tr>";
    }
    echo "<table>";
}
?>
</body>
</html>