<?php

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
	$data[$j]['GNum'] = array_search($data[$j]['Game'],$games);
	$data[$j]['Gen'] = $gens[$data[$j]['GNum']];
	$data[$j]['System'] = $systems[$data[$j]['GNum']];
	$data[$j]['SNum'] = array_search($data[$j]['Gen'],$genset);
	$data[$j]['VC'] = array_search($data[$j]['System'],$systemset);
}

for ($j = 0; $j < $el; $j++){
	$data[$j]['LNum'] = array_search($data[$j]['Species'],$tdex);
	/*$data[$j]['HP'] = (int) $data[$j]['HP'];
	$data[$j]['Atk'] = (int) $data[$j]['Atk'];
	$data[$j]['Def'] = (int) $data[$j]['Def'];
	$data[$j]['Spd'] = (int) $data[$j]['Spd'];
	$data[$j]['SAt'] = (int) $data[$j]['SAt'];
	$data[$j]['SDe'] = (int) $data[$j]['SDe'];*/
}
for ($j = 0; $j < $el; $j++){
	$data[$j]['GNum'] = array_search($data[$j]['Game'],$tga);
}

usort($data, 'levSort');

$jen = json_encode($data);
		//echo $jen;
		
		$len = strlen($jen); 
		$new_json = "";
		for($c = 0; $c < $len; $c++) 
		{ 
			$char = $jen[$c];
			if($c+1 < $len){
				$nchar = $jen[$c+1];
			}
			switch($nchar) 
			{ 
				case '{': 
					$new_json .= $char . "\n";
					break; 
				default: 
					$new_json .= $char; 
					break;                    
			} 
		} 
		
		$myfile = fopen("pokedata.json.new", "w") or die("Unable to open file!");
		fwrite($myfile, $new_json);
		fclose($myfile);
		rename("pokedata.json.new","pokedata.json");
	
	header('Location: index.php');
	die();

	
function levSort($a, $b)
{
    $diff = $a['SNum'] - $b['SNum'];
	if($diff == 0){
		$diff = $a['VC'] - $b['VC'];
		if($diff == 0){
			$diff = (int)$a['Lv'] - (int)$b['Lv'];
			if($diff == 0){
				$diff = (int)$a['LNum'] - (int)$b['LNum'];
				if($diff == 0){
					$diff = (int)$a['GNum'] - (int)$b['GNum'];
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
		} else {
			return $diff;
		}
	} else {
		return $diff;
	}
}

function atkSort($a, $b)
{
    $diff = (int)$a['Atk'] - (int)$b['Atk'];
	if($diff == 0){
		return strcmp($a['Name'],$b['Name']); 
	} else {
		return $diff;
	}   
}

function nameSort($a, $b)
{
    return strcmp($a['Name'],$b['Name']);   
}
?>