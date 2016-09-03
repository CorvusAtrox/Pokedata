<html>
<title>Unique Mons</title>
<style>
body {
    background-color: #00FF00;
}

.shug { display:block;text-align:center;width:50%;margin-right:200px;}
.split-para      { display:block;margin:10px;}
.split-para span { display:block;float:right;width:50%;margin-left:10px;}
</style>
<body>
<?php 

	error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
	
	$off = $_COOKIE['off'];
	$jin = file_get_contents("pokedata.json") or die("Unable to open file!");
	$data = json_decode($jin, true);
	
	$el = count($data);
	
	usort($data, 'invSort');
	
	$uab = [];
	$ulv = [];
	$umo = [];
	$usp = [];
	$usf = [];
	
	$nab = [""];
	$nlv = [""];
	$nsp = [""];
	$nsf = [""];
	$nmo = [""];

	for ($j = 0; $j < $el; $j++){
		if(array_key_exists('Ability', $data[$j])){
			$nab[$j] = $data[$j]['Ability'];
		}
		if(array_key_exists('Lv', $data[$j])){
			$nlv[$j] = $data[$j]['Lv'];
		}
		if(array_key_exists('Species', $data[$j])){
			$data[$j]['SpeForm'] = $data[$j]['Species'];
			if(array_key_exists('Forme', $data[$j]) && $data[$j]['Forme'] !== "F" && $data[$j]['Forme'] !== "M"){
				$data[$j]['SpeForm'] = $data[$j]['SpeForm'] . ' ' . $data[$j]['Forme'];
			} 
			if(array_key_exists('Shiny', $data[$j])){
				$data[$j]['SpeForm'] = $data[$j]['SpeForm'] . ' (Shiny)';
			}
			$nsp[$j] = $data[$j]['Species'];
			$nsf[$j] = $data[$j]['SpeForm'];
		}
		
		if(array_key_exists('Moves', $data[$j])){
			$mnum = sizeof($data[$j]['Moves']);
			for($m = 0; $m < $mnum; $m++){
				array_push($nmo,$data[$j]['Moves'][$m]);
			}
		}
	}

	sort($nab);
	sort($nlv);
	sort($nsp);
	sort($nsf);
	sort($nmo);

	$abct = array_count_values($nab);
	$ablv = array_count_values($nlv);
	$absp = array_count_values($nsp);
	$absf = array_count_values($nsf);
	$abmo = array_count_values($nmo);

	foreach ($abct as $key => $value) {
		if($value == 1){
			array_push($uab, $key);
		}
	}
	foreach ($ablv as $key => $value) {
		if($value == 1){
			array_push($ulv, $key);
		}
	}
	foreach ($absp as $key => $value) {
		if($value == 1){
			array_push($usp, $key);
		}
	}
	foreach ($absf as $key => $value) {
		if($value == 1){
			array_push($usf, $key);
		}
	}
	
	foreach ($abmo as $key => $value) {
		if($value == 1){
			array_push($umo, $key);
		}
	}
	
	$spec = [];
	$spef = [];
	$mv = array();
	$mset = [];
	$ab = [[]];
	$niq = [];
	for($j=0;$j<=(7+23);$j++){
		$spec[$j] = array();
		$spef[$j] = array();
		$mv[$j] = array();
		$mset[$j] = array();
		$ab[$j] = array();
	}
	
	for($j = 0; $j < $el; $j++){
		$data[$j]['Priority'] = 0;
		$g = $data[$j]['Gen'];
		$gg = $data[$j]['GNum'] + 7;
		sort($data[$j]['Moves']);
		if(!in_array($data[$j]['SpeForm'],$spef[$gg])){
			$data[$j]['Priority'] = 1;
		}
		if(!in_array($data[$j]['Moves'],$mset[$g])){
			$data[$j]['Priority'] = 2;
		}
		/*if(!in_array($data[$j]['Ability'],$ab[$gg])){
			$data[$j]['Priority'] = 2;
		}
		$mnum = sizeof($data[$j]['Moves']);
		for($m = 0; $m < $mnum; $m++){
			$moves[$m] = $data[$j]['Moves'][$m];
		}
		for($m = 0; $m < $mnum; $m++){
			if(!in_array($moves[$m],$mv[$gg])){
				$data[$j]['Priority'] = 2;
			}
		}*/
		if(!in_array($data[$j]['Species'],$spec[$g])){
			$data[$j]['Priority'] = 3;
		}
		if(!in_array($data[$j]['Ability'],$ab[$g])){
			$data[$j]['Priority'] = 3;
		}
		$mnum = sizeof($data[$j]['Moves']);
		for($m = 0; $m < $mnum; $m++){
			$moves[$m] = $data[$j]['Moves'][$m];
		}
		for($m = 0; $m < $mnum; $m++){
			if(!in_array($moves[$m],$mv[$g])){
				$data[$j]['Priority'] = 3;
			}
			if(!in_array($moves[$m],$mv[0])){
				$data[$j]['Priority'] = 4;
			}
		}
		if(!in_array($data[$j]['Ability'],$ab[0])){
			$data[$j]['Priority'] = 4;
		}
		if(!in_array($data[$j]['Species'],$spec[0])){
			$data[$j]['Priority'] = 4;
		}
		if(!in_array($data[$j]['Species'],$spec[0])){
			$data[$j]['Priority'] = 4;
		}
		if(in_array($data[$j]['SpeForm'],$usf)){
			$data[$j]['Priority'] = 5;
			$data[$j]['WhyPri'] = $data[$j]['SpeForm'];
		}
		if(in_array($data[$j]['Species'],$usp)){
			$data[$j]['Priority'] = 6;
			$data[$j]['WhyPri'] = $data[$j]['Species'];
		}
		if(in_array($data[$j]['Ability'],$uab)){
			$data[$j]['Priority'] = 6;
			$data[$j]['WhyPri'] = $data[$j]['Ability'] . ' ' . $data[$j]['WhyPri'];
		}
		if(in_array($data[$j]['Lv'],$ulv)){
			$data[$j]['Priority'] = 6;
			$data[$j]['WhyPri'] = 'Lv ' . $data[$j]['Lv'] . ' ' . $data[$j]['WhyPri'];
		}
		if(array_key_exists('Moves', $data[$j])){
			$mnum = sizeof($data[$j]['Moves']);
			for($m = 0; $m < $mnum; $m++){
				if(in_array($data[$j]['Moves'][$m],$umo)){
					$data[$j]['Priority'] = 6;
					$data[$j]['WhyPri'] = $data[$j]['Moves'][$m] . ' ' . $data[$j]['WhyPri'];
				}
			}
		}
		if($data[$j]['Priority'] > 0){
			array_push($spec[0], $data[$j]['Species']);
			array_push($spef[0], $data[$j]['SpeForm']);
			array_push($ab[0], $data[$j]['Ability']);
			array_push($mset[0],$data[$j]['Moves']);
			for($m = 0; $m < $mnum; $m++){
				array_push($mv[0], $moves[$m]);
			}
			array_push($spec[$g], $data[$j]['Species']);
			array_push($spef[$g], $data[$j]['SpeForm']);
			array_push($ab[$g], $data[$j]['Ability']);
			array_push($mset[$g],$data[$j]['Moves']);
			for($m = 0; $m < $mnum; $m++){
				array_push($mv[$g], $moves[$m]);
			}
			array_push($spec[$gg], $data[$j]['Species']);
			array_push($spef[$gg], $data[$j]['SpeForm']);
			array_push($ab[$gg], $data[$j]['Ability']);
			array_push($mset[$gg],$data[$j]['Moves']);
			for($m = 0; $m < $mnum; $m++){
				array_push($mv[$gg], $moves[$m]);
			}
		}
	}
	
	usort($data, 'gameSort');
	
	for ($j = 0; $j < $el; $j++){
		if($data[$j]['Priority'] == 6){
			echo '<p style="color:yellow">'.$data[$j]['Name'] . ', Lv ' . $data[$j]['Lv'] . ' ' . $data[$j]['Species'] .' ('.$data[$j]['Game'].') ['.$data[$j]['WhyPri'].']</p>';
		} else if($data[$j]['Priority'] == 5){
			echo '<p style="color:gold">'.$data[$j]['Name'] . ', Lv ' . $data[$j]['Lv'] . ' ' . $data[$j]['Species'] .' ('.$data[$j]['Game'].') ['.$data[$j]['WhyPri'].']</p>';
		} else if($data[$j]['Priority'] == 4){
			echo '<p style="color:purple">'.$data[$j]['Name'] . ', Lv ' . $data[$j]['Lv'] . ' ' . $data[$j]['Species'] .' ('.$data[$j]['Game'].')</p>';
		} else if($data[$j]['Priority'] == 3){
			echo '<p style="color:blue">'.$data[$j]['Name'] . ', Lv ' . $data[$j]['Lv'] . ' ' . $data[$j]['Species'] .' ('.$data[$j]['Game'].')</p>';
		} else if($data[$j]['Priority'] == 2){
			echo '<p style="color:red">'.$data[$j]['Name'] . ', Lv ' . $data[$j]['Lv'] . ' ' . $data[$j]['Species'] .' ('.$data[$j]['Game'].')</p>';
		} else if($data[$j]['Priority'] == 1){
			echo '<p style="color:brown">'.$data[$j]['Name'] . ', Lv ' . $data[$j]['Lv'] . ' ' . $data[$j]['Species'] .' ('.$data[$j]['Game'].')</p>';
		} else if($data[$j]['Priority'] == 0){
			echo '<p style="color:black">'.$data[$j]['Name'] . ', Lv ' . $data[$j]['Lv'] . ' ' . $data[$j]['Species'] .' ('.$data[$j]['Game'].')</p>';
		}
	}
	
	
	
function mySort($a, $b)
{
    $diff = (int)$a['Lv'] - (int)$b['Lv'];
	if($diff == 0){
		$diff = (int)$a['GNum'] - (int)$b['GNum'];
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

function gameSort($a, $b)
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

function priSort($a, $b)
{
	$diff = (int)$b['Priority'] - (int)$a['Priority'];
	if($diff == 0){
		$diff = (int)$a['Gen'] - (int)$b['Gen'];
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
	} else {
		return $diff;
	}
}

function invSort($a, $b)
{
    $diff = (int)$b['Lv'] - (int)$a['Lv'];
	if($diff == 0){
		$diff = (int)$a['GNum'] - (int)$b['GNum'];
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

function specSort($a, $b)
{
    $diff = (int)$a['LNum'] - (int)$b['LNum'];
	if($diff == 0){
		$diff = (int)$a['Lv'] - (int)$b['Lv'];
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
}
	
?>

</body>
</html>