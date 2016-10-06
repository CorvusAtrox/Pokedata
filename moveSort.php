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
	$data[$j]['GNum'] = array_search($data[$j]['Game'],$tga);
}

usort($data, 'moveSort');

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

	
function moveSort($a, $b)
{
	sort($a['Moves']);
	sort($b['Moves']);
	$diff = strcmp($a['Moves'][0],$b['Moves'][0]);
	if($diff == 0 && array_key_exists(1,$a)  && array_key_exists(1,$b)){
		$diff = strcmp($a['Moves'][1],$b['Moves'][1]);
		if($diff == 0 && array_key_exists(2,$a)  && array_key_exists(2,$b)){
			$diff = strcmp($a['Moves'][2],$b['Moves'][2]);
			if($diff == 0 && array_key_exists(3,$a)  && array_key_exists(3,$b)){
				return strcmp($a['Moves'][3],$b['Moves'][3]);
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