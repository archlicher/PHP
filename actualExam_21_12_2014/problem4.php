<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Book Store</title>
</head>
<body>
<form action="problem4.php" method="GET">
    <div>
        <label for="text">
            Input
            <br/>
                <textarea name="text" id="text" rows="18" cols="100"></textarea>
        </label>
    </div>
    <div>
        <label for="min-price">
            Min Price:
            <br/>
            <input type="text" name="min-price" id="min-price"/>
        </label>
    </div>
    <div>
        <label for="max-price">
            Max Price:
            <br/>
            <input type="text" name="max-price" id="max-price"/>
        </label>
    </div>
    <div>
        <label for="sort">
            Sort by:
            <br/>
            <select name="sort" id="sort">
                <option value="genre">genre</option>
                <option value="author">author</option>
                <option value="publish-date">publish date</option>
            </select>
        </label>
    </div>
    <div>
        <label for="order">
            Order:
            <br/>
            <select name="order" id="order">
                <option value="ascending">ascending</option>
                <option value="descending">descending</option>
            </select>
        </label>
    </div>
    <input type="submit" name="submit"/>
</form>
<?php
date_default_timezone_set('UTC');
if(isset($_GET['submit'])){
    $text = preg_split("/\r?\n/",$_GET['text'],-1,PREG_SPLIT_NO_EMPTY);
    $minPrince = floatval($_GET['min-price']);
    $maxPrice = floatval($_GET['max-price']);
    $sortOption = $_GET['sort'];
    $order = $_GET['order'];
    $output = [];
    foreach($text as $line){
        $temp = explode("/",$line);
        $timeAsNum = strtotime($temp[4]);
        $output[$timeAsNum] = ['author' => '',
                            'name' => '',
                            'genre' => '',
                            'price' => 0,
                            'publish date' => '',
                            'info' => ''];
        $output[$timeAsNum]['author'] = $temp[0];
        $output[$timeAsNum]['name'] = $temp[1];
        $output[$timeAsNum]['genre'] = $temp[2];
        $output[$timeAsNum]['price'] = floatval($temp[3]);
        $output[$timeAsNum]['publish date'] = $temp[4];
        $output[$timeAsNum]['info'] = $temp[5];
    }
    $printToCons = [];
    foreach($output as $time){
        $price = $time['price'];
        if($price>=$minPrince && $price<=$maxPrice){
            $index = strtotime($time['publish date']);
            if(!isset($printToCons[$index])) $printToCons[$index]=[];
            array_push($printToCons[$index],$time);
        }
    }
    if ($sortOption == 'publish-date' && $order == 'ascending'){
        ksort($printToCons);
    } else if ($sortOption == 'publish-date' && $order == 'descending'){
        krsort($printToCons);
    } else {
        usort($printToCons, function($a,$b) use ($order,$sortOption){
            $alpha = $a[0][$sortOption];
            $beta = $b[0][$sortOption];
            if($a[0]['genre'] == $b[0]['genre'] && $a[0]['author'] == $b[0]['author']) return $a>$b;
            else if($alpha==$beta) {
                return $a>$b;
            } else {
                $size = strcmp($alpha,$beta);
                if($order == 'ascending')return $size;
                else {
                    if($size<0)return true;
                    else return false;
                }
            }
        });
    }
    foreach($printToCons as $cons){
        $pr = calcPrice($cons[0]['price']);
        echo "<div>";
        echo "<p>".htmlspecialchars($cons[0]['name'])."</p>";
        echo "<ul><li>".htmlspecialchars($cons[0]['author'])."</li><li>".htmlspecialchars($cons[0]['genre'])."</li><li>".$pr.
            "</li><li>".htmlspecialchars($cons[0]['publish date'])."</li><li>".htmlspecialchars($cons[0]['info'])."</li></ul></div>";
    }
}
function calcPrice($str){
    $a = strpos($str,'.');
    if($a===false){
        return $str.".00";
    } else if ($a == strlen($str)-2) return $str."0";
    else if($a<strlen($str)-3) return substr($str,0,$a+3);
    else return $str;
}
?>
</body>
</html>