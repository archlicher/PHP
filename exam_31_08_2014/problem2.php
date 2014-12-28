<!DOCTYPE html>
<html>
<head>
    <title>Semantic HTML</title>
    <style>
        label, textarea, input {
            display: block;
            margin: 10px 0;
        }
        textarea {
            width: 600px;
            height: 100px;
        }
    </style>
</head>
<body>

<form action="problem2.php" method="get">
    <label for="input1">Enter text here:</label>
        <textarea id="input1" name="html"></textarea>
    <input type="submit" value="Submit" name="submit"/>
</form>
<?php
if(isset($_GET['submit'])){
    $htmlTags = explode("\n",$_GET['html']);
    for($i=0;$i<count($htmlTags);$i++){
        preg_match_all('|<div |',$htmlTags[$i],$match);
        foreach($match as $m) {
            if (!empty($m)) {
                preg_match_all('|id\s*=\s*"(.*?)"|',$htmlTags[$i],$id);
                if(!empty($id[0])) {
                    $pattern = $id[0][0];
                    $htmlTags[$i] = str_replace("div", $id[1][0], $htmlTags[$i]);
                    $htmlTags[$i] = str_replace($pattern,"",$htmlTags[$i]);
                    $htmlTags[$i] = preg_replace("|\s*?>|",">",$htmlTags[$i]);
                    $htmlTags[$i] = preg_replace("|\s{2,}|"," ",$htmlTags[$i]);
                }
                preg_match_all('|class\s*=\s*"(.*?)"|',$htmlTags[$i],$class);
                if(!empty($class[0])) {
                    $pattern = $class[0][0];
                    $htmlTags[$i] = str_replace("div", $class[1][0], $htmlTags[$i]);
                    $htmlTags[$i] = str_replace($pattern,"",$htmlTags[$i]);
                    $htmlTags[$i] = preg_replace("|\s*?>|",">",$htmlTags[$i]);
                    $htmlTags[$i] = preg_replace("|\s{2,}|"," ",$htmlTags[$i]);
                }
            }
        }
        preg_match_all('|</div>|',$htmlTags[$i],$match);
        foreach($match as $m) {
            if (!empty($m)) {
                preg_match_all('|<!--\s*(.*?)\s*-->|',$htmlTags[$i],$tag);
                if(!empty($tag[0])){
                    $htmlTags[$i] = str_replace("div",$tag[1][0],$htmlTags[$i]);
                    $htmlTags[$i] = preg_replace("|\s*<!--\s*".$tag[1][0]."\s*-->|","",$htmlTags[$i]);

                }
            }
        }
    }
    foreach ($htmlTags as $tags=>$value){
        echo $value;
    }
}
?>

</body>
</html>