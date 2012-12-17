<?php include('simple_html_dom.php'); ?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
<?php

function fetchHeroList(){
    $html = file_get_html("http://lol.duowan.com/s/heroes.html");
    $heroList = array();
    foreach($html->find('#champion_list li') as $element) {
        $pattern = '/heros\/(\S+)\//';
        preg_match($pattern, $element->children(0)->href, $matches, PREG_OFFSET_CAPTURE, 3);
        $hero = new stdClass();
        $hero->slug = $matches[1][0];
        $hero->name = $element->children(1)->plaintext;
        $hero->thumb = $element->children(0)->children(0)->src;

        array_push($heroList,$hero);
    }

    return $heroList;
}


    $duowan = fetchHeroList();
    $resultString = json_encode($duowan);
    echo $resultString;

    file_put_contents('api/hero-list.json', $resultString);


?>

</body>
</html>