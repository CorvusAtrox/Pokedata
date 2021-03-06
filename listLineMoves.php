<html>
<title>Lines' Moves List</title>
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

$lin = fopen("monLines.txt", "r");
$lines = [];
while(! feof($lin)){
	$l = fgets($lin);
	$g = explode(',',$l);
	if(count($g) > 1){
		$lines[$g[0]] = $g[1];
	} else {
		$lines[$g] = $g;
	}
}
$lines["Bulbasaur"] = $lines["Ivysaur"];
fclose($lin);

for ($j = 0; $j < $el; $j++){
	$data[$j]['LNum'] = array_search($data[$j]['Species'],$tdex);
	$data[$j]['Line'] = $lines[$data[$j]['Species']];
}

usort($data, 'mySort');

$nam = $data[0]['Species'];
$li = $data[0]['Line'];
$snum = array_search($nam,$tkan) + 1;
$snum = str_pad($snum, 3, '0', STR_PAD_LEFT);
$count = 0;
$moves = [];

for ($j = 0; $j < $el; $j++){
	if(strcmp($nam, $data[$j]['Species']) != 0){
		if($snum != 0){
			echo "<img src='icons/". $snum .".png' border=0>";
		}
		if(strcmp($li, $data[$j]['Line']) != 0){
			$moves = array_count_values($moves);
			echo $li.": (". count($moves) . ")";
			foreach ($moves as $key => $value){
				echo ' '.$key.': '.$value;
			}
			echo "<br>";
			//echo print_r($moves) ."</br>";
			$moves = $data[$j]['Moves'];
			sort($moves);
			$li = $data[$j]['Line'];
		} else {
			$moves = array_merge($moves,$data[$j]['Moves']);
			sort($moves);
		}
		$nam = $data[$j]['Species'];
		$snum = array_search($nam,$tkan) + 1;
		$snum = str_pad($snum, 3, '0', STR_PAD_LEFT);
	} else {
		//$moves = array_unique(array_merge($moves,$data[$j]['Moves']), SORT_REGULAR);
		$moves = array_merge($moves,$data[$j]['Moves']);
		sort($moves);
	}
}

if($snum != 0){
	echo "<br><img src='icons/". $snum .".png' border=0>";
}
$moves = array_count_values($moves);
echo $li.": (". count($moves) . ")";
foreach ($moves as $key => $value){
	echo ' '.$key.': '.$value;
}
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