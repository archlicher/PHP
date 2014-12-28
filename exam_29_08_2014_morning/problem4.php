<!DOCTYPE html>
<html>
<head>
    <title>SoftUni Tunes</title>
    <style>
        textarea {
            width: 500px;
            height: 200px;
        }
        select, textarea, input {
            display: block;
            margin: 5px;
        }
    </style>
</head>
<body>
<form action="problem4.php" method="get">
    <label>Text:</label>
    <textarea name="text"></textarea>
    <label>Artist:</label>
    <input type="text" name="artist"/>
    <label>Sort by:</label>
    <select name="property">
        <option value="name">name</option>
        <option value="genre">genre</option>
        <option value="downloads">downloads</option>
        <option value="rating" selected>rating</option>
    </select>
    <label>Order by:</label>
    <select name="order">
        <option value="ascending">ascending</option>
        <option value="descending">descending</option>
    </select>
    <input type="submit" value="SUBMIT" name="submit"/>
</form>
<?php
if(isset($_GET['submit'])){
    $input = $_GET['text'];
    $order = $_GET['order'];
    $property = $_GET['property'];
    $artist = $_GET['artist'];
    $tempArr = explode("\n",$input);
    $songs = [];
    $index = 0;
    foreach ($tempArr as $temp){
        $song = explode("|",$temp);
        $songs[$index]['name'] = trim($song[0]);
        $songs[$index]['genre'] = trim($song[1]);
        $tempArtists= explode(', ',trim($song[2]));
        sort($tempArtists);
        $songs[$index]['artist'] = $tempArtists;
        $songs[$index]['downloads'] = intval($song[3]);
        $songs[$index]['rating'] = floatval($song[4]);
        $index++;
    }
    usort($songs, function($a,$b) use ($property,$order){
        if ($a[$property] == $b[$property]) return strcmp($a['name'],$b['name']);
        return (($order=='ascending' ^ $a[$property] < $b[$property]) ? 1:-1);
    });
    echo "<table>\n<tr><th>Name</th><th>Genre</th><th>Artists</th><th>Downloads</th><th>Rating</th></tr>\n";
    for ($i=0;$i<count($songs);$i++){
        if(in_array($artist,$songs[$i]['artist'])){
            echo "<tr><td>".htmlentities($songs[$i]['name'])."</td><td>".
                htmlentities($songs[$i]['genre'])."</td><td>".htmlentities(implode(', ',$songs[$i]['artist'])).
                "</td><td>".htmlentities($songs[$i]['downloads'])."</td><td>".htmlentities($songs[$i]['rating'])."</td></tr>\n";
        }
    }
    echo "</table>";
}
?>
</body>
</html>