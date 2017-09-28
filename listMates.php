<html>
<title>Mate List</title>
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

$off = $_COOKIE['off'];

$jin = file_get_contents("pokedata.json") or die("Unable to open file!");
$data = json_decode($jin, true);

$el = count($data);

$egg = file("eggGroup.txt");

$e = 0;
foreach($egg as $eline){
	$egro[$e] = explode("	",$eline);
	$egro[$e] = array_filter(array_map('trim',$egro[$e]));
	for ($j = 0; $j < $el; $j++){
		if($egro[$e][0] === trim($data[$j]['Species'])){
			$data[$j]['Egg'] = $egro[$e];
		}
	}
	$e++;
}

//var_dump($egro);
	echo $data[$off]['Name'] . ":<br>";

	$al = '';
	$gen = $data[$off]['Gen'];
	$vc = $data[$off]['VC'];
	$gnd = $data[$off]['Gender'];
	if ($data[$off]['Forme'] == 'Alola'){
		$al = 'Al';
	}

	for ($j = 0; $j < $el; $j++){
		$emo = array();
		if($data[$j]['Gen'] == $gen & $data[$j]['VC'] == $vc & $data[$off]['Egg'][1] != "Undiscovered"){
			if($data[$j]['Species'] === "Ditto"){
				$emo = array_intersect($data[$j]['Moves'],$data[$off]['Moves']);
				if(file_exists("egg/" . $data[$off]['Gen'] . "/". $data[$off]['Species'] . $al . ".txt")){
					$mli = file("egg/".$data[$off]['Gen']."/". $data[$off]['Species'] . $al . ".txt");
					$mli = array_filter(array_map('trim',$mli));
					if($gnd === "M" or $gen > 5){
						$emo = array_merge($emo,array_intersect($mli,$data[$off]['Moves']));
					}
				}
				echo $data[$j]['Name'] . " (".$data[$j]['Game']."): " . $data[$off]['Species'];
				foreach($emo as $mv){echo ", ".$mv;}
				echo "<br>";
			} else if($gnd === "M" and $data[$j]['Gender'] === "F" & count(array_intersect($data[$j]['Egg'],$data[$off]['Egg'])) > 0){
				$emo = array_intersect($data[$j]['Moves'],$data[$off]['Moves']);
				if(file_exists("egg/".$data[$j]['Gen']."/". $data[$j]['Species'].".txt")){
					$mli = file("egg/".$data[$j]['Gen']."/". $data[$j]['Species'].".txt");
					$mli = array_filter(array_map('trim',$mli));
					$emo = array_merge($emo,array_intersect($mli,$data[$off]['Moves']));
					if($gen > 5){
						$emo = array_merge($emo,array_intersect($mli,$data[$j]['Moves']));
					}
				}
				echo $data[$j]['Name'] . " (".$data[$j]['Game']."): " . $data[$j]['Species'];
				foreach($emo as $mv){echo ", ".$mv;}
				echo "<br>";
			} else if($gnd === "F" and $data[$j]['Gender'] === "M" & count(array_intersect($data[$j]['Egg'],$data[$off]['Egg'])) > 0){
				$emo = array_intersect($data[$j]['Moves'],$data[$off]['Moves']);
				if(file_exists("egg/".$data[$off]['Gen']."/". $data[$off]['Species'].".txt")){
					$mli = file("egg/".$data[$off]['Gen']."/". $data[$off]['Species'].".txt");
					$mli = array_filter(array_map('trim',$mli));
					$emo = array_merge($emo,array_intersect($mli,$data[$j]['Moves']));
					if($gen > 5){
						$emo = array_merge($emo,array_intersect($mli,$data[$off]['Moves']));
					}
				}
				echo $data[$j]['Name'] . " (".$data[$j]['Game']."): " . $data[$off]['Species'];
				foreach($emo as $mv){echo ", ".$mv;}
				echo "<br>";
			}
		}
	}
?>
</html>