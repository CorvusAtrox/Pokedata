<html>
<title>Uniqalq</title>
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

setCookie("chan",$_POST['mt']);
setCookie("evo",$_POST['evo']);
setCookie("newm",$_POST['newm']);

$myfile = fopen("pokedata.json", "r") or die("Unable to open file!");
$jin = fread($myfile,filesize("pokedata.json"));
$poke = json_decode($jin, true);

$kanto = file("kanto.txt");
$tkan = array_map('trim',$kanto);

$newm = $_COOKIE["newm"];

$nar1 = [""];
$nar2 = [""];
$nara1 = [""];
$nara2 = [""];
$narr = 0;

$na21 = [""];
$na22 = [""];
$na2a1 = [""];
$na2a2 = [""];
$na2r = 0;

$ball = "";
$name = "";
$lang = "";
$lv = "";
$shine = "";
$gender = "";
$species = "";
$forme = "";
$snum = 0;
$ability = "";
$nature = "";
$idn = "";
$ot = "";
$game = "";
$trainer = "";
$pkrs = "";
$moves = ["","","",""];

$off = 0;

if(isset($_COOKIE["off"])){
	$off = $_COOKIE["off"];
} else {
	setCookie("off",$off);
}

if($_COOKIE["evo"] !== ''){
	$spe2 = $_COOKIE["evo"];
}

echo $off;

$poke2 = $poke;
unset($poke2[$off]);
	
if(array_key_exists('Name', $poke[$off])){
	$name = $poke[$off]['Name'];
}
if(array_key_exists('Lang', $poke[$off])){
	$lang = $poke[$off]['Lang'];
}
if(array_key_exists('Ball', $poke[$off])){
	$ball = $poke[$off]['Ball'];
}
if(array_key_exists('Lv', $poke[$off])){
	$lv = $poke[$off]['Lv'];
}

if(array_key_exists('Gender', $poke[$off])){
	$gender = $poke[$off]['Gender'];
}

if(array_key_exists('Species', $poke[$off])){
	$species = $poke[$off]['Species'];
	$snum = array_search($poke[$off]['Species'],$tkan) + 1;
	$snum = str_pad($snum, 3, '0', STR_PAD_LEFT);
}
if(array_key_exists('Forme', $poke[$off])){
	$forme = $poke[$off]['Forme'];
}
if(array_key_exists('Shiny', $poke[$off])){
	$shine = $poke[$off]['Shiny'];
}
if(array_key_exists('Ability', $poke[$off])){
	$ability = $poke[$off]['Ability'];
}

if(array_key_exists('Nature', $poke[$off])){
	$nature = $poke[$off]['Nature'];
}

if(array_key_exists('ID', $poke[$off])){
	$idn = $poke[$off]['ID'];
}

if(array_key_exists('OT', $poke[$off])){
	$ot = $poke[$off]['OT'];
}

if(array_key_exists('Trainer', $poke[$off])){
	$trainer = $poke[$off]['Trainer'];
}

if(array_key_exists('Game', $poke[$off])){
	$game = $poke[$off]['Game'];
}

if(array_key_exists('Pkrs', $poke[$off])){
	$pkrs = $poke[$off]['Pkrs'];
}

if(array_key_exists('Moves', $poke[$off])){
	$mnum = sizeof($poke[$off]['Moves']);
	for($m = 0; $m < $mnum; $m++){
		$moves[$m] = $poke[$off]['Moves'][$m];
	}
}

if(array_key_exists('HP', $poke[$off])){
	$hp = $poke[$off]['HP'];
}

if(array_key_exists('Atk', $poke[$off])){
	$atk = $poke[$off]['Atk'];
}

if(array_key_exists('Def', $poke[$off])){
	$def = $poke[$off]['Def'];
}

if(array_key_exists('SAt', $poke[$off])){
	$sat = $poke[$off]['SAt'];
}

if(array_key_exists('SDe', $poke[$off])){
	$sde = $poke[$off]['SDe'];
}
if(array_key_exists('Spd', $poke[$off])){
	$spd = $poke[$off]['Spd'];
}

if(array_key_exists('Gen', $poke[$off])){
	$gen = $poke[$off]['Gen'];
}


$el = count($poke);

?>

<p class="shug">
<input type="button" onClick="start()" value = "|<"/>
<input type="button" onClick="indDec(1000)" value = "-1000"/>
<input type="button" onClick="indDec(500)" value = "-500"/>
<input type="button" onClick="indDec(250)" value = "-250"/>
<input type="button" onClick="indDec(100)" value = "-100"/>
<input type="button" onClick="indDec(50)" value = "-50"/>
<input type="button" onClick="indDec(25)" value = "-25"/>
<input type="button" onClick="indDec(10)" value = "-10"/>
<input type="button" onClick="indDec(5)" value = "-5"/>
<input type="button" onClick="indDec(2)" value = "-2"/>
<input type="button" onClick="indDec(1)" value = "-1"/>
<br>
<input type="button" onClick="indInc(1)" value = "1"/>
<input type="button" onClick="indInc(2)" value = "2"/>
<input type="button" onClick="indInc(5)" value = "5"/>
<input type="button" onClick="indInc(10)" value = "10"/>
<input type="button" onClick="indInc(25)" value = "25"/>
<input type="button" onClick="indInc(50)" value = "50"/>
<input type="button" onClick="indInc(100)" value = "100"/>
<input type="button" onClick="indInc(250)" value = "250"/>
<input type="button" onClick="indInc(500)" value = "500"/>
<input type="button" onClick="indInc(1000)" value = "1000"/>
<input type="button" onClick="addEntry()" value = ">|"/>
</p>

