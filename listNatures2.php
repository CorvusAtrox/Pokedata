<html>
<title>Species' Natures List</title>
<style>
body {
    background-color: #9EDA71;
}

.shug { display:block;text-align:center;width:50%;margin-right:200px;}
.split-para      { display:block;margin:10px;}
.split-para span { display:block;float:right;width:50%;margin-left:10px;}
</style>
<?php

$kanto = file("kanto.txt");
$tkan = array_map('trim',$kanto);

$snum = 0;

$off = $_COOKIE['off'];
$jin = file_get_contents("pokedata.json") or die("Unable to open file!");
$data = json_decode($jin, true);

$dex = file("NatLine Dex.txt");
$tdex = array_map('trim',$dex);

//var_dump($tdex);

$el = count($data);

for ($j = 0; $j < $el; $j++){
	$data[$j]['LNum'] = array_search($data[$j]['Species'],$tdex);
}

usort($data, 'mySort');

$nam = $data[0]['Species'];
$snum = array_search($nam,$tkan) + 1;
$snum = str_pad($snum, 3, '0', STR_PAD_LEFT);
$count = 0;
$moves = [];

for ($j = 0; $j < $el; $j++){
	if(strcmp($nam, $data[$j]['Species']) != 0){
		if($snum != 0){
			echo "<br><img src='icons/". $snum .".png' border=0> " . $nam;
		}
		sort($nar);
		$ct = array_count_values($nar);

		foreach ($ct as $key => $value) {
			if($value == 1){
				echo "<p style='color:blue'>$key: $value</p>";
			} else {
				echo "<p style='color:black'>$key: $value</p>";
			}
		}
		echo "<br>";
		$nar = [];
		if(array_key_exists('Nature', $data[$j])){
			$nar[] = $data[$j]['Nature'];
		} else {
			$nar[] = "N/A";
		}
		$nam = $data[$j]['Species'];
		$snum = array_search($nam,$tkan) + 1;
		$snum = str_pad($snum, 3, '0', STR_PAD_LEFT);
	} else {
		if(array_key_exists('Nature', $data[$j])){
			$nar[] = $data[$j]['Nature'];
		} else {
			$nar[] = "N/A";
		}
		$ct = array_count_values($nar);
	}
}

if($snum != 0){
	echo "<br><img src='icons/". $snum .".png' border=0> " . $nam;
}
foreach ($ct as $key => $value) {
	if($value == 1){
		echo "<p style='color:blue'>$key: $value</p>";
	} else {
		echo "<p style='color:black'>$key: $value</p>";
	}
}
echo "<br>";
echo "<br>";
//echo print_r($moves) ."</br>";


function mySort($a, $b)
{
    $diff = (int)$a['LNum'] - (int)$b['LNum'];
	if($diff == 0){
		return strcmp($a['Name'],$b['Name']); 
	} else {
		return $diff;
	}   
}

?>
</html>