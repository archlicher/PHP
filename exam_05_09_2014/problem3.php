<!DOCTYPE html>
<html>
<head>
    <title>Facebook Posts</title>
    <style>
        label, textarea {
            display: block;
        }
        textarea {
            width: 450px;
            height: 150px;
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
<body>
<h2>Zero Test #1</h2>
<form action="problem3.php" method="get">
    <label for="text">Text:</label>
    <textarea name="text"></textarea>
    <input type="submit" value="SUBMIT" name = "submit"/>
</form>
<?php
date_default_timezone_set('UTC');
if(isset($_GET['submit'])){
    $text = preg_split("/\r?\n/",$_GET['text'],-1,PREG_SPLIT_NO_EMPTY);
    $output = [];
    $noComments = false;
    foreach($text as $line) {
        $post = explode(";", $line);
        $time = strtotime($post[1]);
        $date = calcDate($post[1]);
        $temp = '<article><header><span>'.htmlspecialchars(trim($post[0])).'</span><time>'.$date.'</time></header><main><p>'.htmlspecialchars(trim($post[2])).'</p></main><footer><div class="likes">'.htmlspecialchars(trim($post[3])).' people like this</div>';
        if(!empty($post[4])) {
            $temp.='<div class="comments">';
            $comm = explode("/",$post[4]);
            foreach($comm as $c){
                $temp .= "<p>".htmlspecialchars(trim($c))."</p>";
            }
            $temp.="</div>";
        }
        $temp.= "</footer></article>";
        $output[$time] = $temp;
    }
    krsort($output);
    echo implode("",$output);
}
function calcDate($dates){
    $formDate = '';
    $splitDate = explode("-",$dates);
    $d = intval($splitDate[0]);
    $formDate .=$d." ";
    $m = intval($splitDate[1]);
    switch ($m){
        case 1:$formDate .="January ";break;
        case 2:$formDate .="February ";break;
        case 3:$formDate .="March ";break;
        case 4:$formDate .="April ";break;
        case 5:$formDate .="May ";break;
        case 6:$formDate .="June ";break;
        case 7:$formDate .="July ";break;
        case 8:$formDate .="August ";break;
        case 9:$formDate .="September ";break;
        case 10:$formDate .="October ";break;
        case 11:$formDate .="November ";break;
        case 12:$formDate .="December ";break;
    }
    $formDate.=$splitDate[2];
    return $formDate;
}
?>
</body>
</html>