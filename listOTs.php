<html>
<title>OT List</title>
<style>
body {
    background-color: #00FF00;
}

.shug { display:block;text-align:center;width:50%;margin-right:200px;}
.split-para      { display:block;margin:10px;}
.split-para span { display:block;float:right;width:50%;margin-left:10px;}
</style>
<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

$off = $_COOKIE['off'];
$jin = file_get_contents("pokedata.json") or die("Unable to open file!");
$data = json_decode($jin, true);

$el = count($data);

$nar = [""];

for ($j = 0; $j < $el; $j++){
	$data[$j]['ID'] = substr($data[$j]['OT'],strripos($data[$j]['OT'],"("),strripos($data[$j]['OT'],")"));
}

usort($data, 'mySort');

for ($j = 0; $j < $el; $j++){
	$nar[$j] = $data[$j]['OT'];
}

$ct = array_count_values($nar);

foreach ($ct as $key => $value) {
    echo "$key: $value<br>";
	//echo "$key<br>";
}

function mySort($a, $b)
{
    $diff = strcmp($a['ID'],$b['ID']);
	if($diff == 0){
		return strcmp($a['OT'],$b['OT']); 
	} else {
		return $diff;
	}   
}

?>
</html>