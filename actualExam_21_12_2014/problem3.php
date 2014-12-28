<!DOCTYPE html>
<html>

<head>
    <title>Affine Encoder</title>
    <meta charset="utf-8" />
</head>

<body>
<form method="get" action="problem3.php">
    <label for="jsonTable">
        Text to encrypt:
        <br/>
        <textarea name="jsonTable" id="jsonTable" rows="10" cols="40"></textarea>
    </label>
    <br/>
    <input type="submit" name="submit"/>
</form>
<?php
if(isset($_GET['submit'])) {
    $text = json_decode($_GET['jsonTable']);
    $k = intval($text[1][0]);
    $s = intval($text[1][1]);
    $alphabet = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
    $maxLength = 0;
    foreach ($text[0] as $word) {
        if (strlen($word) > $maxLength) $maxLength = strlen($word);
    }
    $maxLength--;
    if (count($text[0]) == 1 && $text[0] == " ") {
        echo "<table border='1' cellpadding='5'><tr><td style='background:#CCC'></td></tr></table>";
    } else {
        echo "<table border='1' cellpadding='5'>";
        foreach ($text[0] as $word) {
            echo "<tr>";
            for ($i = 0; $i < strlen($word); $i++) {
                if (ctype_alpha($word[$i])) {
                    $m = 26;
                    $x = array_search($word[$i], $alphabet);
                    $temp = ($k * $x + $s) % $m;
                    echo "<td style='background:#CCC'>" . $alphabet[$temp] . "</td>";
                } else echo "<td style='background:#CCC'>" . htmlspecialchars($word[$i]) . "</td>";
                if ($i == (strlen($word) - 1) && $i < $maxLength) {
                    while ($i < $maxLength) {
                        echo "<td></td>";
                        $i++;
                    }
                }
            }
            echo "</tr>";
        }
        echo "</table>";
    }
}
?>
</body>

</html>