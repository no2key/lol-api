<?php include('simple_html_dom.php'); ?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
<?php
function fetchDuowan($htmlstring){

    // get DOM from URL or file
    $html = file_get_html($htmlstring);

    foreach($html->find('#champion_list li') as $element) {

        $pattern = '/heros\/(\S+)\//';
        preg_match($pattern, $element->children(0)->href, $matches, PREG_OFFSET_CAPTURE, 3);
        print_r($matches);
       //print_r($element->children(0)->href);
       echo "<img src='".$element->children(0)->children(0)->src."'>";
       print_r($element->children(1)->plaintext);
    }

    //return $data;
}

    $duowan = fetchDuowan("http://lol.duowan.com/s/heroes.html");

    //$resultString = json_encode($duowan);



    //file_put_contents('hero/heroList.json', $resultString);


?>

</body>
</html>