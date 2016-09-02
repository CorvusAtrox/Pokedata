<html>
<title>Nature List</title>
<style>
body {
    background-color: #00FF00;
}

.shug { display:block;text-align:center;width:50%;margin-right:200px;}
.split-para      { display:block;margin:10px;}
.split-para span { display:block;float:right;width:50%;margin-left:10px;}
</style>
<?php

$off = $_COOKIE['off'];
$jin = file_get_contents("pokedata.json") or die("Unable to open file!");
$data = json_decode($jin, true);

$el = count($data);

$nar = [""];

for ($j = 0; $j < $el; $j++){
	if(array_key_exists('Nature', $data[$j])){
		$nar[$j] = $data[$j]['Nature'];
	}
}

sort($nar);

$ct = array_count_values($nar);

foreach ($ct as $key => $value) {
    echo "$key: $value<br>";
}

?>
</html>