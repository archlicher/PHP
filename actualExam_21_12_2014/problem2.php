<!DOCTYPE html>
<html>
<head>
    <title>Sum of All Values</title>
    <meta charset="utf-8" />
</head>
<body>
<form method="GET" action="problem2.php">
    <label for="keys">
        Keys string:
        <br/>
        <input type="text" name="keys" id="keys"/>
    </label>
    <br/>
    <br/>
    <label for="text">
        Text string:
        <br/>
        <textarea rows="6" cols="40" name="text" id="text"></textarea>
    </label>
    <br/>
    <br/>
    <input type="submit" name="submit"/>
</form>
<?php
if(isset($_GET['submit'])){
    $key = preg_split("/\d+/",$_GET['keys'],-1,PREG_SPLIT_NO_EMPTY);
    $text = $_GET['text'];
    $output = 0;
    if(count($key)<2){
        echo "<p>A key is missing</p>";
    } else {
        $index = count($key)-1;
        $pattern = "/".$key[0]."(.*?)".$key[$index]."/";
        preg_match_all($pattern,$text,$match);
        var_dump($match);
        foreach($match[1] as $m){
            if(is_numeric($m)) {
                $output += floatval($m);
            }
        }
        if($output!=0){
            echo "<p>The total value is: <em>".htmlspecialchars($output)."</em></p>";
        } else echo "<p>The total value is: <em>nothing</em></p>";
    }
}
?>
</body>
</html>