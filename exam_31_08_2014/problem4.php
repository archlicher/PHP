<!DOCTYPE html>
<html>
<head>
    <title>SoftUni Students</title>
    <style>
        label {
            display: inline-block;
            margin: 5px 0;
        }
    </style>
</head>
<body>
<form action="problem4.php" method="get">
    <label for="column">Sort By:</label>
    <select name="column" id="column">
        <option value="id">id</option>
        <option value="username">username</option>
        <option value="result">result</option>
    </select><br>
    Show:
    <input type="radio" id="asc" name="order" value="ascending"/>
    <label for="asc">Ascending</label>
    <input type="radio" id="desc" name="order" value="descending"/>
    <label for="desc">Descending</label><br>
    <label for="students">Students:</label><br>
        <textarea name="students" id="students" cols="50" rows="10"></textarea><br>
    <input type="submit" value="Submit" name="submit"/>
</form>
<?php
if(isset($_GET['submit'])){
    $sortOption = $_GET['column'];
    $order = $_GET['order'];
    $input = explode("\n",$_GET['students']);
    $students = [];
    $index =0;
    foreach ($input as $inp){
        if($inp!="") {
            $students[$index] = ['id' => 0, 'username' => "", 'email' => "", 'type' => "", 'result' => 0];
            $temp = explode(", ", $inp);
            $students[$index]['id'] = $index + 1;
            $students[$index]['username'] = trim($temp[0]);
            $students[$index]['email'] = trim($temp[1]);
            $students[$index]['type'] = trim($temp[2]);
            $students[$index]['result'] = intval($temp[3]);
            $index++;
        }
    }
    usort($students, function($a,$b) use ($sortOption,$order){
        if ($sortOption == "username") {
            if($a['username']==$b['username']) return (($order=='ascending')^$a['id']<$b['id']? 1:-1);
            else return strcmp($a['username'],$b['username']);
        }
        if ($a[$sortOption]==$b[$sortOption]) return (($order=='ascending')^$a['id']<$b['id']? 1:-1);
        else return(($order=='ascending')^$a[$sortOption]<$b[$sortOption]? 1:-1);
    });
    echo "<table><thead><tr><th>Id</th><th>Username</th><th>Email</th><th>Type</th><th>Result</th></tr></thead>";
    foreach ($students as $std){
        echo "<tr><td>".$std['id']."</td><td>".htmlspecialchars($std['username'])."</td><td>".htmlspecialchars($std['email'])."</td><td>".htmlspecialchars($std['type'])."</td><td>".htmlspecialchars($std['result'])."</td></tr>";
    }
    echo "</table>";
}
?>
</body>
</html>