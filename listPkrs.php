<html>
<title>Pokérus List</title>
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

$off = $_COOKIE['off'];
$jin = file_get_contents("pokedata.json") or die("Unable to open file!");
$data = json_decode($jin, true);

usort($data, 'mySort');

$el = count($data);

$nar = [];

$game = $data[0]["Game"];

for ($j = 0; $j < $el; $j++){
	if($game === $data[$j]['Game']){
		if(array_key_exists('Pkrs', $data[$j])){
			$nar[$j] = $data[$j]['Pkrs'];
		} else {
			$nar[$j] = " ";
		}
	} else {
		sort($nar);
		$ct = array_count_values($nar);
		$num = count($nar);
		
		if(array_key_exists('Have',$ct) or array_key_exists('Cured',$ct)){
			echo "<b>" . $game . "</b><br>";

			foreach ($ct as $key => $value) {
				echo "<p style='color:black'>$key: $value" . " (" . number_format($value/$num*100,2) . "%)" . "</p>";
			}
			echo "<p style='color:black'>[Infected: " . ($ct['Cured']+$ct['Have']) . " (" . number_format(($ct['Cured']+$ct['Have'])/$num*100,2) . "%)" . "]</p>";

		}
		$nar = [];
		$game = $data[$j]['Game'];
		
		if(array_key_exists('Pkrs', $data[$j])){
			$nar[$j] = $data[$j]['Pkrs'];
		} else {
			$nar[$j] = " ";
		}
	}
	
}

sort($nar);
$ct = array_count_values($nar);
$num = count($nar);

if(array_key_exists('Have',$ct) or array_key_exists('Cured',$ct)){
	echo "<b>" . $game . "</b><br>";

	foreach ($ct as $key => $value) {
		echo "<p style='color:black'>$key: $value" . " (" . number_format($value/$num*100,2) . "%)" . "</p>";
	}
	echo "<p style='color:black'>[Infected: " . ($ct['Cured']+$ct['Have']) . " (" . number_format(($ct['Cured']+$ct['Have'])/$num*100,2) . "%)" . "]</p>";

}
function mySort($a, $b)
{
    $diff = (int)$a['GNum'] - (int)$b['GNum'];
	if($diff == 0){
		$diff = (int)$a['LNum'] - (int)$b['LNum'];
		if($diff == 0){
			$diff = (int)$a['Lv'] - (int)$b['Lv'];
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