<html>
<title>Max Uni</title>
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

$myfile = fopen("pokedata.json", "r") or die("Unable to open file!");
$jin = fread($myfile,filesize("pokedata.json"));
$poke = json_decode($jin, true);
$el = count($poke);

$kanto = file("kanto.txt");
$tkan = array_map('trim',$kanto);

$sub = [];
$ga = file("gameList.txt");
$tga=array_map('trim',$ga);

for ($j = 0; $j < $el; $j++){
	if(array_key_exists('Game', $poke[$j])){
		$poke[$j]['GNum'] = array_search($poke[$j]['Game'],$tga);
		if($poke[$j]['Game'] === "Sun [Ramirez]" or $poke[$j]['Game'] === "Moon [Fina]"){
			array_push($sub,$poke[$j]);
		}
	}
}
	
$sell = count($sub);
$sps["Sun [Ramirez]"] = 0;
$sps["Moon [Fina]"] = 0;

for ($k = 0; $k < $sell; $k++){
	$poke2 = $poke;

	foreach($poke2 as $p2){
		if($p2['Name'] == $sub[$k]['Name'] and $p2['OT'] == $sub[$k]['OT'] and $p2['Species'] == $sub[$k]['Species']){
			unset($poke2[$k]);
		}
	}
	
	$sp1 = 0;
	$sp2 = 0;
	$sp3 = 0;
	
	foreach($poke2 as $p2){
		if($p2['Species'] == $sub[$k]['Species']){
			$sp1++;
			if($p2['Gen'] == $sub[$k]['Gen']){
				$sp2++;
				if($p2['Game'] == $sub[$k]['Game']){
					$sp3++;
				}
			}
		}
	}
	
	
	for ($j = 0; $j < $el; $j++){
		$nar1[$j] = $poke[$j]['Game'];
		$nar2[$j] = $poke[$j]['Gen'];
		if($poke2[$j]['Species'] == $sub[$k]['Species']){
			$narr++;
			$nara1[$j] = $poke2[$j]['Game'];
			$nara2[$j] = $poke2[$j]['Gen'];
		}
	}

	$ct1 = array_count_values($nar1);
	$ct2 = array_count_values($nar2);
	$cn1 = array_count_values($nara1);
	$cn2 = array_count_values($nara2);
	
	$sp1 = round($sp1 / $el,5);
	$sp2 = round($sp2 / $ct2[$gen],5);
	$sp3 = round($sp3 / $ct1[$game],5);
	
	$val[0] = $sp1+$sp2+$sp3;
	if($sub[$k]['Game'] === "Sun [Ramirez]"){
		$sps["Sun [Ramirez]"] += $val[0];
	} elseif($sub[$k]['Game'] === "Moon [Fina]"){
		$sps["Moon [Fina]"] += $val[0];
	}
	
	$sp1 = 0;
	$sp2 = 0;
	$sp3 = 0;
	$spt1 = 0;
	$spt2 = 0;
	$spt3 = 0;
	
	foreach($poke2 as $p2){
		if(in_array($sub[$k]['Moves'][0], $p2['Moves'])){
			$sp1++;
			if($p2['Species'] == $sub[$k]['Species']){
				$spt1++;
			}
			if($p2['Gen'] == $sub[$k]['Gen']){
				$sp2++;
				if($p2['Species'] == $sub[$k]['Species']){
					$spt2++;
				}
				if($p2['Game'] == $sub[$k]['Game']){
					$sp3++;
					if($p2['Species'] == $sub[$k]['Species']){
						$spt3++;
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
	
	$val[1] = ($sp1+$sp2+$sp3+$spt1+$spt2+$spt3)/8;
	if($sub[$k]['Game'] === "Sun [Ramirez]"){
		$sps["Sun [Ramirez]"] += $val[1];
	} elseif($sub[$k]['Game'] === "Moon [Fina]"){
		$sps["Moon [Fina]"] += $val[1];
	}
	
	$sp1 = 0;
	$sp2 = 0;
	$sp3 = 0;
	$spt1 = 0;
	$spt2 = 0;
	$spt3 = 0;
	
	foreach($poke2 as $p2){
		if(in_array($sub[$k]['Moves'][1], $p2['Moves'])){
			$sp1++;
			if($p2['Species'] == $sub[$k]['Species']){
				$spt1++;
			}
			if($p2['Gen'] == $sub[$k]['Gen']){
				$sp2++;
				if($p2['Species'] == $sub[$k]['Species']){
					$spt2++;
				}
				if($p2['Game'] == $sub[$k]['Game']){
					$sp3++;
					if($p2['Species'] == $sub[$k]['Species']){
						$spt3++;
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
	
	$val[2] = ($sp1+$sp2+$sp3+$spt1+$spt2+$spt3)/8;
	if($sub[$k]['Game'] === "Sun [Ramirez]"){
		$sps["Sun [Ramirez]"] += $val[2];
	} elseif($sub[$k]['Game'] === "Moon [Fina]"){
		$sps["Moon [Fina]"] += $val[2];
	}
	$sp1 = 0;
	$sp2 = 0;
	$sp3 = 0;
	$spt1 = 0;
	$spt2 = 0;
	$spt3 = 0;
	
	foreach($poke2 as $p2){
		if(in_array($sub[$k]['Moves'][2], $p2['Moves'])){
			$sp1++;
			if($p2['Species'] == $sub[$k]['Species']){
				$spt1++;
			}
			if($p2['Gen'] == $sub[$k]['Gen']){
				$sp2++;
				if($p2['Species'] == $sub[$k]['Species']){
					$spt2++;
				}
				if($p2['Game'] == $sub[$k]['Game']){
					$sp3++;
					if($p2['Species'] == $sub[$k]['Species']){
						$spt3++;
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
	
	$val[3] = ($sp1+$sp2+$sp3+$spt1+$spt2+$spt3)/8;
	if($sub[$k]['Game'] === "Sun [Ramirez]"){
		$sps["Sun [Ramirez]"] += $val[3];
	} elseif($sub[$k]['Game'] === "Moon [Fina]"){
		$sps["Moon [Fina]"] += $val[3];
	}
	
	$sp1 = 0;
	$sp2 = 0;
	$sp3 = 0;
	$spt1 = 0;
	$spt2 = 0;
	$spt3 = 0;
	
	foreach($poke2 as $p2){
		if(in_array($sub[$k]['Moves'][3], $p2['Moves'])){
			$sp1++;
			if($p2['Species'] == $sub[$k]['Species']){
				$spt1++;
			}
			if($p2['Gen'] == $sub[$k]['Gen']){
				$sp2++;
				if($p2['Species'] == $sub[$k]['Species']){
					$spt2++;
				}
				if($p2['Game'] == $sub[$k]['Game']){
					$sp3++;
					if($p2['Species'] == $sub[$k]['Species']){
						$spt3++;
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
	
	$val[4] = ($sp1+$sp2+$sp3+$spt1+$spt2+$spt3)/8;
	if($sub[$k]['Game'] === "Sun [Ramirez]"){
		$sps["Sun [Ramirez]"] += $val[4];
	} elseif($sub[$k]['Game'] === "Moon [Fina]"){
		$sps["Moon [Fina]"] += $val[4];
	}
	
}

echo "Sun [Ramirez]: " . $sps["Sun [Ramirez]"].'<br>';
echo "Moon [Fina]: " . $sps["Moon [Fina]"].'<br>';

echo '<br>';

for ($k = 0; $k < $sell; $k++){
	$ge2 = $sub[$k]['Gen'];
	$sub[$k]['Change'] = 0;
	foreach($val as $vl){
		$sub[$k]['Change'] += $vl;
	}
	if($sub[$k]['Game'] === "Sun [Ramirez]"){
		$gam2 = "Sun [Ramirez]";
	} elseif($sub[$k]['Game'] === "Moon [Fina]"){
		$gam2 = "Moon [Fina]";
	}
	
	$poke2 = $poke;
	foreach($poke2 as $p2){
		if($p2['Name'] == $sub[$k]['Name'] and $p2['OT'] == $sub[$k]['OT'] and $p2['Species'] == $sub[$k]['Species']){
			unset($poke2[$k]);
		}
	}
	
	foreach($poke2 as $p2){
		if($p2['Species'] == $sub[$k]['Species']){
			$spa1++;
			if($p2['Gen'] == $ge2){
				$spa2++;
				if($p2['Game'] == $gam2){
					$spa3++;
				}
			}
		}
	}
	
	
	for ($j = 0; $j < $el; $j++){
		$nar1[$j] = $poke[$j]['Game'];
		$nar2[$j] = $poke[$j]['Gen'];
		if($poke2[$j]['Species'] == $sub[$k]['Species']){
			$narr++;
			$nara1[$j] = $poke2[$j]['Game'];
			$nara2[$j] = $poke2[$j]['Gen'];
		}
	}

	$ct1 = array_count_values($nar1);
	$ct2 = array_count_values($nar2);
	$cn1 = array_count_values($nara1);
	$cn2 = array_count_values($nara2);
	
	$spa1 = round($spa1 / $el,5);
	$spa2 = round($spa2 / $ct2[$ge2],5);
	$spa3 = round($spa3 / $ct1[$gam2],5);
	
	$sub[$k]['Change'] = $sub[$k]['Change'] - ($spa1+$spa2+$spa3);
	
	$moval = 0;
	$spa1 = 0;
	$spa2 = 0;
	$spa3 = 0;
	$spat1 = 0;
	$spat2 = 0;
	$spat3 = 0;
	
	foreach($poke2 as $p2){
		if(in_array($sub[$k]['Moves'][0], $p2['Moves'])){
			$spa1++;
			if($p2['Species'] == $sub[$k]['Species']){
				$spat1++;
			}
			if($p2['Gen'] == $ge2){
				$spa2++;
				if($p2['Species'] == $sub[$k]['Species']){
					$spat2++;
				}
				if($p2['Game'] == $gam2){
					$spa3++;
					if($p2['Species'] == $sub[$k]['Species']){
						$spat3++;
					}
				}
			}
		}
	}
	
	$spa1 = round($spa1 / $el,5);
	$spa2 = round($spa2 / $ct2[$ge2],5);
	$spa3 = round($spa3 / $ct1[$gam2],5);
	$spat1 = round($spat1 / $narr,5);
	$spat2 = round($spat2 / $cn2[$ge2],5);
	$spat3 = round($spat3 / $cn1[$gam2],5);
	
	$moval += $spa1+$spa2+$spa3+$spat1+$spat2+$spat3;
	echo $moval.' ';
	
	$spa1 = 0;
	$spa2 = 0;
	$spa3 = 0;
	$spat1 = 0;
	$spat2 = 0;
	$spat3 = 0;
	
	foreach($poke2 as $p2){
		if(in_array($sub[$k]['Moves'][1], $p2['Moves'])){
			$spa1++;
			if($p2['Species'] == $sub[$k]['Species']){
				$spat1++;
			}
			if($p2['Gen'] == $ge2){
				$spa2++;
				if($p2['Species'] == $sub[$k]['Species']){
					$spat2++;
				}
				if($p2['Game'] == $gam2){
					$spa3++;
					if($p2['Species'] == $sub[$k]['Species']){
						$spat3++;
					}
				}
			}
		}
	}
	
	$spa1 = round($spa1 / $el,5);
	$spa2 = round($spa2 / $ct2[$ge2],5);
	$spa3 = round($spa3 / $ct1[$gam2],5);
	$spat1 = round($spat1 / $narr,5);
	$spat2 = round($spat2 / $cn2[$ge2],5);
	$spat3 = round($spat3 / $cn1[$gam2],5);
	
	$moval += $spa1+$spa2+$spa3+$spat1+$spat2+$spat3;
	
	$spa1 = 0;
	$spa2 = 0;
	$spa3 = 0;
	$spat1 = 0;
	$spat2 = 0;
	$spat3 = 0;
	
	foreach($poke2 as $p2){
		if(in_array($sub[$k]['Moves'][2], $p2['Moves'])){
			$spa1++;
			if($p2['Species'] == $sub[$k]['Species']){
				$spat1++;
			}
			if($p2['Gen'] == $ge2){
				$spa2++;
				if($p2['Species'] == $sub[$k]['Species']){
					$spat2++;
				}
				if($p2['Game'] == $gam2){
					$spa3++;
					if($p2['Species'] == $sub[$k]['Species']){
						$spat3++;
					}
				}
			}
		}
	}
	
	$spa1 = round($spa1 / $el,5);
	$spa2 = round($spa2 / $ct2[$ge2],5);
	$spa3 = round($spa3 / $ct1[$gam2],5);
	$spat1 = round($spat1 / $narr,5);
	$spat2 = round($spat2 / $cn2[$ge2],5);
	$spat3 = round($spat3 / $cn1[$gam2],5);
	
	$moval += $spa1+$spa2+$spa3+$spat1+$spat2+$spat3;
	
	$spa1 = 0;
	$spa2 = 0;
	$spa3 = 0;
	$spat1 = 0;
	$spat2 = 0;
	$spat3 = 0;
	
	foreach($poke2 as $p2){
		if(in_array($sub[$k]['Moves'][3], $p2['Moves'])){
			$spa1++;
			if($p2['Species'] == $sub[$k]['Species']){
				$spat1++;
			}
			if($p2['Gen'] == $ge2){
				$spa2++;
				if($p2['Species'] == $sub[$k]['Species']){
					$spat2++;
				}
				if($p2['Game'] == $gam2){
					$spa3++;
					if($p2['Species'] == $sub[$k]['Species']){
						$spat3++;
					}
				}
			}
		}
	}
	
	$spa1 = round($spa1 / $el,5);
	$spa2 = round($spa2 / $ct2[$ge2],5);
	$spa3 = round($spa3 / $ct1[$gam2],5);
	$spat1 = round($spat1 / $narr,5);
	$spat2 = round($spat2 / $cn2[$ge2],5);
	$spat3 = round($spat3 / $cn1[$gam2],5);
	
	$moval += $spa1+$spa2+$spa3+$spat1+$spat2+$spat3;
	$moval = round($moval,5);
	//$sub[$k]['Change'] = $sub[$k]['Change'] + ($moval/8);
	
	echo $sub[$k]['Name'] . ': ' . $moval.'<br>';
	
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