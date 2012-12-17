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
    $data['story'] = '';
   // find story
    if($e = $html->find('.intro_2 .content',0)){
        $data['story'] = $e->xmltext;
    }
    //find strong
    if($e = $html->find('.use_l',0)){
        $data['strong'] = $e->xmltext;
    }
    //find weak
    if($e = $html->find('.use_r',0)){
        $data['weak'] = $e->xmltext;
    }
    return $data;
}

function fetchUuu9($htmlstring){

    // get DOM from URL or file
    $html = file_get_html($htmlstring);
    $data['story'] = '';
   // find story
    if($e = $html->find('.intro_box .padding_10',0)){
        $data['story'] = iconv("gb2312//IGNORE","utf-8",$e->xmltext);
    }
    return $data;
}

function saveBasicBarHtml($htmlstring,$heroName){
    $html = file_get_html($htmlstring);
    $barHtml = '';
   // find barHtml
    if($e = $html->find('.value',0)){
        $barHtml = $e->outertext;
    }
    $current = file_get_contents('hero/template/basicBarHeader.html');

    $current .= $barHtml;
    if(!is_dir("/hero".$heroName)){
        mkdir("/hero".$heroName, 0777);
    }
    file_put_contents('hero/'.$heroName.'/basicBar.html', $current);
}
?>


<?php
    $duowan = fetchDuowan("http://lol.duowan.com/".$heroName);
    $uuu9 = fetchUuu9("http://lol.uuu9.com/hero/".$heroName.".shtml");
    $result = array_merge($duowan,$uuu9);
    $resultString = json_encode($result);
    file_put_contents('hero/'.$heroName.'/basic.json', $resultString);

saveBasicBarHtml("http://lol.duowan.com/".$heroName,$heroName);

?>

</body>
</html>