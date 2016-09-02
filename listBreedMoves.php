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

$jin = file_get_contents("pokedata.json") or die("Unable to open file!");
$data = json_decode($jin, true);

$el = count($data);

$nar3 = [""];
$nar4 = [""];
$nar5 = [""];
$nar6 = [""];

for ($j = 0; $j < $el; $j++){
	if($data[$j]['Gen'] == 3 and $data[$j]['Gender'] === 'M'){
		foreach($data[$j]['Moves'] as $mv){
				array_push($nar3, $mv);
		}
	}
}

$nar3 = array_unique($nar3);
sort($nar3);

foreach ($nar3 as $mv3) {
    echo $mv3 . "<br>";
}
?>
</html>