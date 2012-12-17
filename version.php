<?php include('simple_html_dom.php'); ?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title></title>
</head>
<body>
<?php
function getVersion($htmlstring,$filterstring){

    // get DOM from URL or file
    $html = file_get_html($htmlstring);
    $version = '';
   // find author
    if($e = $html->find($filterstring,0)){
       $version = $e->xmltext;
    }
    return $version;
}

?>


<?php
    $version_string = getVersion("http://lol.duowan.com/",'div.patch .J_content h4');
    print_r($version_string);
?>

</body>
</html>