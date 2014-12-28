<!DOCTYPE html>
<html>

<head>
    <title>Price List</title>
    <meta charset="utf-8" />
</head>

<body>
<form method="get" action="problem4.php">
    Price List: <textarea name="priceList" rows="15" cols="120"></textarea> <br/>
    <input type="submit" value="Send" name="submit"/>
</form>
<?php
if (isset($_GET['submit'])){
    $input = $_GET['priceList'];
    $categories = [];
    preg_match_all("|<td>\s*(.*?)\s*</td>\s*<td>\s*(.*?)\s*</td>\s*<td>\s*(.*?)\s*</td>\s*<td>\s*(.*?)\s*</td>|",$input,$match,PREG_SET_ORDER);
    foreach($match as $m){
        $category = html_entity_decode($m[2]);
        $item = [
            'product' => html_entity_decode($m[1]),
            'price' => html_entity_decode($m[3]),
            'currency' => html_entity_decode($m[4])];
        if(!isset($categories[$category])) $categories[$category] = [];
        array_push($categories[$category],$item);
    }
    ksort($categories);
    foreach($category as $cat => $it){
        usort($it, function($a,$b){
            return strcmp($a['product'],$b['product']);
        });
        $categories[$cat]=$it;
    }
    echo json_encode($categories);
}
?>
</body>

</html>