<form action="niqCalc.php" method="post">
<p class="split-para">
Name: <input type="text" id="name" name="name" style="border:0px;background-color:#00FF00;" size="12" onchange="turnText('name')" value="<?= $name ?>" />
<span>
Evolve: <input type="text" id="evo" name="evo" style="border:0px;background-color:#00FF00;" size="12" onchange="turnText('evo')" value="<?= $spe2 ?>" />
</span>
<?php
	if(isset($_COOKIE["evo"])){
		$spe2 = $_COOKIE["evo"];
	} else {
		$spe2 = $species;
	}
?>
<br>
Game: <select id="game" name="game" style="border:0px;background-color:#00FF00;" onchange="turnText('game')"/>
	<option value = ''></option>
	<?php
		$gam = file("gameList.txt");
		$games=array_map('trim',$gam);
		
		foreach($games as $ga){
			if($game === $ga){
				echo "<option value='".$ga."' selected>".$ga."</option>";
			} else {
				echo "<option value='".$ga."'>".$ga."</option>";
			}
		}
	?>
</select>
<span>
Move To: <select id="mt" name="mt" style="border:0px;background-color:#00FF00;"/>
	<?php
		$gam = file("gameList.txt");
		$games=array_map('trim',$gam);
		foreach($games as $ga){
			if($ga == $_COOKIE["chan"]){
				echo "<option value='".$ga."' selected>".$ga."</option>";
			} else {
				echo "<option value='".$ga."'>".$ga."</option>";
			}
		}
	?>
</select>
</span>
<?php
	$gam2 = $_COOKIE["chan"];
	$gname = substr($_COOKIE["chan"], 0, strrpos($_COOKIE["chan"], '[')-1);
	if($gname === "Red" or $gname === "Blue" or $gname === "Yellow"){
		$ge2 = 1;
	}
	if($gname === "Gold" or $gname === "Silver" or $gname === "Crystal"){
		$ge2 = 2;
	}
	if($gname === "Ruby" or $gname === "Sapphire" or $gname === "Emerald" or $gname === "FireRed" or $gname === "LeafGreen" or $gname === "Colosseum" or $gname === "XD"){
		$ge2 = 3;
	}
	if($gname === "Diamond" or $gname === "Pearl" or $gname === "Platinum" or $gname === "HeartGold" or $gname === "SoulSilver" or $data[$j]['Game'] === "Ranch"){
		$ge2 = 4;
	}
	if($gname === "Black" or $gname === "White" or $gname === "Black 2" or $gname === "White 2"){
		$ge2 = 5;
	}
	if($gname === "X" or $gname === "Y" or $gname === "Omega Ruby" or $gname === "Alpha Sapphire" or $gname === "Bank VI"){
		$ge2 = 6;
	}
	if($gname === "Sun" or $gname === "Moon" or $gname === "Bank VII"){
		$ge2 = 7;
	}
