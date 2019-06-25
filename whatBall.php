<html>
<title>Ball Species</title>
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

$kanto = file("kanto.txt");
$tkan = array_map('trim',$kanto);

$snum = 0;

$off = $_COOKIE['off'];
$jin = file_get_contents("pokedata.json") or die("Unable to open file!");
$poke = json_decode($jin, true);

$dex = file("NatLine Dex.txt");
$tdex = array_map('trim',$dex);

$el = count($poke);

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
	$poke[$j]['LNum'] = array_search($poke[$j]['Species'],$tdex);
}

usort($poke, 'mySort');

$nam = $poke[0]['Species'];
$snum = array_search($nam,$tkan) + 1;
$snum = str_pad($snum, 3, '0', STR_PAD_LEFT);
$count = 0;
$moves = [];

$nar1 = [""];
$nar2 = [""];
$nara1 = [""];
$nara2 = [""];
$narr = 0;

$nal1 = [""];
$nal2 = [""];
$nala1 = [""];
$nala2 = [""];
$nall = 0;

$gen = "Gen VII";
//$game = "Ultra Sun [Hibiki]";
//$balls = ["Poké","Great","Ultra","Heal","Net","Nest","Quick","Dusk","Timer","Repeat","Dive","Luxury","Love","Friend"];
$game = "Ultra Moon [かなで]";
$balls = ["Poké","Great","Ultra","Premier","Heal","Net","Nest","Quick","Dusk","Timer","Repeat","Dive","Luxury","Fast","Lure","Heavy","Friend"];
$species = "Clawitzer";
$line = $lines[$species];

echo $species . " " . $game . "<br><br>";

	$sp1 = 0;
	$sp2 = 0;
	$sp3 = 0;
	$spt1 = 0;
	$spt2 = 0;
	$spt3 = 0;
	$sl1 = 0;
	$sl2 = 0;
	$sl3 = 0;

	foreach($poke as $p2){
		if($p2['Species'] == $species){
			$sp1++;
			if($p2['Gen'] == $gen){
				$sp2++;
				if($p2['Game'] == $game){
					$sp3++;
				}
			}
		}
		if($lines[$p2['Species']] == $line){
			$sl1++;
			if($p2['Gen'] == $gen){
				$sl2++;
				if($p2['Game'] == $game){
					$sl3++;
				}
			}
		}		
	}
	
	
	for ($j = 0; $j < $el; $j++){
		$nar1[$j] = $poke[$j]['Game'];
		$nar2[$j] = $poke[$j]['Gen'];
		if($poke[$j]['Species'] == $species){
			$narr++;
			$nara1[$j] = $poke[$j]['Game'];
			$nara2[$j] = $poke[$j]['Gen'];
		}
		if($lines[$poke[$j]['Species']] == $line){
			$nall++;
			$nala1[$j] = $poke[$j]['Game'];
			$nala2[$j] = $poke[$j]['Gen'];
		}
	}

	$ct1 = array_count_values($nar1);
	$ct2 = array_count_values($nar2);
	$cn1 = array_count_values($nara1);
	$cn2 = array_count_values($nara2);
	$cl1 = array_count_values($nala1);
	$cl2 = array_count_values($nala2);
	
	$sp1 = round($sp1 / $el,5);
	$sp2 = round($sp2 / $ct2[$gen],5);
	$sp3 = round($sp3 / $ct1[$game],5);
	$sl1 = round($sl1 / $el,5);
	$sl2 = round($sl2 / $ct2[$gen],5);
	$sl3 = round($sl3 / $ct1[$game],5);
	
	$ballSet = array();
	
	foreach($balls as $ball){
	
	$sp1 = 0;
	$sp2 = 0;
	$sp3 = 0;
	$spt1 = 0;
	$spt2 = 0;
	$spt3 = 0;
	$sl1 = 0;
	$sl2 = 0;
	$sl3 = 0;
	
		foreach($poke as $p2){
			if($p2['Ball'] == $ball){
				$sp1++;
				if($p2['Species'] == $species){
					$spt1++;
				}
				if($lines[$p2['Species']] == $line){
					$sl1++;
				}
				if($p2['Gen'] == $gen){
					$sp2++;
					if($p2['Species'] == $species){
						$spt2++;
					}
					if($lines[$p2['Species']] == $line){
						$sl2++;
					}
					if($p2['Game'] == $game){
						$sp3++;
						if($p2['Species'] == $species){
							$spt3++;
						}
						if($lines[$p2['Species']] == $line){
							$sl3++;
						}
					}
				}
			}
		}
	
		$sp1 = round($sp1 / $el,5);
		$sp2 = round($sp2 / $ct2[$gen],5);
		$sp3 = round($sp3 / $ct1[$game],5);
		$spt1 = round($spt1 / $narr,5);
		$spt2 = round($spt2 / $cn2[$gen],5);
		$spt3 = round($spt3 / $cn1[$game],5);
		$sl1 = round($sl1 / $nall,5);
		$sl2 = round($sl2 / $cl2[$gen],5);
		$sl3 = round($sl3 / $cl1[$game],5);
		
		if(is_nan($sp1)){
			$sp1 = 0;
		}
		if(is_nan($sp2)){
			$sp2 = 0;
		}
		if(is_nan($sp3)){
			$sp3 = 0;
		}
		
		if(is_nan($spt1)){
			$spt1 = 0;
		}
		if(is_nan($spt2)){
			$spt2 = 0;
		}
		if(is_nan($spt3)){
			$spt3 = 0;
		}
		
		if(is_nan($sl1)){
			$sl1 = 0;
		}
		if(is_nan($sl2)){
			$sl2 = 0;
		}
		if(is_nan($sl3)){
			$sl3 = 0;
		}
		
		$val = array();
		
		$val['Val'] = $sp1+$sp2+$sp3+round((($spt1+$spt2+$spt3)*2+$sl1+$sl2+$sl3)/3,5);
		$val['Text'] = '<b>'.$ball . '</b> ' . $val['Val'] . ' ('.$sp1.'+'.$spt1.'+'.$sl1.')+('.$sp2.'+'.$spt2.'+'.$sl2.')+('.$sp3.'+'.$spt3.'+'.$sl3.')';
		array_push($ballSet,$val);
	}	

$ballVals = array_column($ballSet, 'Val');

array_multisort($ballVals, SORT_DESC, $ballSet);

foreach($ballSet as $b){
	echo $b['Text'] . "<br>";
}

echo "<br>";


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