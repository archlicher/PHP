<!DOCTYPE html>
<html>
<head>
    <title>Error Logger</title>
    <style>
        textarea, label {
            display: block;
        }
        textarea {
            width: 600px;
            height: 200px;
        }
        form {
            margin-bottom: 30px;
        }
        input[type="submit"] {
            margin: 5px;
        }
        h2 {
            margin: 0;
        }
    </style>
</head>
<body>
<h2>Zero Test #1</h2>
<form method="GET" action="problem2.php">
    <label>Error log:</label>
    <textarea name="errorLog"></textarea>
    <input type="submit" value="SUBMIT" name="submit"/>
</form>
<?php
if(isset($_GET['submit'])){
    $text = explode("\n",$_GET['errorLog']);
    $output = [];
    $i = 0;
    foreach ($text as $line) {
        if(empty($exception)){
            preg_match("|.*? java\..*?(\w+): \d|", $line, $exception);
        }
        if(empty($methodFileLine)) {
            preg_match("|.*?.(\w+)\((.*?):(\d+)\)|", $line, $methodFileLine);
            if(empty($exception))unset($methodFileLine);
        }
        if(!empty($exception) && !empty($methodFileLine)){
            $output[$i] = "line <strong>".$methodFileLine[3]."</strong> - <strong>".htmlspecialchars($exception[1])."</strong> in <em>".htmlspecialchars($methodFileLine[2]).":".htmlspecialchars($methodFileLine[1])."</em>";
            unset($exception);
            unset($methodFileLine);
            $i++;
        }
    }
    echo "<ul>";
    foreach ($output as $out){
        echo "<li>$out</li>";
    }
    echo "</ul>";
}
?>
</body>
</html>