?>
<br>
Species: <input type="text" id="species" name="species" style="border:0px;background-color:#00FF00;" size="12" onchange="turnText('species')" value="<?= $species ?>" />
<?php
	$score = 0;
	$sp1 = 0;
	$sp2 = 0;
	$sp3 = 0;
	
	foreach($poke2 as $p2){
		if($p2['Species'] == $species){
			$sp1++;
			if($p2['Gen'] == $gen){
				$sp2++;
				if($p2['Game'] == $game){
					$sp3++;
				}
			}
		}
	}
	
	
	for ($j = 0; $j < $el; $j++){
		$nar1[$j] = $poke[$j]['Game'];
		$nar2[$j] = $poke[$j]['Gen'];
		if($poke2[$j]['Species'] == $species){
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
	
	echo ' '. $sp1+$sp2+$sp3 .' ('.$sp1.'+'.$sp2.'+'.$sp3.')';
?>
<span>
<?php
	$spa1 = 0;
	$spa2 = 0;
	$spa3 = 0;
	
	foreach($poke2 as $p2){
		if($p2['Species'] == $spe2){
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
		if($poke2[$j]['Species'] == $spe2){
			$na2r++;
			$na2a1[$j] = $poke2[$j]['Game'];
			$na2a2[$j] = $poke2[$j]['Gen'];
		}
	}
	
	$cs1 = array_count_values($na2a1);
	$cs2 = array_count_values($na2a2);
	
	$spa1 = round($spa1 / $el,5);
	$spa2 = round($spa2 / $ct2[$ge2],5);
	$spa3 = round($spa3 / $ct1[$gam2],5);
	
	$val = $sp1+$sp2+$sp3-($spa1+$spa2+$spa3);
	$score += $val;
	
	
	echo 'Change: '.$val.' ('.$spa1.' '.$spa2.' '.$spa3.')';
?>
</span>
<br>
Lv: <input type="text" id="lv" name="lv" style="border:0px;background-color:#00FF00;" size="3" onchange="turnText('lv')" value="<?= $lv ?>" />
<?php
	$sp1 = 0;
	$sp2 = 0;
	$sp3 = 0;
	$spt1 = 0;
	$spt2 = 0;
	$spt3 = 0;
	
	foreach($poke2 as $p2){
		if($p2['Lv'] > $lv){
			$sp1++;
			if($p2['Species'] == $species){
				$spt1++;
			}
			if($p2['Gen'] == $gen){
				$sp2++;
				if($p2['Species'] == $species){
					$spt2++;
				}
				if($p2['Game'] == $game){
					$sp3++;
					if($p2['Species'] == $species){
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
	
	echo ' '. ($sp1+$sp2+$sp3+$spt1+$spt2+$spt3) .' ('.$sp1.'+'.$spt1.')+('.$sp2.'+'.$spt2.')+('.$sp3.'+'.$spt3.')';
?>
<span>
<?php

	$spa1 = 0;
	$spa2 = 0;
	$spa3 = 0;
	$spat1 = 0;
	$spat2 = 0;
	$spat3 = 0;
	
	foreach($poke2 as $p2){
		if($p2['Lv'] > $lv){
			$spa1++;
			if($p2['Species'] == $spe2){
				$spat1++;
			}
			if($p2['Gen'] == $ge2){
				$spa2++;
				if($p2['Species'] == $spe2){
					$spat2++;
				}
				if($p2['Game'] == $gam2){
					$spa3++;
					if($p2['Species'] == $spe2){
						$spat3++;
					}
				}
			}
		}
	}
	
	$spa1 = round($spa1 / $el,5);
	$spa2 = round($spa2 / $ct2[$ge2],5);
	$spa3 = round($spa3 / $ct1[$gam2],5);
	$spat1 = round($spat1 / $na2r,5);
	$spat2 = round($spat2 / $cs2[$ge2],5);
	$spat3 = round($spat3 / $cs1[$gam2],5);
	
	$val = $sp1+$sp2+$sp3-($spa1+$spa2+$spa3)+$spt1+$spt2+$spt3-($spat1+$spat2+$spat3);
	$val = round($val,5);

	echo 'Change: '.$val.' (['.$spa1.', '.$spat1.'] ['.$spa2.', '.$spat2.'] ['.$spa3.', '.$spat3.'])';
?>
</span>
<br>
Ball: <input type="text" id="ball" name="ball" style="border:0px;background-color:#00FF00;" size="8" onchange="turnText('ball')" value="<?= $ball ?>" />
<?php
	$sp1 = 0;
	$sp2 = 0;
	$sp3 = 0;
	$spt1 = 0;
	$spt2 = 0;
	$spt3 = 0;
	
	foreach($poke2 as $p2){
		if($p2['Ball'] == $ball){
			$sp1++;
			if($p2['Species'] == $species){
				$spt1++;
			}
			if($p2['Gen'] == $gen){
				$sp2++;
				if($p2['Species'] == $species){
					$spt2++;
				}
				if($p2['Game'] == $game){
					$sp3++;
					if($p2['Species'] == $species){
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
	
	echo ' '.$sp1+$sp2+$sp3+$spt1+$spt2+$spt3.' ('.$sp1.'+'.$spt1.')+('.$sp2.'+'.$spt2.')+('.$sp3.'+'.$spt3.')';
?>
<span>
<?php

	$spa1 = 0;
	$spa2 = 0;
	$spa3 = 0;
	$spat1 = 0;
	$spat2 = 0;
	$spat3 = 0;
	
	foreach($poke2 as $p2){
		if($p2['Ball'] == $ball){
			$spa1++;
			if($p2['Species'] == $spe2){
				$spat1++;
			}
			if($p2['Gen'] == $ge2){
				$spa2++;
				if($p2['Species'] == $spe2){
					$spat2++;
				}
				if($p2['Game'] == $gam2){
					$spa3++;
					if($p2['Species'] == $spe2){
						$spat3++;
					}
				}
			}
		}
	}
	
	$spa1 = round($spa1 / $el,5);
	$spa2 = round($spa2 / $ct2[$ge2],5);
	$spa3 = round($spa3 / $ct1[$gam2],5);
	$spat1 = round($spat1 / $na2r,5);
	$spat2 = round($spat2 / $cs2[$ge2],5);
	$spat3 = round($spat3 / $cs1[$gam2],5);
	
	$val = $sp1+$sp2+$sp3-($spa1+$spa2+$spa3)+$spt1+$spt2+$spt3-($spat1+$spat2+$spat3);
	$val = round($val,5);

	echo 'Change: '.$val.' (['.$spa1.', '.$spat1.'] ['.$spa2.', '.$spat2.'] ['.$spa3.', '.$spat3.'])';
?>
</span>
<br>
Gender: <select id="gender" name="gender" style="border:0px;background-color:#00FF00;" size="1" onchange="turnText('gender')"/>
	<option value = ''></option>
	<?php
		$spra = ["F","M","N"];
		
		foreach($spra as $sp){
			if($gender === $sp){
				echo "<option value='".$sp."' selected>".$sp."</option>";
			} else {
				echo "<option value='".$sp."'>".$sp."</option>";
			}
		}
	?>
</select>
<?php
	$sp1 = 0;
	$sp2 = 0;
	$sp3 = 0;
	
	foreach($poke2 as $p2){
		if($p2['Species'] == $species){
			if($p2['Gender'] == $gender){
				$sp1++;
				if($p2['Gen'] == $gen){
					$sp2++;
					if($p2['Game'] == $game){
						$sp3++;
					}
				}
			}
		}
	}
	
	$sp1 = round($sp1 / $narr,5);
	$sp2 = round($sp2 / $cn2[$gen],5);
	$sp3 = round($sp3 / $cn1[$game],5);
	
	echo '  '.$sp1+$sp2+$sp3.' ('.$sp1.'+'.$sp2.'+'.$sp3.')';
?>
<br>
Ability: <input type="text" id="ability" name="ability" style="border:0px;background-color:#00FF00;" size="18" onchange="turnText('ability')" value="<?= $ability ?>" />
<?php
	$sp1 = 0;
	$sp2 = 0;
	$sp3 = 0;
	
	foreach($poke2 as $p2){
		if($p2['Species'] == $species){
			if($p2['Ability'] == $ability){
				$sp1++;
				if($p2['Gen'] == $gen){
					$sp2++;
					if($p2['Game'] == $game){
						$sp3++;
					}
				}
			}
		}
	}
	
	$sp1 = round($sp1 / $narr,5);
	$sp2 = round($sp2 / $cn2[$gen],5);
	$sp3 = round($sp3 / $cn1[$game],5);
	
	echo ' '.$sp1+$sp2+$sp3.' ('.$sp1.'+'.$sp2.'+'.$sp3.')';
?>
<br>
Language: <select id="lang" name="lang" style="border:0px;color:#ffffff;background-color:#444444;" onchange="turnText('lang')"/>
	<option value = ''></option>
	<?php
		$spra = ["CHS","CHT","ENG","FRE","GER","ITA","JPN","KOR","SPA"];
		
		foreach($spra as $sp){
			if($lang === $sp){
				echo "<option value='".$sp."' selected>".$sp."</option>";
			} else {
				echo "<option value='".$sp."'>".$sp."</option>";
			}
		}
	?>
</select>
<?php
	$sp1 = 0;
	$sp2 = 0;
	$sp3 = 0;
	$spt1 = 0;
	$spt2 = 0;
	$spt3 = 0;
	
	foreach($poke2 as $p2){
		if($p2['Lang'] == $lang){
			$sp1++;
			if($p2['Species'] == $species){
				$spt1++;
			}
			if($p2['Gen'] == $gen){
				$sp2++;
				if($p2['Species'] == $species){
					$spt2++;
				}
				if($p2['Game'] == $game){
					$sp3++;
					if($p2['Species'] == $species){
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
	
	echo ' '.$sp1+$sp2+$sp3+$spt1+$spt2+$spt3.' ('.$sp1.'+'.$spt1.')+('.$sp2.'+'.$spt2.')+('.$sp3.'+'.$spt3.')';
?>
<span>
<?php

	$spa1 = 0;
	$spa2 = 0;
	$spa3 = 0;
	$spat1 = 0;
	$spat2 = 0;
	$spat3 = 0;
	
	foreach($poke2 as $p2){
		if($p2['Lang'] == $lang){
			$spa1++;
			if($p2['Species'] == $spe2){
				$spat1++;
			}
			if($p2['Gen'] == $ge2){
				$spa2++;
				if($p2['Species'] == $spe2){
					$spat2++;
				}
				if($p2['Game'] == $gam2){
					$spa3++;
					if($p2['Species'] == $spe2){
						$spat3++;
					}
				}
			}
		}
	}
	
	$spa1 = round($spa1 / $el,5);
	$spa2 = round($spa2 / $ct2[$ge2],5);
	$spa3 = round($spa3 / $ct1[$gam2],5);
	$spat1 = round($spat1 / $na2r,5);
	$spat2 = round($spat2 / $cs2[$ge2],5);
	$spat3 = round($spat3 / $cs1[$gam2],5);
	
	$val = $sp1+$sp2+$sp3-($spa1+$spa2+$spa3)+$spt1+$spt2+$spt3-($spat1+$spat2+$spat3);
	$val = round($val,5);

	echo 'Change: '.$val.' (['.$spa1.', '.$spat1.'] ['.$spa2.', '.$spat2.'] ['.$spa3.', '.$spat3.'])';
?>
</span>
<br>
Moves: <br>
<input type="text" id="move1" name="moves[]" style="border:0px;background-color:#00FF00;" size="18" onchange="turnText('move1')" value="<?= $moves[0] ?>" />
<?php
	$sp1 = 0;
	$sp2 = 0;
	$sp3 = 0;
	$spt1 = 0;
	$spt2 = 0;
	$spt3 = 0;
	
	foreach($poke2 as $p2){
		if(in_array($moves[0], $p2['Moves'])){
			$sp1++;
			if($p2['Species'] == $species){
				$spt1++;
			}
			if($p2['Gen'] == $gen){
				$sp2++;
				if($p2['Species'] == $species){
					$spt2++;
				}
				if($p2['Game'] == $game){
					$sp3++;
					if($p2['Species'] == $species){
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
	
	echo ' '.$sp1+$sp2+$sp3+$spt1+$spt2+$spt3.' ('.$sp1.'+'.$spt1.')+('.$sp2.'+'.$spt2.')+('.$sp3.'+'.$spt3.')';
?>
<span>
<?php

	$moval = 0;
	$spa1 = 0;
	$spa2 = 0;
	$spa3 = 0;
	$spat1 = 0;
	$spat2 = 0;
	$spat3 = 0;
	
	foreach($poke2 as $p2){
		if(in_array($moves[0], $p2['Moves'])){
			$spa1++;
			if($p2['Species'] == $spe2){
				$spat1++;
			}
			if($p2['Gen'] == $ge2){
				$spa2++;
				if($p2['Species'] == $spe2){
					$spat2++;
				}
				if($p2['Game'] == $gam2){
					$spa3++;
					if($p2['Species'] == $spe2){
						$spat3++;
					}
				}
			}
		}
	}
	
	$spa1 = round($spa1 / $el,5);
	$spa2 = round($spa2 / $ct2[$ge2],5);
	$spa3 = round($spa3 / $ct1[$gam2],5);
	$spat1 = round($spat1 / $na2r,5);
	$spat2 = round($spat2 / $cs2[$ge2],5);
	$spat3 = round($spat3 / $cs1[$gam2],5);
	
	$val = $sp1+$sp2+$sp3-($spa1+$spa2+$spa3)+$spt1+$spt2+$spt3-($spat1+$spat2+$spat3);
	$val = round($val,5);
	$moval += $spa1+$spa2+$spa3+$spat1+$spat2+$spat3;
	$score += ($val / 8);

	echo 'Change: '.$val.' (['.$spa1.', '.$spat1.'] ['.$spa2.', '.$spat2.'] ['.$spa3.', '.$spat3.'])';
?>
</span>
<br>
<input type="text" id="move2" name="moves[]" style="border:0px;background-color:#00FF00;" size="18" onchange="turnText('move2')" value="<?= $moves[1] ?>" />
<?php
	$sp1 = 0;
	$sp2 = 0;
	$sp3 = 0;
	$spt1 = 0;
	$spt2 = 0;
	$spt3 = 0;
	
	foreach($poke2 as $p2){
		if(in_array($moves[1], $p2['Moves'])){
			$sp1++;
			if($p2['Species'] == $species){
				$spt1++;
			}
			if($p2['Gen'] == $gen){
				$sp2++;
				if($p2['Species'] == $species){
					$spt2++;
				}
				if($p2['Game'] == $game){
					$sp3++;
					if($p2['Species'] == $species){
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
	
	echo ' '.$sp1+$sp2+$sp3+$spt1+$spt2+$spt3.' ('.$sp1.'+'.$spt1.')+('.$sp2.'+'.$spt2.')+('.$sp3.'+'.$spt3.')';
?>
<span>
<?php

	$spa1 = 0;
	$spa2 = 0;
	$spa3 = 0;
	$spat1 = 0;
	$spat2 = 0;
	$spat3 = 0;
	
	foreach($poke2 as $p2){
		if(in_array($moves[1], $p2['Moves'])){
			$spa1++;
			if($p2['Species'] == $spe2){
				$spat1++;
			}
			if($p2['Gen'] == $ge2){
				$spa2++;
				if($p2['Species'] == $spe2){
					$spat2++;
				}
				if($p2['Game'] == $gam2){
					$spa3++;
					if($p2['Species'] == $spe2){
						$spat3++;
					}
				}
			}
		}
	}
	
	$spa1 = round($spa1 / $el,5);
	$spa2 = round($spa2 / $ct2[$ge2],5);
	$spa3 = round($spa3 / $ct1[$gam2],5);
	$spat1 = round($spat1 / $na2r,5);
	$spat2 = round($spat2 / $cs2[$ge2],5);
	$spat3 = round($spat3 / $cs1[$gam2],5);
	
	$val = $sp1+$sp2+$sp3-($spa1+$spa2+$spa3)+$spt1+$spt2+$spt3-($spat1+$spat2+$spat3);
	$val = round($val,5);
	$moval += $spa1+$spa2+$spa3+$spat1+$spat2+$spat3;
	$score += ($val / 8);

	echo 'Change: '.$val.' (['.$spa1.', '.$spat1.'] ['.$spa2.', '.$spat2.'] ['.$spa3.', '.$spat3.'])';
?>
</span>
<br>
<input type="text" id="move3" name="moves[]" style="border:0px;background-color:#00FF00;" size="18" onchange="turnText('move3')" value="<?= $moves[2] ?>" />
<?php
	$sp1 = 0;
	$sp2 = 0;
	$sp3 = 0;
	$spt1 = 0;
	$spt2 = 0;
	$spt3 = 0;
	
	foreach($poke2 as $p2){
		if(in_array($moves[2], $p2['Moves'])){
			$sp1++;
			if($p2['Species'] == $species){
				$spt1++;
			}
			if($p2['Gen'] == $gen){
				$sp2++;
				if($p2['Species'] == $species){
					$spt2++;
				}
				if($p2['Game'] == $game){
					$sp3++;
					if($p2['Species'] == $species){
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
	
	echo ' '.$sp1+$sp2+$sp3+$spt1+$spt2+$spt3.' ('.$sp1.'+'.$spt1.')+('.$sp2.'+'.$spt2.')+('.$sp3.'+'.$spt3.')';
?>
<span>
<?php

	$spa1 = 0;
	$spa2 = 0;
	$spa3 = 0;
	$spat1 = 0;
	$spat2 = 0;
	$spat3 = 0;
	
	foreach($poke2 as $p2){
		if(in_array($moves[2], $p2['Moves'])){
			$spa1++;
			if($p2['Species'] == $spe2){
				$spat1++;
			}
			if($p2['Gen'] == $ge2){
				$spa2++;
				if($p2['Species'] == $spe2){
					$spat2++;
				}
				if($p2['Game'] == $gam2){
					$spa3++;
					if($p2['Species'] == $spe2){
						$spat3++;
					}
				}
			}
		}
	}
	
	$spa1 = round($spa1 / $el,5);
	$spa2 = round($spa2 / $ct2[$ge2],5);
	$spa3 = round($spa3 / $ct1[$gam2],5);
	$spat1 = round($spat1 / $na2r,5);
	$spat2 = round($spat2 / $cs2[$ge2],5);
	$spat3 = round($spat3 / $cs1[$gam2],5);
	
	$val = $sp1+$sp2+$sp3-($spa1+$spa2+$spa3)+$spt1+$spt2+$spt3-($spat1+$spat2+$spat3);
	$val = round($val,5);
	$moval += $spa1+$spa2+$spa3+$spat1+$spat2+$spat3;
	$score += ($val / 8);

	echo 'Change: '.$val.' (['.$spa1.', '.$spat1.'] ['.$spa2.', '.$spat2.'] ['.$spa3.', '.$spat3.'])';
?>
</span>
<br>
<input type="text" id="move4" name="moves[]" style="border:0px;background-color:#00FF00;" size="18" onchange="turnText('move4')" value="<?= $moves[3] ?>" />
<?php
	$sp1 = 0;
	$sp2 = 0;
	$sp3 = 0;
	$spt1 = 0;
	$spt2 = 0;
	$spt3 = 0;
	
	foreach($poke2 as $p2){
		if(in_array($moves[3], $p2['Moves'])){
			$sp1++;
			if($p2['Species'] == $species){
				$spt1++;
			}
			if($p2['Gen'] == $gen){
				$sp2++;
				if($p2['Species'] == $species){
					$spt2++;
				}
				if($p2['Game'] == $game){
					$sp3++;
					if($p2['Species'] == $species){
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
	
	echo ' '.$sp1+$sp2+$sp3+$spt1+$spt2+$spt3.' ('.$sp1.'+'.$spt1.')+('.$sp2.'+'.$spt2.')+('.$sp3.'+'.$spt3.')';
?>
<span>
<?php

	$spa1 = 0;
	$spa2 = 0;
	$spa3 = 0;
	$spat1 = 0;
	$spat2 = 0;
	$spat3 = 0;
	
	foreach($poke2 as $p2){
		if(in_array($moves[3], $p2['Moves'])){
			$spa1++;
			if($p2['Species'] == $spe2){
				$spat1++;
			}
			if($p2['Gen'] == $ge2){
				$spa2++;
				if($p2['Species'] == $spe2){
					$spat2++;
				}
				if($p2['Game'] == $gam2){
					$spa3++;
					if($p2['Species'] == $spe2){
						$spat3++;
					}
				}
			}
		}
	}
	
	$spa1 = round($spa1 / $el,5);
	$spa2 = round($spa2 / $ct2[$ge2],5);
	$spa3 = round($spa3 / $ct1[$gam2],5);
	$spat1 = round($spat1 / $na2r,5);
	$spat2 = round($spat2 / $cs2[$ge2],5);
	$spat3 = round($spat3 / $cs1[$gam2],5);
	
	$val = $sp1+$sp2+$sp3-($spa1+$spa2+$spa3)+$spt1+$spt2+$spt3-($spat1+$spat2+$spat3);
	$val = round($val,5);
	$moval += $spa1+$spa2+$spa3+$spat1+$spat2+$spat3;
	$moval = round($moval,5);
	$score += ($val / 8);

	echo 'Change: '.$val.' (['.$spa1.', '.$spat1.'] ['.$spa2.', '.$spat2.'] ['.$spa3.', '.$spat3.'])';
?>
</span>
<br>
New? <input type="text" id="newm" name="newm" style="border:0px;background-color:#00FF00;" size="18" value="<?= $newm ?>" />
<span>
<?php

	$spa1 = 0;
	$spa2 = 0;
	$spa3 = 0;
	$spat1 = 0;
	$spat2 = 0;
	$spat3 = 0;
	
	foreach($poke2 as $p2){
		if(in_array($newm, $p2['Moves'])){
			$spa1++;
			if($p2['Species'] == $spe2){
				$spat1++;
			}
			if($p2['Gen'] == $gen){
				$spa2++;
				if($p2['Species'] == $spe2){
					$spat2++;
				}
				if($p2['Game'] == $game){
					$spa3++;
					if($p2['Species'] == $spe2){
						$spat3++;
					}
				}
			}
		}
	}
	
	$spa1 = round($spa1 / $el,5);
	$spa2 = round($spa2 / $ct2[$gen],5);
	$spa3 = round($spa3 / $ct1[$game],5);
	$spat1 = round($spat1 / $na2r,5);
	$spat2 = round($spat2 / $cs2[$gen],5);
	$spat3 = round($spat3 / $cs1[$game],5);
	
	$val = ($spa1+$spa2+$spa3)+($spat1+$spat2+$spat3);
	$val = round($val,5);

	echo 'New: '.$val.' (['.$spa1.', '.$spat1.'] ['.$spa2.', '.$spat2.'] ['.$spa3.', '.$spat3.'])';
?>
</span>
<br>
<span>
<?php
echo 'Score: '.$score;
?>
</span>
<br>
HP <input type="text" id="hp" name="hp" style="border:0px;background-color:#00FF00;" size="18" onchange="turnText('hp')" value="<?= $hp ?>" />
<?php
	$sp1 = 0;
	$sp2 = 0;
	$sp3 = 0;
	
	foreach($poke2 as $p2){
		if($p2['Species'] == $species){
			if($p2['HP'] > $hp){
				$sp1++;
				if($p2['Gen'] == $gen){
					$sp2++;
					if($p2['Game'] == $game){
						$sp3++;
					}
				}
			}
		}
	}
	
	$sp1 = round($sp1 / $narr,5);
	$sp2 = round($sp2 / $cn2[$gen],5);
	$sp3 = round($sp3 / $cn1[$game],5);
	
	echo ' '.$sp1+$sp2+$sp3.' ('.$sp1.'+'.$sp2.'+'.$sp3.')';
?>
<br>
<?php
echo 'Attack <input type="text" id="atk" name="atk" style="border:0px;background-color:#00FF00;';
 
if($nature === "Lonely" or $nature === "Adamant" or $nature === "Naughty" or $nature === "Brave"){
	echo "color:#FF0000;";
} else if($nature === "Bold" or $nature === "Modest" or $nature === "Calm" or $nature === "Timid"){
	echo "color:#0000FF;";
} else if($nature === "Hardy"){
	echo "color:#FF00FF;";
}

echo ' size="3" onchange="turnText(\'atk\')" value='.$atk. ' />';

$sp1 = 0;
	$sp2 = 0;
	$sp3 = 0;
	
	foreach($poke2 as $p2){
		if($p2['Species'] == $species){
			if($p2['Atk'] > $atk){
				$sp1++;
				if($p2['Gen'] == $gen){
					$sp2++;
					if($p2['Game'] == $game){
						$sp3++;
					}
				}
			}
		}
	}
	
	$sp1 = round($sp1 / $narr,5);
	$sp2 = round($sp2 / $cn2[$gen],5);
	$sp3 = round($sp3 / $cn1[$game],5);
	
	echo ' '.$sp1+$sp2+$sp3.' ('.$sp1.'+'.$sp2.'+'.$sp3.')';
?>
<br>
<?php
echo 'Defense <input type="text" id="def" name="def" style="border:0px;background-color:#00FF00;';
 
if($nature === "Bold" or $nature === "Impish" or $nature === "Lax" or $nature === "Relaxed"){
	echo "color:#FF0000;";
} else if($nature === "Lonely" or $nature === "Mild" or $nature === "Gentle" or $nature === "Hasty"){
	echo "color:#0000FF;";
} else if($nature === "Docile"){
	echo "color:#FF00FF;";
}

echo ' size="3" onchange="turnText(\'def\')" value='.$def. ' />';

$sp1 = 0;
	$sp2 = 0;
	$sp3 = 0;
	
	foreach($poke2 as $p2){
		if($p2['Species'] == $species){
			if($p2['Def'] > $def){
				$sp1++;
				if($p2['Gen'] == $gen){
					$sp2++;
					if($p2['Game'] == $game){
						$sp3++;
					}
				}
			}
		}
	}
	
	$sp1 = round($sp1 / $narr,5);
	$sp2 = round($sp2 / $cn2[$gen],5);
	$sp3 = round($sp3 / $cn1[$game],5);
	
	echo ' '.$sp1+$sp2+$sp3.' ('.$sp1.'+'.$sp2.'+'.$sp3.')';
?>
<br>
<?php
echo 'Sp. Atk <input type="text" id="sat" name="sat" style="border:0px;background-color:#00FF00;';
 
if($nature === "Modest" or $nature === "Mild" or $nature === "Quiet" or $nature === "Rash"){
	echo "color:#FF0000;";
} else if($nature === "Adamant" or $nature === "Impish" or $nature === "Careful" or $nature === "Jolly"){
	echo "color:#0000FF;";
} else if($nature === "Bashful"){
	echo "color:#FF00FF;";
}

echo ' size="3" onchange="turnText(\'sat\')" value='.$sat. ' />';

	$sp1 = 0;
	$sp2 = 0;
	$sp3 = 0;
	
	foreach($poke2 as $p2){
		if($p2['Species'] == $species){
			if($p2['SAt'] > $sat){
				$sp1++;
				if($p2['Gen'] == $gen){
					$sp2++;
					if($p2['Game'] == $game){
						$sp3++;
					}
				}
			}
		}
	}
	
	$sp1 = round($sp1 / $narr,5);
	$sp2 = round($sp2 / $cn2[$gen],5);
	$sp3 = round($sp3 / $cn1[$game],5);
	
	echo ' '.$sp1+$sp2+$sp3.' ('.$sp1.'+'.$sp2.'+'.$sp3.')';


?>
<br>
<?php
echo 'Sp. Def <input type="text" id="sde" name="sde" style="border:0px;background-color:#00FF00;';
 
if($nature === "Calm" or $nature === "Gentle" or $nature === "Careful" or $nature === "Sassy"){
	echo "color:#FF0000;";
} else if($nature === "Naughty" or $nature === "Lax" or $nature === "Rash" or $nature === "Naive"){
	echo "color:#0000FF;";
} else if($nature === "Quirky"){
	echo "color:#FF00FF;";
}

echo ' size="3" onchange="turnText(\'sde\')" value='.$sde. ' />';

	$sp1 = 0;
	$sp2 = 0;
	$sp3 = 0;
	
	foreach($poke2 as $p2){
		if($p2['Species'] == $species){
			if($p2['SDe'] > $sde){
				$sp1++;
				if($p2['Gen'] == $gen){
					$sp2++;
					if($p2['Game'] == $game){
						$sp3++;
					}
				}
			}
		}
	}
	
	$sp1 = round($sp1 / $narr,5);
	$sp2 = round($sp2 / $cn2[$gen],5);
	$sp3 = round($sp3 / $cn1[$game],5);
	
	echo ' '.$sp1+$sp2+$sp3.' ('.$sp1.'+'.$sp2.'+'.$sp3.')';

?>
<br>
<?php
echo 'Speed <input type="text" id="spd" name="spd" style="border:0px;background-color:#00FF00;';
 
if($nature === "Timid" or $nature === "Hasty" or $nature === "Jolly" or $nature === "Naive"){
	echo "color:#FF0000;";
} else if($nature === "Brave" or $nature === "Relaxed" or $nature === "Quiet" or $nature === "Sassy"){
	echo "color:#0000FF;";
} else if($nature === "Serious"){
	echo "color:#FF00FF;";
}

echo ' size="3" onchange="turnText(\'spd\')" value='.$spd. ' />';

	$sp1 = 0;
	$sp2 = 0;
	$sp3 = 0;
	
	foreach($poke2 as $p2){
		if($p2['Species'] == $species){
			if($p2['Spd'] > $spd){
				$sp1++;
				if($p2['Gen'] == $gen){
					$sp2++;
					if($p2['Game'] == $game){
						$sp3++;
					}
				}
			}
		}
	}
	
	$sp1 = round($sp1 / $narr,5);
	$sp2 = round($sp2 / $cn2[$gen],5);
	$sp3 = round($sp3 / $cn1[$game],5);
	
	echo ' '.$sp1+$sp2+$sp3.' ('.$sp1.'+'.$sp2.'+'.$sp3.')';

?>
</p>
<p class="shug"><input type="submit" value="Update">
</form>
<form action="index.php" method="post">
<p class="shug"><input type="submit" value="Back">
</form>
</p>
<script>
function indInc(p1) {
	o = parseInt(getCookie('off'));
	setCookie("off",o+p1);
	//document.cookie = "off=1";
	window.location.reload();
}
function indDec(p1) {
	o = parseInt(getCookie('off'));
	o = parseInt(getCookie('off'));
	if(o > p1-1){
		setCookie("off",o-p1);
	} else {
		setCookie("off",0);
	}
	window.location.reload();
}
function start() {
	setCookie("off",0);
	window.location.reload();
}
function cookRes() {
	setCookie("off",0);
	window.location.reload();
}

function turnText(x) {
	var x = document.getElementById(x);
    x.style.backgroundColor = "yellow";
}

function nameSearch(){
	var x = document.getElementById("sname").value;
	var request = new XMLHttpRequest();
	request.open("GET", "pokedata.json", false);
	request.send(null)
	var obj = JSON.parse(request.responseText);
	var count = Object.keys(obj).length;
	document.getElementById("demo").innerHTML = count;
	for(i = 0; i < count; i++){
		if(obj[i].Name.toLowerCase() === x.toLowerCase()){
			setCookie("off",i);
			break;
		} else if(i == (count-1)){
			setCookie("off",i+1);
			break;
		}
	}
	//document.getElementById("demo").innerHTML = getCookie("off");
	window.location.reload();
}
function levelJump(){
	var x = document.getElementById("slv").value;
	var request = new XMLHttpRequest();
	request.open("GET", "pokedata.json", false);
	request.send(null)
	var obj = JSON.parse(request.responseText);
	var count = Object.keys(obj).length;
	for(i = 0; i < count; i++){
		if(parseInt(obj[i].Lv) >= parseInt(x)){
			setCookie("off",i);
			break;
		} else if(i == (count-1)){
			setCookie("off",i+1);
			break;
		}
	}
	//document.getElementById("demo").innerHTML = getCookie("off");
	window.location.reload();
}

function addEntry(){
	var request = new XMLHttpRequest();
	request.open("GET", "pokedata.json", false);
	request.send(null)
	var obj = JSON.parse(request.responseText);
	var count = Object.keys(obj).length;
	setCookie("off",count);
	window.location.reload();
}

function ranMon(){
	var request = new XMLHttpRequest();
	request.open("GET", "pokedata.json", false);
	request.send(null);
	var obj = JSON.parse(request.responseText);
	var count = Object.keys(obj).length;
	var ran = Math.floor((Math.random() * count) + 1);
	setCookie("off",ran);
	window.location.reload();
}

//Functions from W3Schools

function setCookie(cname,cvalue) {
    document.cookie = cname+"="+cvalue;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
</script>
</html>