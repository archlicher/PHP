    <!DOCTYPE html>
    <html>
    <head>
        <title></title>
        <style>
            label, textarea {
                display: block;
            }
            textarea {
                width: 500px;
                height: 150px;
            }
        </style>
    </head>
    <form action="problem3.php" method="get">
        <label>Text:</label>
        <textarea name="text"></textarea>
        <input type="submit" value="SUBMIT" name="submit"/>
    </form>
    <?php
        if(isset($_GET['submit'])){
            $article = [];
            $text = $_GET['text'];
            var_dump($text);
            preg_match_all("/\s*([\w\s\-]+)\s*%\s*([\w\s\.\-]+)\s*;\s*[0-9]{2}-([0-9]{2})-[0-9]{4}\s*-\s*(.*)\s*/",$text,$messages);
            for($i=0;$i<count($messages[0]);$i++){
                $topic = htmlspecialchars(trim($messages[1][$i]));
                $author = htmlspecialchars(trim($messages[2][$i]));
                $month = setMonth(trim($messages[3][$i]));
                $summary = htmlspecialchars(trim(substr($messages[4][$i],0,100)))."...";
                $article[$i] = "<div>\n<b>Topic:</b> <span>$topic</span>\n".
                                "<b>Author:</b> <span>$author</span>\n".
                                "<b>When:</b> <span>$month</span>\n".
                                "<b>Summary:</b> <span>$summary</span>\n</div>";
            }
            echo implode("\n",$article);
        }
    function setMonth($arg){
        $tempMonth = "";
        switch ($arg){
            case '01':$tempMonth="January";break;
            case '02':$tempMonth="February";break;
            case '03':$tempMonth="March";break;
            case '04':$tempMonth="April";break;
            case '05':$tempMonth="May";break;
            case '06':$tempMonth="June";break;
            case '07':$tempMonth="July";break;
            case '08':$tempMonth="August";break;
            case '09':$tempMonth="September";break;
            case '10':$tempMonth="October";break;
            case '11':$tempMonth="November";break;
            case '12':$tempMonth="December";break;
        }
        return $tempMonth;
    }
    ?>
    </body>
    </html>
