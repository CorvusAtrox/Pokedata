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
	$data[$j]['VC'] = 0;
}
for ($j = 0; $j < $el; $j++){
	$data[$j]['GNum'] = array_search($data[$j]['Game'],$tga);
	$gname = substr($data[$j]['Game'], 0, strrpos($data[$j]['Game'], '[')-1);
	if($gname === "Red" or $gname === "Blue" or $gname === "Yellow"){
		$data[$j]['Gen'] = 1;
	}
	if($gname === "Gold" or $gname === "Silver" or $gname === "Crystal"){
		$data[$j]['Gen'] = 2;
	}
	if($gname === "Ruby" or $gname === "Sapphire" or $gname === "Emerald" or $gname === "FireRed" or $gname === "LeafGreen" or $gname === "Colosseum" or $gname === "XD"){
		$data[$j]['Gen'] = 3;
	}
	if($gname === "Diamond" or $gname === "Pearl" or $gname === "Platinum" or $gname === "HeartGold" or $gname === "SoulSilver" or $data[$j]['Game'] === "Ranch"){
		$data[$j]['Gen'] = 4;
	}
	if($gname === "Black" or $gname === "White" or $gname === "Black 2" or $gname === "White 2"){
		$data[$j]['Gen'] = 5;
	}
	if($gname === "X" or $gname === "Y" or $gname === "Omega Ruby" or $gname === "Alpha Sapphire" or $gname === "Bank VI"){
		$data[$j]['Gen'] = 6;
	}
	if($gname === "Sun" or $gname === "Moon" or $gname === "Ultra Sun" or $gname === "Ultra Moon" or $gname === "Bank VII"){
		$data[$j]['Gen'] = 7;
	}
	
	if(array_key_exists('System', $data[$j])){
		if($data[$j]['System'] == "GBA"){
			$data[$j]['VC'] = 1;
		}
		if($data[$j]['System'] == "NDS"){
			$data[$j]['VC'] = 2;
		}
		if($data[$j]['System'] == "3DS"){
			$data[$j]['VC'] = 3;
		}
	}
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
    $diff = $a['Gen'] - $b['Gen'];
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