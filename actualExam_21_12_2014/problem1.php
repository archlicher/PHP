<!DOCTYPE html>
<html>
<head>
    <title>Username Parser</title>
    <meta charset="utf-8" />
</head>
<body>
<form method="GET" action="problem1.php">
    <label for="list">
        Username list:
        <br/>
        <textarea rows="10" cols="40" name="list" id="list"></textarea>
    </label>
    <br/>
    <br/>
    <label for="length">
        Minimum length:
        <br/>
        <input type="text" name="length" id="length"/>
    </label>
    <br/>
    <br/>
    <label for="show">
        Show all usernames?
        <input type="checkbox" name="show" id="show"/>
    </label>
    <br/>
    <br/>
    <input type="submit" name="submit"/>
</form>
<?php
if(isset($_GET['submit'])){
    $input = preg_split("/\r?\n/",$_GET['list'],-1,PREG_SPLIT_NO_EMPTY);
    $maxLength = intval($_GET['length']);
    $display =$_GET['show'];
    $output = [];
    foreach($input as $name){
        if (strlen($name)>=$maxLength){
            $temp = "<li>".htmlspecialchars($name)."</li>";
            array_push($output,$temp);
        } else if($display=='on'){
            $temp = '<li style="color: red;">'.htmlspecialchars($name).'</li>';
            array_push($output,$temp);
        }
    }
    echo "<ul>";
    echo implode("",$output);
    echo "</ul>";
}
?>
</body>
</html>