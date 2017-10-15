<html>
<title>Game List</title>
<style>
body {
    background-color: #9EDA71;
}

.shug { display:block;text-align:center;width:50%;margin-right:200px;}
.split-para      { display:block;margin:10px;}
.split-para span { display:block;float:right;width:50%;margin-left:10px;}
</style>
<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

$narum = [""];

$off = $_COOKIE['off'];
$jin = file_get_contents("pokedata.json") or die("Unable to open file!");
$data = json_decode($jin, true);

$dex = file("NatLine Dex.txt");
$tdex=array_map('trim',$dex);

$ga = file("gameList.txt");
$tga=array_map('trim',$ga);

$el = count($data);

for ($j = 0; $j < $el; $j++){
	$data[$j]['LNum'] = array_search($data[$j]['Species'],$tdex);
}
for ($j = 0; $j < $el; $j++){
	$data[$j]['GNum'] = array_search($data[$j]['Game'],$tga);
}

usort($data, 'mySort');

for ($j = 0; $j < $el; $j++){
	$nar[$j] = $data[$j]['Game'];
}

$ct = array_count_values($nar);

foreach ($ct as $key => $value) {
    echo "$key: $value<br>";
	//echo "$key<br>";
}

function mySort($a, $b)
{
    $diff = (int)$a['GNum'] - (int)$b['GNum'];
	if($diff == 0){
		$diff = (int)$a['Lv'] - (int)$b['Lv'];
		if($diff == 0){
			$diff = (int)$a['LNum'] - (int)$b['LNum'];
			if($diff == 0){
				return strcmp($a['Name'],$b['Name']); 
			} else {
				return $diff;
			}  
		} else {
			return $diff;
		}  
	} else {
		return $diff;
	}   
}

?>
</html>