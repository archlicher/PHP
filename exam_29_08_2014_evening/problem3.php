<!DOCTYPE html>
<html>

<head>
    <title>Largest Rectangle</title>
    <meta charset="utf-8" />
</head>

<body>
<form method="get" action="problem3.php">
    Price List: <textarea name="jsonTable" rows="10" cols="40"></textarea><br/>
    <input type="submit" value="Send" name="submit"/>
</form>
<?php
if(isset($_GET['submit'])){
    $input = json_decode($_GET['jsonTable']);
    $minColumn = 0;
    $maxColumn = 0;
    $minRows = 0;
    $maxRows = 0;
    $maxArea = 0;
    for($minRow = 0;$minRow<count($input);$minRow++){
        for($maxRow = $minRow;$maxRow<count($input);$maxRow++){
            for($minCol = 0;$minCol<count($input[$minRow]);$minCol++){
                for($maxCol=$minCol;$maxCol<count($input[$maxRow]);$maxCol++){
                    if(isRectangle($input,$minRow,$maxRow,$minCol,$maxCol)){
                        $area = ($maxRow-$minRow+1)*($maxCol-$minCol+1);
                        if($area>$maxArea){
                            $maxArea = $area;
                            $minColumn = $minCol;
                            $maxColumn = $maxCol;
                            $minRows = $minRow;
                            $maxRows = $maxRow;
                        }
                    }
                }
            }
        }
    }
    echo "<table border='1' cellpadding='5'>";
    for($row = 0;$row<count($input);$row++){
        echo "<tr>";
        for($col=0;$col<count($input[$row]);$col++){
            $topBorder = ($row == $minRows) && ($col>=$minColumn) && ($col<=$maxColumn);
            $botBorder = ($row == $maxRows) && ($col>=$minColumn) && ($col<=$maxColumn);
            $rightBorder = ($col == $maxColumn) && ($row>=$minRows) && ($row<=$maxRows);
            $leftBorder = ($col == $minColumn) && ($row>=$minRows) && ($row<=$maxRows);
            if ($topBorder || $botBorder || $rightBorder || $leftBorder) echo "<td style='background:#CCC'>";
            else echo "<td>";
            echo htmlspecialchars($input[$row][$col])."</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}
function isRectangle($input,$minRow,$maxRow,$minCol,$maxCol){
    $value = $input[$minRow][$minCol];
    for($i = $minRow;$i<=$maxRow;$i++){
        if ($input[$i][$minCol]!=$value) return false;
        if ($input[$i][$maxCol]!=$value) return false;
    }
    for($j = $minCol;$j<=$maxCol;$j++){
        if ($input[$minRow][$j]!=$value) return false;
        if ($input[$maxRow][$j]!=$value) return false;
    }
    return true;
}
?>
</body>

</html>
