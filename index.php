<!DOCTYPE html>
<html>
<title>Pokémon Data</title>
<style>
body {
    background-color: #9EDA71;
}

.shug { display:block;text-align:center;width:50%;margin-right:200px;}
.split-para      { display:block;margin:10px;}
.split-para span { display:block;float:right;width:50%;margin-left:10px;}
</style>
<body>
<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);

$myfile = fopen("pokedata.json", "r") or die("Unable to open file!");
$jin = fread($myfile,filesize("pokedata.json"));
$poke = json_decode($jin, true);

$kanto = file("kanto.txt");
$tkan = array_map('trim',$kanto);

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
$temmy = "";
$hp = 0;
$atk = 0;
$def = 0;
$sat = 0;
$sde = 0;
$spd = 0;
$gen = 25;

$off = 0;

if(isset($_COOKIE["off"])){
	$off = $_COOKIE["off"];
} else {
	setCookie("off",$off);
}
	echo $off;

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
if(array_key_exists('System', $poke[$off])){
	$temmy = $poke[$off]['System'];
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
?>

<form action="ran_mon.php" method="post">
From: <select id="from" name="from" style="border:0px;background-color:#9EDA71;"/>
	<?php
		$gam = file("gameList.txt");
		$games=array_map('trim',$gam);
		foreach($games as $ga){
			if($ga == $_COOKIE["firs"]){
				echo "<option value='".$ga."' selected>".$ga."</option>";
			} else {
				echo "<option value='".$ga."'>".$ga."</option>";
			}
		}
	?>
</select>
To: <select id="to" name="to" style="border:0px;background-color:#9EDA71;"/>
	<?php
		$gam = file("gameList.txt");
		$games=array_map('trim',$gam);
		foreach($games as $ga){
			if($ga === $_COOKIE["las"]){
				echo "<option value='".$ga."' selected>".$ga."</option>";
			} else {
				echo "<option value='".$ga."'>".$ga."</option>";
			}
		}
	?>
</select><br>
<p class="shug"><input type="submit" value="Random"></p>
</form>
<p class="shug">
<input type="button" onClick="start()" value = "|<"/>
<input type="button" onClick="indDec(2500)" value = "-2500"/>
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
<input type="button" onClick="indInc(2500)" value = "2500"/>
<input type="button" onClick="addEntry()" value = ">|"/>
</p>

<form action="edit_mon.php" method="post">
<h4><span style="background-color: #b22222;color:#ffffff;">
<?php
	if($ball != ""){
		echo "<img src='ball/".$ball.".png' border=0>";
	}
?>
Ball: <select id="ball" name="ball" style="border:0px;color:#ffffff;background-color:#b22222;" onchange="turnText('ball')"/>
	<option value = ''></option>
	<?php
		$balls = ["Poké","Great","Ultra","Master","Safari"];
		
		if($gen >= 3){	
			$bal3 = ["Net","Dive","Nest","Repeat","Timer","Luxury","Premier"];
			$balls = array_merge($balls,$bal3);
		}
		if($gen >= 4){	
			$bal4 = ["Dusk","Heal","Quick","Sport","Cherish"];
			$balls = array_merge($balls,$bal4);
			
			$gname = substr($game, 0, strrpos($game, '[')-1);
			
			if($gname === "Diamond" || $gname === "Pearl" || $gname === "Platinum"){
				
			} else {
				$bal2 = ["Fast","Level","Lure","Heavy","Love","Friend","Moon","Sport"];
				$balls = array_merge($balls,$bal2);
			}
		}
		if($gen >= 5){	
			$balls = array_merge($balls,["Dream"]);
		}
		if($gen >= 7){	
			$balls = array_merge($balls,["Beast"]);
		}
		
		foreach($balls as $bl){
			if($ball === $bl){
				echo "<option value='".$bl."' selected>".$bl."</option>";
			} else {
				echo "<option value='".$bl."'>".$bl."</option>";
			}
		}
	?>
</select>
Name: <input type="text" id="name" name="name" style="border:0px;color:#ffffff;background-color:#b22222;"  maxlength="12" size="12" onchange="turnText('name')" value="<?= $name ?>" />
Lv: <input type="text" id="lv" name="lv" style="border:0px;color:#ffffff;background-color:#b22222;"  maxlength="3" size="3" onchange="turnText('lv')" value="<?= $lv ?>" />
Gender: <select id="gender" name="gender" style="border:0px;color:#ffffff;background-color:#b22222;" size="1" onchange="turnText('gender')"/>
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
</select></span></h4>
<p class="split-para">
<?php
	if($snum != 0){
		if($forme != ""){
				if($species === "Unown"){
					if($forme === "!"){
						if(!file_exists('icons/'. $snum . 'aa.png')){
							file_put_contents('icons/'. $snum . 'aa.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $snum . 'aa.png'));
						}
						echo "<br><img src='icons/". $snum . "aa.png' border=0>";
					} elseif($forme === "?"){
						if(!file_exists('icons/'. $snum . 'ab.png')){
							file_put_contents('icons/'. $snum . 'ab.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $snum . 'ab.png'));
						}
						echo "<br><img src='icons/". $snum . "ab.png' border=0>";
					} else {
						if(!file_exists('icons/'. $snum . $forme .'.png')){
							file_put_contents('icons/'. $snum . $forme .'.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $snum . $forme .'.png'));
						}
						echo "<br><img src='icons/". $snum . $forme . ".png' border=0>";
					}
				} else {
					if($forme === "Cosplay") {
						if(!file_exists('icons/'. $rare . $snum .'c.png')){
							file_put_contents('icons/'. $rare . $snum .'c.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $rare . $snum .'f.png'));
						}
						echo "<br><img src='icons/". $rare . $snum ."c.png' border=0>";
					} elseif($forme === "Original Cap") {
						if(!file_exists('icons/'. $rare . $snum .'c1.png')){
							file_put_contents('icons/'. $rare . $snum .'c1.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $rare . $snum .'g.png'));
						}
						echo "<br><img src='icons/". $rare . $snum ."c1.png' border=0>";
					} elseif($forme === "Kalos Cap") {
						if(!file_exists('icons/'. $rare . $snum .'c6.png')){
							file_put_contents('icons/'. $rare . $snum .'c6.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $rare . $snum .'k.png'));
						}
						echo "<br><img src='icons/". $rare . $snum ."c6.png' border=0>";
					} elseif($forme === "Attack") {
						if(!file_exists('icons/'. $snum .'a.png')){
							file_put_contents('icons/'. $snum .'a.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $snum .'a.png'));
						}
						echo "<br><img src='icons/". $snum ."a.png' border=0>";
					} elseif($forme === "Defense") {
						if(!file_exists('icons/'. $snum .'d.png')){
							file_put_contents('icons/'. $snum .'d.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $snum .'b.png'));
						}
						echo "<br><img src='icons/". $snum ."d.png' border=0>";
					} elseif($forme === "Speed") {
						if(!file_exists('icons/'. $snum .'s.png')){
							file_put_contents('icons/'. $snum .'s.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $snum .'c.png'));
						}
						echo "<br><img src='icons/". $snum ."s.png' border=0>";
					} elseif($forme === "West") {
						if(!file_exists('icons/'. $snum .'w.png')){
							file_put_contents('icons/'. $snum .'w.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $snum .'.png'));
						}
						echo "<br><img src='icons/". $snum ."w.png' border=0>";
					} elseif($forme === "East") {
						if(!file_exists('icons/'. $snum .'e.png')){
							file_put_contents('icons/'. $snum .'e.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $snum .'a.png'));
						}
						echo "<br><img src='icons/". $snum ."e.png' border=0>";
					}
					elseif($forme === "Altered") {
						if(!file_exists('icons/'. $snum .'a.png')){
							file_put_contents('icons/'. $snum .'a.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $snum .'.png'));
						}
						echo "<br><img src='icons/". $snum ."a.png' border=0>";
					} elseif($forme === "Origin") {
						if(!file_exists('icons/'. $snum .'o.png')){
							file_put_contents('icons/'. $snum .'o.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $snum .'a.png'));
						}
						echo "<br><img src='icons/". $snum ."o.png' border=0>";
					} elseif($forme === "Frost") {
						if(!file_exists('icons/'. $snum .'r.png')){
							file_put_contents('icons/'. $snum .'r.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $snum .'c.png'));
						}
						echo "<br><img src='icons/". $snum ."r.png' border=0>";
					} elseif($forme === "Fan") {
						if(!file_exists('icons/'. $snum .'f.png')){
							file_put_contents('icons/'. $snum .'f.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $snum .'d.png'));
						}
						echo "<br><img src='icons/". $snum ."f.png' border=0>";
					} elseif($forme === "Red Stripe") {
						if(!file_exists('icons/'. $snum .'r.png')){
							file_put_contents('icons/'. $snum .'r.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $snum .'.png'));
						}
						echo "<br><img src='icons/". $snum ."r.png' border=0>";
					} elseif($forme === "Blue Stripe") {
						if(!file_exists('icons/'. $snum .'b.png')){
							file_put_contents('icons/'. $snum .'b.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $snum .'a.png'));
						}
						echo "<br><img src='icons/". $snum ."b.png' border=0>";
					} elseif($forme === "Spring") {
						if(!file_exists('icons/'. $snum .'f.png')){
							file_put_contents('icons/'. $snum .'f.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $snum .'.png'));
						}
						echo "<br><img src='icons/". $snum ."f.png' border=0>";
					} elseif($forme === "Summer") {
						if(!file_exists('icons/'. $snum .'s.png')){
							file_put_contents('icons/'. $snum .'s.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $snum .'a.png'));
						}
						echo "<br><img src='icons/". $snum ."s.png' border=0>";
					} elseif($forme === "Autumn") {
						if(!file_exists('icons/'. $snum .'h.png')){
							file_put_contents('icons/'. $snum .'h.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $snum .'b.png'));
						}
						echo "<br><img src='icons/". $snum ."h.png' border=0>";
					} elseif($forme === "Winter") {
						if(!file_exists('icons/'. $snum .'w.png')){
							file_put_contents('icons/'. $snum .'w.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $snum .'c.png'));
						}
						echo "<br><img src='icons/". $snum ."w.png' border=0>";
					} elseif($forme === "Incarnate") {
						if(!file_exists('icons/'. $snum .'i.png')){
							file_put_contents('icons/'. $snum .'i.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $snum .'.png'));
						}
						echo "<br><img src='icons/". $snum ."i.png' border=0>";
					} elseif($forme === "Therian") {
						if(!file_exists('icons/'. $snum .'t.png')){
							file_put_contents('icons/'. $snum .'t.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $snum .'a.png'));
						}
						echo "<br><img src='icons/". $snum ."t.png' border=0>";
					} elseif($forme === "Red") {
						if(!file_exists('icons/'. $snum .'r.png')){
							file_put_contents('icons/'. $snum .'r.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $snum .'.png'));
						}
						echo "<br><img src='icons/". $snum ."r.png' border=0>";
					} elseif($forme === "Yellow") {
						if(!file_exists('icons/'. $snum .'y.png')){
							file_put_contents('icons/'. $snum .'y.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $snum .'a.png'));
						}
						echo "<br><img src='icons/". $snum ."y.png' border=0>";
					}
					elseif($forme === "Orange") {
						if(!file_exists('icons/'. $snum .'o.png')){
							file_put_contents('icons/'. $snum .'o.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $snum .'b.png'));
						}
						echo "<br><img src='icons/". $snum ."o.png' border=0>";
					}
					elseif($forme === "Blue") {
						if(!file_exists('icons/'. $snum .'b.png')){
							file_put_contents('icons/'. $snum .'b.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $snum .'c.png'));
						}
						echo "<br><img src='icons/". $snum ."b.png' border=0>";
					}
					elseif($forme === "White") {
						if(!file_exists('icons/'. $snum .'w.png')){
							file_put_contents('icons/'. $snum .'w.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $snum .'d.png'));
						}
						echo "<br><img src='icons/". $snum ."w.png' border=0>";
					} elseif($forme === "Alola") {
						if(!file_exists('icons/'. $snum .'al.png')){
							file_put_contents('icons/'. $snum .'al.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $snum .'a.png'));
						}
						echo "<br><img src='icons/". $snum ."al.png' border=0>";
					} elseif($forme === "Pom-Pom") {
						if(!file_exists('icons/'. $snum .'c.png')){
							file_put_contents('icons/'. $snum .'c.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $snum .'.png'));
						}
						echo "<br><img src='icons/". $snum ."c.png' border=0>";
					} elseif($forme === "Pa'u") {
						if(!file_exists('icons/'. $snum .'p.png')){
							file_put_contents('icons/'. $snum .'p.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $snum .'a.png'));
						}
						echo "<br><img src='icons/". $snum ."p.png' border=0>";
					} elseif($forme === "Midday") {
						if(!file_exists('icons/'. $snum .'d.png')){
							file_put_contents('icons/'. $snum .'d.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $snum .'.png'));
						}
						echo "<br><img src='icons/". $snum ."d.png' border=0>";
					} elseif($forme === "Midnight") {
						if(!file_exists('icons/'. $snum .'n.png')){
							file_put_contents('icons/'. $snum .'n.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $snum .'a.png'));
						}
						echo "<br><img src='icons/". $snum ."n.png' border=0>";
					} elseif($forme === "Dusk") {
						if(!file_exists('icons/'. $snum .'t.png')){
							file_put_contents('icons/'. $snum .'t.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $snum .'b.png'));
						}
						echo "<br><img src='icons/". $snum ."t.png' border=0>";
					} elseif($forme === "Blue Core") {
						if(!file_exists('icons/'. $snum .'b.png')){
							file_put_contents('icons/'. $snum .'b.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $snum .'e.png'));
						}
						echo "<br><img src='icons/". $snum ."b.png' border=0>";
					} elseif($forme === "Violet Core") {
						if(!file_exists('icons/'. $snum .'v.png')){
							file_put_contents('icons/'. $snum .'v.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $snum .'g.png'));
						}
						echo "<br><img src='icons/". $snum ."v.png' border=0>";
					} else {
						if(!file_exists('icons/'. $snum .'.png')){
							file_put_contents('icons/'. $snum .'.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $snum .'.png'));
						}
						echo "<br><img src='icons/". $snum .".png' border=0>";
					}
				}
		} else {
			if(!file_exists('icons/'. $snum .'.png')){
					file_put_contents('icons/'. $snum .'.png', file_get_contents('http://www.greenchu.de/sprites/icons/'. $snum .'.png'));
				}
				echo "<br><img src='icons/". $snum .".png' border=0>";
		}
	}
?>
Species: <input type="text" id="species" name="species" style="border:0px;background-color:#9EDA71;" size="12" onchange="turnText('species')" value="<?= $species ?>" />
Forme: <input type="text" id="forme" name="forme" style="border:0px;background-color:#9EDA71;" size="12" onchange="turnText('forme')" value="<?= $forme ?>" />
Shiny: <input type="text" id="shine" name="shine" style="border:0px;background-color:#9EDA71;" size="1" onchange="turnText('shine')" value="<?= $shine ?>" />
<span>
<?php

	if($snum != 0){
		$gname = substr($game, 0, strrpos($game, '[')-1);
		$rare = "";
		if($shine == "Y"){
			$rare = "rare/";
		}
		if($gname === "Red" or $gname === "Blue"){
			if(!file_exists('rb/'. $snum .'.png')){
				file_put_contents('rb/'. $snum .'.png', file_get_contents('http://www.greenchu.de/sprites/blau/'. $rare . $snum .'.png'));
			}
			echo "<br><img src='rb/". $snum .".png' border=0>";
		}
		elseif($gname === "Yellow"){
			if(!file_exists('yellow/'. $snum .'.png')){
				file_put_contents('yellow/'. $snum .'.png', file_get_contents('http://www.greenchu.de/sprites/gelb/'. $rare . $snum .'.png'));
			}
			echo "<br><img src='yellow/". $snum .".png' border=0>";
		}
		elseif($gname === "Gold"){
			if($species === "Unown"){	
				if(!file_exists('gold/'. $snum . $forme .'.png')){
					file_put_contents('gold/'. $snum . $forme .'.png', file_get_contents('http://www.greenchu.de/sprites/gold/'. $snum . $forme .'.png'));
				}
				echo "<br><img src='gold/". $snum . $forme . ".png' border=0>";
			} else {
				if(!file_exists('gold/'. $snum .'.png')){
					file_put_contents('gold/'. $snum .'.png', file_get_contents('http://www.greenchu.de/sprites/gold/'. $rare . $snum .'.png'));
				}
				echo "<br><img src='gold/". $snum .".png' border=0>";
			}
		}
		elseif($gname === "Silver"){
			if($species === "Unown"){	
				if(!file_exists('silver/'. $snum . $forme .'.png')){
					file_put_contents('silver/'. $snum . $forme .'.png', file_get_contents('http://www.greenchu.de/sprites/silber/'. $snum . $forme .'.png'));
				}
				echo "<br><img src='silver/". $snum . $forme . ".png' border=0>";
			}  else {
				if(!file_exists('silver/'. $snum .'.png')){
					file_put_contents('silver/'. $snum .'.png', file_get_contents('http://www.greenchu.de/sprites/silber/'. $rare . $snum .'.png'));
				}
				echo "<br><img src='silver/". $snum .".png' border=0>";
			}
		}
		elseif($gname === "Crystal"){
			if($species === "Unown"){	
				if(!file_exists('crystal/'. $snum . $forme .'.gif')){
					file_put_contents('crystal/'. $snum . $forme .'.png', file_get_contents('http://www.greenchu.de/sprites/crystal/'. $snum . $forme .'.gif'));
				}
				echo "<br><img src='crystal/". $snum . $forme . ".gif' border=0>";
			} else {
				if(!file_exists('crystal/'. $snum .'.gif')){
					file_put_contents('crystal/'. $snum .'.gif', file_get_contents('http://www.greenchu.de/sprites/crystal/'. $rare . $snum .'.gif'));
				}
				echo "<br><img src='crystal/". $snum .".gif' border=0>";
			}
		}
		elseif($gname === "Ruby" or $gname === "Sapphire"){
			if(!file_exists('rs/'. $rare . $snum .'.png')){
				file_put_contents('rs/'. $rare . $snum .'.png', file_get_contents('http://www.greenchu.de/sprites/rs/'. $rare . $snum .'.png'));
			}
			echo "<br><img src='rs/". $rare . $snum .".png' border=0>";
		}
		elseif($gname === "Emerald"){
			if(!file_exists('emerald/'. $rare . $snum .'.gif')){
				file_put_contents('emerald/'. $rare . $snum .'.gif', file_get_contents('http://www.greenchu.de/sprites/smaragd/'. $rare . $snum .'.gif'));
			}
			echo "<br><img src='emerald/". $rare . $snum .".gif' border=0>";
		}
		elseif($gname === "FireRed" or $gname === "LeafGreen"){
			if($snum > 151){
				if(!file_exists('rs/'. $rare . $snum .'.png')){
					file_put_contents('frlg/'. $rare . $snum .'.png', file_get_contents('http://www.greenchu.de/sprites/rs/'. $rare . $snum .'.png'));
				}
				echo "<br><img src='frlg/". $rare . $snum .".png' border=0>";
			} else {
				if(!file_exists('frlg/'. $rare . $snum .'.png')){
					file_put_contents('frlg/'. $rare . $snum .'.png', file_get_contents('http://www.greenchu.de/sprites/frbg/'. $rare . $snum .'.png'));
				}
				echo "<br><img src='frlg/". $rare . $snum .".png' border=0>";
			}
		}
		elseif($gname === "Colosseum"){
			if(!file_exists('colosseum/'. $rare . $snum .'.png')){
				file_put_contents('colosseum/'. $rare . $snum .'.png', file_get_contents('http://www.greenchu.de/sprites/colosseum/sprites/'. $rare . $snum .'.png'));
			}
			echo "<br><img src='colosseum/". $rare . $snum .".png' border=0>";
		}
		elseif($gname === "XD"){
			if(!file_exists('xd/'. $rare . $snum .'.gif')){
				file_put_contents('xd/'. $rare . $snum .'.gif', file_get_contents('http://www.greenchu.de/sprites/xd/'. $rare . $snum .'.gif'));
			}
			echo "<br><img src='xd/". $rare . $snum .".gif' border=0>";
		}
		elseif($gname === "Diamond" or $gname === "Pearl"){
			if($forme != ""){
				if($species === "Unown"){
					if($forme === "!"){
						if(!file_exists('dp/'. $rare . $snum . 'aa.png')){
							file_put_contents('dp/'. $rare . $snum . 'aa.png', file_get_contents('http://www.greenchu.de/sprites/hgss/'. $rare . $snum . 'aa.png'));
						}
						echo "<br><img src='dp/". $rare . $snum . "aa.png' border=0>";
					} elseif($forme === "?"){
						if(!file_exists('dp/'. $rare . $snum . 'ab.png')){
							file_put_contents('dp/'. $rare . $snum . 'ab.png', file_get_contents('http://www.greenchu.de/sprites/hgss/'. $rare . $snum . 'ab.png'));
						}
						echo "<br><img src='dp/". $rare . $snum . "ab.png' border=0>";
					} else {
						if(!file_exists('dp/'. $rare . $snum . $forme .'.png')){
							file_put_contents('dp/'. $rare . $snum . $forme .'.png', file_get_contents('http://www.greenchu.de/sprites/hgss/'. $rare . $snum . $forme .'.png'));
						}
						echo "<br><img src='dp/". $rare . $snum . $forme . ".png' border=0>";
					}
				} else {	
					if($forme === "F"){
						if(!file_exists('dp/'. $rare . $snum .'f.png')){
							file_put_contents('dp/'. $rare . $snum .'f.png', file_get_contents('http://www.greenchu.de/sprites/dp/w/1/'. $rare . $snum .'.png'));
						}
						echo "<br><img src='dp/". $rare . $snum ."f.png' border=0>";
					} elseif($forme === "M") {
						if(!file_exists('dp/'. $rare . $snum .'m.png')){
							file_put_contents('dp/'. $rare . $snum .'m.png', file_get_contents('http://www.greenchu.de/sprites/dp/m/1/'. $rare . $snum .'.png'));
						}
						echo "<br><img src='dp/". $rare . $snum ."m.png' border=0>";
					} elseif($forme === "Attack") {
						if(!file_exists('dp/'. $snum .'a.png')){
							file_put_contents('dp/'. $snum .'a.png', file_get_contents('http://www.greenchu.de/sprites/dp/'. $snum .'a.png'));
						}
						echo "<br><img src='dp/". $snum ."a.png' border=0>";
					} elseif($forme === "Defense") {
						if(!file_exists('icons/'. $snum .'d.png')){
							file_put_contents('icons/'. $snum .'d.png', file_get_contents('http://www.greenchu.de/sprites/dp/'. $snum .'b.png'));
						}
						echo "<br><img src='icons/". $snum ."d.png' border=0>";
					} elseif($forme === "Speed") {
						if(!file_exists('icons/'. $snum .'s.png')){
							file_put_contents('icons/'. $snum .'s.png', file_get_contents('http://www.greenchu.de/sprites/dp/'. $snum .'c.png'));
						}
						echo "<br><img src='icons/". $snum ."s.png' border=0>";
					} elseif($forme === "West") {
						if(!file_exists('dp/'. $rare . $snum .'w.png')){
							file_put_contents('dp/'. $rare . $snum .'w.png', file_get_contents('http://www.greenchu.de/sprites/dp/'. $rare . $snum .'.png'));
						}
						echo "<br><img src='dp/". $rare . $snum ."w.png' border=0>";
					} elseif($forme === "East") {
						if(!file_exists('dp/'. $rare . $snum .'e.png')){
							file_put_contents('dp/'. $rare . $snum .'e.png', file_get_contents('http://www.greenchu.de/sprites/dp/'. $rare . $snum .'a.png'));
						}
						echo "<br><img src='dp/". $rare . $snum ."e.png' border=0>";
					} else {
						if(!file_exists('dp/'. $rare . $snum .'.png')){
								file_put_contents('dp/'. $rare . $snum .'.png', file_get_contents('http://www.greenchu.de/sprites/dp/'. $rare . $snum .'.png'));
							}
							echo "<br><img src='dp/". $rare . $snum .".png' border=0>";
					}
			}
			} else {
				if(!file_exists('dp/'. $rare . $snum .'.png')){
						file_put_contents('dp/'. $rare . $snum .'.png', file_get_contents('http://www.greenchu.de/sprites/dp/'. $rare . $snum .'.png'));
					}
					echo "<br><img src='dp/". $rare . $snum .".png' border=0>";
			}
		}
		elseif($gname === "Platinum"){
			if($forme != ""){
				if($species === "Unown"){
					if($forme === "!"){
						if(!file_exists('platinum/'. $rare . $snum . 'aa.png')){
							file_put_contents('platinum/'. $rare . $snum . 'aa.png', file_get_contents('http://www.greenchu.de/sprites/hgss/'. $rare . $snum . 'aa.png'));
						}
						echo "<br><img src='platinum/". $rare . $snum . "aa.png' border=0>";
					} elseif($forme === "?"){
						if(!file_exists('platinum/'. $rare . $snum . 'ab.png')){
							file_put_contents('platinum/'. $rare . $snum . 'ab.png', file_get_contents('http://www.greenchu.de/sprites/hgss/'. $rare . $snum . 'ab.png'));
						}
						echo "<br><img src='platinum/". $rare . $snum . "ab.png' border=0>";
					} else {
						if(!file_exists('platinum/'. $rare . $snum . $forme .'.png')){
							file_put_contents('platinum/'. $rare . $snum . $forme .'.png', file_get_contents('http://www.greenchu.de/sprites/hgss/'. $rare . $snum . $forme .'.png'));
						}
						echo "<br><img src='platinum/". $rare . $snum . $forme . ".png' border=0>";
					}
				} else {
					if($forme === "F"){
						if(!file_exists('platinum/'. $rare . $snum .'f.png')){
							file_put_contents('platinum/'. $rare . $snum .'f.png', file_get_contents('http://www.greenchu.de/sprites/platin/w/1/'. $rare . $snum .'.png'));
						}
						echo "<br><img src='platinum/". $rare . $snum ."f.png' border=0>";
					} elseif($forme === "M") {
						if(!file_exists('platinum/'. $rare . $snum .'m.png')){
							file_put_contents('platinum/'. $rare . $snum .'m.png', file_get_contents('http://www.greenchu.de/sprites/platin/m/1/'. $rare . $snum .'.png'));
						}
						echo "<br><img src='platinum/". $rare . $snum ."m.png' border=0>";
					} elseif($forme === "Attack") {
						if(!file_exists('platinum/'. $snum .'a.png')){
							file_put_contents('platinum/'. $snum .'a.png', file_get_contents('http://www.greenchu.de/sprites/platin/'. $snum .'a.png'));
						}
						echo "<br><img src='platinum/". $snum ."a.png' border=0>";
					} elseif($forme === "Defense") {
						if(!file_exists('platinum/'. $snum .'d.png')){
							file_put_contents('platinum/'. $snum .'d.png', file_get_contents('http://www.greenchu.de/sprites/platin/'. $snum .'b.png'));
						}
						echo "<br><img src='platinum/". $snum ."d.png' border=0>";
					} elseif($forme === "Speed") {
						if(!file_exists('platinum/'. $snum .'s.png')){
							file_put_contents('platinum/'. $snum .'s.png', file_get_contents('http://www.greenchu.de/sprites/platin/'. $snum .'c.png'));
						}
						echo "<br><img src='platinum/". $snum ."s.png' border=0>";
					} elseif($forme === "West") {
						if(!file_exists('platinum/'. $rare . $snum .'w.png')){
							file_put_contents('platinum/'. $rare . $snum .'w.png', file_get_contents('http://www.greenchu.de/sprites/platin/'. $rare . $snum .'.png'));
						}
						echo "<br><img src='platinum/". $rare . $snum ."w.png' border=0>";
					} elseif($forme === "East") {
						if(!file_exists('platinum/'. $rare . $snum .'e.png')){
							file_put_contents('platinum/'. $rare . $snum .'e.png', file_get_contents('http://www.greenchu.de/sprites/platin/'. $rare . $snum .'a.png'));
						}
						echo "<br><img src='platinum/". $rare . $snum ."e.png' border=0>";
					}
					elseif($forme === "Altered") {
						if(!file_exists('platinum/'. $rare . $snum .'a.png')){
							file_put_contents('platinum/'. $rare . $snum .'a.png', file_get_contents('http://www.greenchu.de/sprites/platin/'. $rare . $snum .'.png'));
						}
						echo "<br><img src='platinum/". $rare . $snum ."a.png' border=0>";
					} elseif($forme === "Origin") {
						if(!file_exists('platinum/'. $rare . $snum .'o.png')){
							file_put_contents('platinum/'. $rare . $snum .'o.png', file_get_contents('http://www.greenchu.de/sprites/platin/'. $rare . $snum .'a.png'));
						}
						echo "<br><img src='platinum/". $rare . $snum ."o.png' border=0>";
					} elseif($forme === "Frost") {
						if(!file_exists('platinum/'. $snum .'r.png')){
							file_put_contents('platinum/'. $snum .'r.png', file_get_contents('http://www.greenchu.de/sprites/platin/'. $snum .'c.png'));
						}
						echo "<br><img src='platinum/". $snum ."r.png' border=0>";
					} elseif($forme === "Fan") {
						if(!file_exists('platinum/'. $snum .'f.png')){
							file_put_contents('platinum/'. $snum .'f.png', file_get_contents('http://www.greenchu.de/sprites/platin/'. $snum .'d.png'));
						}
						echo "<br><img src='platinum/". $snum ."f.png' border=0>";
					} else {
						if(!file_exists('platinum/'. $rare . $snum .'.png')){
								file_put_contents('platinum/'. $rare . $snum .'.png', file_get_contents('http://www.greenchu.de/sprites/platin/'. $rare . $snum .'.png'));
							}
							echo "<br><img src='platinum/". $rare . $snum .".png' border=0>";
					}
				}
			} else {
				if(!file_exists('platinum/'. $rare . $snum .'.png')){
						file_put_contents('platinum/'. $rare . $snum .'.png', file_get_contents('http://www.greenchu.de/sprites/platin/'. $rare . $snum .'.png'));
					}
					echo "<br><img src='platinum/". $rare . $snum .".png' border=0>";
			}
		}
		elseif($gname === "HeartGold" or $gname === "SoulSilver"){
			if($forme != ""){
				if($species === "Unown"){
					if($forme === "!"){
						if(!file_exists('hgss/'. $rare . $snum . 'aa.png')){
							file_put_contents('hgss/'. $rare . $snum . 'aa.png', file_get_contents('http://www.greenchu.de/sprites/hgss/'. $rare . $snum . 'aa.png'));
						}
						echo "<br><img src='hgss/". $rare . $snum . "aa.png' border=0>";
					} elseif($forme === "?"){
						if(!file_exists('hgss/'. $rare . $snum . 'ab.png')){
							file_put_contents('hgss/'. $rare . $snum . 'ab.png', file_get_contents('http://www.greenchu.de/sprites/hgss/'. $rare . $snum . 'ab.png'));
						}
						echo "<br><img src='hgss/". $rare . $snum . "ab.png' border=0>";
					} else {
						if(!file_exists('hgss/'. $rare . $snum . $forme .'.png')){
							file_put_contents('hgss/'. $rare . $snum . $forme .'.png', file_get_contents('http://www.greenchu.de/sprites/hgss/'. $rare . $snum . $forme .'.png'));
						}
						echo "<br><img src='hgss/". $rare . $snum . $forme . ".png' border=0>";
					}
				} else {	
					if($forme === "F"){
						if(!file_exists('hgss/'. $rare . $snum .'f.png')){
							file_put_contents('hgss/'. $rare . $snum .'f.png', file_get_contents('http://www.greenchu.de/sprites/hgss/w/1/'. $rare . $snum .'.png'));
						}
						echo "<br><img src='hgss/". $rare . $snum ."f.png' border=0>";
					} elseif($forme === "M") {
						if(!file_exists('hgss/'. $rare . $snum .'m.png')){
							file_put_contents('hgss/'. $rare . $snum .'m.png', file_get_contents('http://www.greenchu.de/sprites/hgss/m/1/'. $rare . $snum .'.png'));
						}
						echo "<br><img src='hgss/". $rare . $snum ."m.png' border=0>";
					} elseif($forme === "Spiky-Eared") {
						if(!file_exists('hgss/'. $snum .'se.png')){
							file_put_contents('hgss/'. $snum .'se.png', file_get_contents('http://www.greenchu.de/sprites/hgss/'. $snum .'a.png'));
						}
						echo "<br><img src='hgss/". $snum ."se.png' border=0>";
					} elseif($forme === "Attack") {
						if(!file_exists('hgss/'. $snum .'a.png')){
							file_put_contents('hgss/'. $snum .'a.png', file_get_contents('http://www.greenchu.de/sprites/hgss/'. $snum .'a.png'));
						}
						echo "<br><img src='hgss/". $snum ."a.png' border=0>";
					} elseif($forme === "Defense") {
						if(!file_exists('hgss/'. $snum .'d.png')){
							file_put_contents('hgss/'. $snum .'d.png', file_get_contents('http://www.greenchu.de/sprites/hgss/'. $snum .'b.png'));
						}
						echo "<br><img src='hgss/". $snum ."d.png' border=0>";
					} elseif($forme === "Speed") {
						if(!file_exists('hgss/'. $snum .'s.png')){
							file_put_contents('hgss/'. $snum .'s.png', file_get_contents('http://www.greenchu.de/sprites/hgss/'. $snum .'c.png'));
						}
						echo "<br><img src='hgss/". $snum ."s.png' border=0>";
					}elseif($forme === "West") {
						if(!file_exists('hgss/'. $rare . $snum .'w.png')){
							file_put_contents('hgss/'. $rare . $snum .'w.png', file_get_contents('http://www.greenchu.de/sprites/hgss/'. $rare . $snum .'.png'));
						}
						echo "<br><img src='hgss/". $rare . $snum ."w.png' border=0>";
					} elseif($forme === "East") {
						if(!file_exists('hgss/'. $rare . $snum .'e.png')){
							file_put_contents('hgss/'. $rare . $snum .'e.png', file_get_contents('http://www.greenchu.de/sprites/hgss/'. $rare . $snum .'a.png'));
						}
						echo "<br><img src='hgss/". $rare . $snum ."e.png' border=0>";
					}
					elseif($forme === "Altered") {
						if(!file_exists('hgss/'. $rare . $snum .'a.png')){
							file_put_contents('hgss/'. $rare . $snum .'a.png', file_get_contents('http://www.greenchu.de/sprites/hgss/'. $rare . $snum .'.png'));
						}
						echo "<br><img src='hgss/". $rare . $snum ."a.png' border=0>";
					} elseif($forme === "Origin") {
						if(!file_exists('hgss/'. $rare . $snum .'o.png')){
							file_put_contents('hgss/'. $rare . $snum .'o.png', file_get_contents('http://www.greenchu.de/sprites/hgss/'. $rare . $snum .'a.png'));
						}
						echo "<br><img src='hgss/". $rare . $snum ."o.png' border=0>";
					} elseif($forme === "Frost") {
						if(!file_exists('hgss/'. $snum .'r.png')){
							file_put_contents('hgss/'. $snum .'r.png', file_get_contents('http://www.greenchu.de/sprites/hgss/'. $snum .'c.png'));
						}
						echo "<br><img src='hgss/". $snum ."r.png' border=0>";
					} elseif($forme === "Fan") {
						if(!file_exists('hgss/'. $snum .'f.png')){
							file_put_contents('hgss/'. $snum .'f.png', file_get_contents('http://www.greenchu.de/sprites/hgss/'. $snum .'d.png'));
						}
						echo "<br><img src='hgss/". $snum ."f.png' border=0>";
					} else {
						if(!file_exists('hgss/'. $rare . $snum .'.png')){
								file_put_contents('hgss/'. $rare . $snum .'.png', file_get_contents('http://www.greenchu.de/sprites/hgss/'. $rare . $snum .'.png'));
							}
							echo "<br><img src='hgss/". $rare . $snum .".png' border=0>";
					}
			}
			} else {
				if(!file_exists('hgss/'. $rare . $snum .'.png')){
						file_put_contents('hgss/'. $rare . $snum .'.png', file_get_contents('http://www.greenchu.de/sprites/hgss/'. $rare . $snum .'.png'));
					}
					echo "<br><img src='hgss/". $rare . $snum .".png' border=0>";
			}
		}
		elseif($gname === "Black" or $gname === "White"){
			if($forme != ""){
				if($species === "Unown"){
					if($forme === "!"){
						if(!file_exists('bw/'. $rare . $snum . 'aa.gif')){
							file_put_contents('bw/'. $rare . $snum . 'aa.gif', file_get_contents('http://www.greenchu.de/sprites/bw/'. $rare . $snum . 'aa.gif'));
						}
						echo "<br><img src='bw/". $rare . $snum . "aa.gif' border=0>";
					} elseif($forme === "?"){
						if(!file_exists('bw/'. $rare . $snum . 'ab.gif')){
							file_put_contents('bw/'. $rare . $snum . 'ab.gif', file_get_contents('http://www.greenchu.de/sprites/bw/'. $rare . $snum . 'ab.gif'));
						}
						echo "<br><img src='bw/". $rare . $snum . "ab.gif' border=0>";
					} else {
						if(!file_exists('bw/'. $rare . $snum . $forme .'.gif')){
							file_put_contents('bw/'. $rare . $snum . $forme .'.gif', file_get_contents('http://www.greenchu.de/sprites/bw/'. $rare . $snum . $forme .'.gif'));
						}
						echo "<br><img src='bw/". $rare . $snum . $forme . ".gif' border=0>";
					}
				} else {
					if($forme === "F"){
						if(!file_exists('bw/'. $rare . $snum .'f.gif')){
							file_put_contents('bw/'. $rare . $snum .'f.gif', file_get_contents('http://www.greenchu.de/sprites/bw/w/'. $rare . $snum .'.gif'));
						}
						echo "<br><img src='bw/". $rare . $snum ."f.gif' border=0>";
					} elseif($forme === "M") {
						if(!file_exists('bw/'. $rare . $snum .'m.gif')){
							file_put_contents('bw/'. $rare . $snum .'m.gif', file_get_contents('http://www.greenchu.de/sprites/bw/'. $rare . $snum .'.gif'));
						}
						echo "<br><img src='bw/". $rare . $snum ."m.gif' border=0>";
					} elseif($forme === "Attack") {
						if(!file_exists('bw/'. $snum .'a.gif')){
							file_put_contents('bw/'. $snum .'a.gif', file_get_contents('http://www.greenchu.de/sprites/bw/'. $snum .'a.gif'));
						}
						echo "<br><img src='bw/". $snum ."a.gif' border=0>";
					} elseif($forme === "Defense") {
						if(!file_exists('bw/'. $snum .'d.gif')){
							file_put_contents('bw/'. $snum .'d.gif', file_get_contents('http://www.greenchu.de/sprites/bw/'. $snum .'b.gif'));
						}
						echo "<br><img src='bw/". $snum ."d.gif' border=0>";
					} elseif($forme === "Speed") {
						if(!file_exists('bw/'. $snum .'s.gif')){
							file_put_contents('bw/'. $snum .'s.gif', file_get_contents('http://www.greenchu.de/sprites/bw/'. $snum .'c.gif'));
						}
						echo "<br><img src='bw/". $snum ."s.gif' border=0>";
					} elseif($forme === "West") {
						if(!file_exists('bw/'. $rare . $snum .'w.gif')){
							file_put_contents('bw/'. $rare . $snum .'w.gif', file_get_contents('http://www.greenchu.de/sprites/bw/'. $rare . $snum .'.gif'));
						}
						echo "<br><img src='bw/". $rare . $snum ."w.gif' border=0>";
					} elseif($forme === "East") {
						if(!file_exists('bw/'. $rare . $snum .'e.gif')){
							file_put_contents('bw/'. $rare . $snum .'e.gif', file_get_contents('http://www.greenchu.de/sprites/bw/'. $rare . $snum .'a.gif'));
						}
						echo "<br><img src='bw/". $rare . $snum ."e.gif' border=0>";
					}
					elseif($forme === "Altered") {
						if(!file_exists('bw/'. $rare . $snum .'a.gif')){
							file_put_contents('bw/'. $rare . $snum .'a.gif', file_get_contents('http://www.greenchu.de/sprites/bw/'. $rare . $snum .'.gif'));
						}
						echo "<br><img src='bw/". $rare . $snum ."a.gif' border=0>";
					} elseif($forme === "Origin") {
						if(!file_exists('bw/'. $rare . $snum .'o.gif')){
							file_put_contents('bw/'. $rare . $snum .'o.gif', file_get_contents('http://www.greenchu.de/sprites/bw/'. $rare . $snum .'a.gif'));
						}
						echo "<br><img src='bw/". $rare . $snum ."o.gif' border=0>";
					} elseif($forme === "Frost") {
						if(!file_exists('bw/'. $snum .'r.gif')){
							file_put_contents('bw/'. $snum .'r.gif', file_get_contents('http://www.greenchu.de/sprites/bw/'. $snum .'c.gif'));
						}
						echo "<br><img src='bw/". $snum ."r.gif' border=0>";
					} elseif($forme === "Fan") {
						if(!file_exists('bw/'. $snum .'f.gif')){
							file_put_contents('bw/'. $snum .'f.gif', file_get_contents('http://www.greenchu.de/sprites/bw/'. $snum .'d.gif'));
						}
						echo "<br><img src='bw/". $snum ."f.gif' border=0>";
					} elseif($forme === "Red Stripe") {
						if(!file_exists('bw/'. $rare . $snum .'r.gif')){
							file_put_contents('bw/'. $rare . $snum .'r.gif', file_get_contents('http://www.greenchu.de/sprites/bw/'. $rare . $snum .'.gif'));
						}
						echo "<br><img src='bw/". $rare . $snum ."r.gif' border=0>";
					} elseif($forme === "Blue Stripe") {
						if(!file_exists('bw/'. $rare . $snum .'b.gif')){
							file_put_contents('bw/'. $rare . $snum .'b.gif', file_get_contents('http://www.greenchu.de/sprites/bw/'. $rare . $snum .'a.gif'));
						}
						echo "<br><img src='bw/". $rare . $snum ."b.gif' border=0>";
					} elseif($forme === "Spring") {
						if(!file_exists('bw/'. $snum .'f.gif')){
							file_put_contents('bw/'. $snum .'f.gif', file_get_contents('http://www.greenchu.de/sprites/bw/'. $snum .'.gif'));
						}
						echo "<br><img src='bw/". $snum ."f.gif' border=0>";
					} elseif($forme === "Summer") {
						if(!file_exists('bw/'. $snum .'s.gif')){
							file_put_contents('bw/'. $snum .'s.gif', file_get_contents('http://www.greenchu.de/sprites/bw/'. $snum .'a.gif'));
						}
						echo "<br><img src='bw/". $snum ."s.gif' border=0>";
					} elseif($forme === "Autumn") {
						if(!file_exists('bw/'. $snum .'h.gif')){
							file_put_contents('bw/'. $snum .'h.gif', file_get_contents('http://www.greenchu.de/sprites/bw/'. $snum .'b.gif'));
						}
						echo "<br><img src='bw/". $snum ."h.gif' border=0>";
					} elseif($forme === "Winter") {
						if(!file_exists('bw/'. $snum .'w.gif')){
							file_put_contents('bw/'. $snum .'w.gif', file_get_contents('http://www.greenchu.de/sprites/bw/'. $snum .'c.gif'));
						}
						echo "<br><img src='bw/". $snum ."w.gif' border=0>";
					} else {
						if(!file_exists('bw/'. $rare . $snum .'.gif')){
							file_put_contents('bw/'. $rare . $snum .'.gif', file_get_contents('http://www.greenchu.de/sprites/bw/'. $rare . $snum .'.gif'));
						}
						echo "<br><img src='bw/". $rare . $snum .".gif' border=0>";
					}
				}
			} else {
				if(!file_exists('bw/'. $rare . $snum .'.gif')){
						file_put_contents('bw/'. $rare . $snum .'.gif', file_get_contents('http://www.greenchu.de/sprites/bw/'. $rare . $snum .'.gif'));
					}
					echo "<br><img src='bw/". $rare . $snum .".gif' border=0>";
			}
		}
		elseif($gname === "Black 2" or $gname === "White 2"){
			if($forme != ""){
				if($species === "Unown"){
					if($forme === "!"){
						if(!file_exists('b2w2/'. $rare . $snum . 'aa.gif')){
							file_put_contents('b2w2/'. $rare . $snum . 'aa.gif', file_get_contents('http://www.greenchu.de/sprites/b2w2/'. $rare . $snum . 'aa.gif'));
						}
						echo "<br><img src='b2w2/". $rare . $snum . "aa.gif' border=0>";
					} elseif($forme === "?"){
						if(!file_exists('b2w2/'. $rare . $snum . 'ab.gif')){
							file_put_contents('b2w2/'. $rare . $snum . 'ab.gif', file_get_contents('http://www.greenchu.de/sprites/b2w2/'. $rare . $snum . 'ab.gif'));
						}
						echo "<br><img src='b2w2/". $rare . $snum . "ab.gif' border=0>";
					} else {
						if(!file_exists('b2w2/'. $rare . $snum . $forme .'.gif')){
							file_put_contents('b2w2/'. $rare . $snum . $forme .'.gif', file_get_contents('http://www.greenchu.de/sprites/b2w2/'. $rare . $snum . $forme .'.gif'));
						}
						echo "<br><img src='b2w2/". $rare . $snum . $forme . ".gif' border=0>";
					}
				} else {
					if($forme === "F"){
						if(!file_exists('b2w2/'. $rare . $snum .'f.gif')){
							file_put_contents('b2w2/'. $rare . $snum .'f.gif', file_get_contents('http://www.greenchu.de/sprites/b2w2/w/'. $rare . $snum .'.gif'));
						}
						echo "<br><img src='b2w2/". $rare . $snum ."f.gif' border=0>";
					} elseif($forme === "M") {
						if(!file_exists('b2w2/'. $rare . $snum .'m.gif')){
							file_put_contents('b2w2/'. $rare . $snum .'m.gif', file_get_contents('http://www.greenchu.de/sprites/b2w2/'. $rare . $snum .'.gif'));
						}
						echo "<br><img src='b2w2/". $rare . $snum ."m.gif' border=0>";
					} elseif($forme === "Attack") {
						if(!file_exists('b2w2/'. $snum .'a.gif')){
							file_put_contents('b2w2/'. $snum .'a.gif', file_get_contents('http://www.greenchu.de/sprites/b2w2/'. $snum .'a.gif'));
						}
						echo "<br><img src='b2w2/". $snum ."a.gif' border=0>";
					} elseif($forme === "Defense") {
						if(!file_exists('b2w2/'. $snum .'d.gif')){
							file_put_contents('b2w2/'. $snum .'d.gif', file_get_contents('http://www.greenchu.de/sprites/b2w2/'. $snum .'b.gif'));
						}
						echo "<br><img src='b2w2/". $snum ."d.gif' border=0>";
					} elseif($forme === "Speed") {
						if(!file_exists('b2w2/'. $snum .'s.gif')){
							file_put_contents('b2w2/'. $snum .'s.gif', file_get_contents('http://www.greenchu.de/sprites/b2w2/'. $snum .'c.gif'));
						}
						echo "<br><img src='b2w2/". $snum ."s.gif' border=0>";
					} elseif($forme === "West") {
						if(!file_exists('b2w2/'. $rare . $snum .'w.gif')){
							file_put_contents('b2w2/'. $rare . $snum .'w.gif', file_get_contents('http://www.greenchu.de/sprites/b2w2/'. $rare . $snum .'.gif'));
						}
						echo "<br><img src='b2w2/". $rare . $snum ."w.gif' border=0>";
					} elseif($forme === "East") {
						if(!file_exists('b2w2/'. $rare . $snum .'e.gif')){
							file_put_contents('b2w2/'. $rare . $snum .'e.gif', file_get_contents('http://www.greenchu.de/sprites/b2w2/'. $rare . $snum .'a.gif'));
						}
						echo "<br><img src='b2w2/". $rare . $snum ."e.gif' border=0>";
					}
					elseif($forme === "Altered") {
						if(!file_exists('b2w2/'. $rare . $snum .'a.gif')){
							file_put_contents('b2w2/'. $rare . $snum .'a.gif', file_get_contents('http://www.greenchu.de/sprites/b2w2/'. $rare . $snum .'.gif'));
						}
						echo "<br><img src='b2w2/". $rare . $snum ."a.gif' border=0>";
					} elseif($forme === "Origin") {
						if(!file_exists('b2w2/'. $rare . $snum .'o.gif')){
							file_put_contents('b2w2/'. $rare . $snum .'o.gif', file_get_contents('http://www.greenchu.de/sprites/b2w2/'. $rare . $snum .'a.gif'));
						}
						echo "<br><img src='b2w2/". $rare . $snum ."o.gif' border=0>";
					} elseif($forme === "Frost") {
						if(!file_exists('b2w2/'. $snum .'r.gif')){
							file_put_contents('b2w2/'. $snum .'r.gif', file_get_contents('http://www.greenchu.de/sprites/b2w2/'. $snum .'c.gif'));
						}
						echo "<br><img src='b2w2/". $snum ."r.gif' border=0>";
					} elseif($forme === "Fan") {
						if(!file_exists('b2w2/'. $snum .'f.gif')){
							file_put_contents('b2w2/'. $snum .'f.gif', file_get_contents('http://www.greenchu.de/sprites/b2w2/'. $snum .'d.gif'));
						}
						echo "<br><img src='b2w2/". $snum ."f.gif' border=0>";
					} elseif($forme === "Red Stripe") {
						if(!file_exists('b2w2/'. $rare . $snum .'r.gif')){
							file_put_contents('b2w2/'. $rare . $snum .'r.gif', file_get_contents('http://www.greenchu.de/sprites/b2w2/'. $rare . $snum .'.gif'));
						}
						echo "<br><img src='b2w2/". $rare . $snum ."r.gif' border=0>";
					} elseif($forme === "Blue Stripe") {
						if(!file_exists('b2w2/'. $rare . $snum .'b.gif')){
							file_put_contents('b2w2/'. $rare . $snum .'b.gif', file_get_contents('http://www.greenchu.de/sprites/b2w2/'. $rare . $snum .'a.gif'));
						}
						echo "<br><img src='b2w2/". $rare . $snum ."b.gif' border=0>";
					} elseif($forme === "Spring") {
						if(!file_exists('b2w2/'. $snum .'f.gif')){
							file_put_contents('b2w2/'. $snum .'f.gif', file_get_contents('http://www.greenchu.de/sprites/b2w2/'. $snum .'.gif'));
						}
						echo "<br><img src='b2w2/". $snum ."f.gif' border=0>";
					} elseif($forme === "Summer") {
						if(!file_exists('b2w2/'. $snum .'s.gif')){
							file_put_contents('b2w2/'. $snum .'s.gif', file_get_contents('http://www.greenchu.de/sprites/b2w2/'. $snum .'a.gif'));
						}
						echo "<br><img src='b2w2/". $snum ."s.gif' border=0>";
					} elseif($forme === "Autumn") {
						if(!file_exists('b2w2/'. $snum .'h.gif')){
							file_put_contents('b2w2/'. $snum .'h.gif', file_get_contents('http://www.greenchu.de/sprites/b2w2/'. $snum .'b.gif'));
						}
						echo "<br><img src='b2w2/". $snum ."h.gif' border=0>";
					} elseif($forme === "Winter") {
						if(!file_exists('b2w2/'. $snum .'w.gif')){
							file_put_contents('b2w2/'. $snum .'w.gif', file_get_contents('http://www.greenchu.de/sprites/b2w2/'. $snum .'c.gif'));
						}
						echo "<br><img src='b2w2/". $snum ."w.gif' border=0>";
					} elseif($forme === "Incarnate") {
						if(!file_exists('b2w2/'. $rare . $snum .'i.gif')){
							file_put_contents('b2w2/'. $rare . $snum .'i.gif', file_get_contents('http://www.greenchu.de/sprites/b2w2/'. $rare . $snum .'.gif'));
						}
						echo "<br><img src='b2w2/". $rare . $snum ."i.gif' border=0>";
					} elseif($forme === "Therian") {
						if(!file_exists('b2w2/'. $rare . $snum .'t.gif')){
							file_put_contents('b2w2/'. $rare . $snum .'t.gif', file_get_contents('http://www.greenchu.de/sprites/b2w2/'. $rare . $snum .'a.gif'));
						}
						echo "<br><img src='b2w2/". $rare . $snum ."t.gif' border=0>";
				} else {
						if(!file_exists('b2w2/'. $rare . $snum .'.gif')){
							file_put_contents('b2w2/'. $rare . $snum .'.gif', file_get_contents('http://www.greenchu.de/sprites/b2w2/'. $rare . $snum .'.gif'));
						}
						echo "<br><img src='b2w2/". $rare . $snum .".gif' border=0>";
					}
				}
			} else {
				if(!file_exists('b2w2/'. $rare . $snum .'.gif')){
						file_put_contents('b2w2/'. $rare . $snum .'.gif', file_get_contents('http://www.greenchu.de/sprites/b2w2/'. $rare . $snum .'.gif'));
					}
					echo "<br><img src='b2w2/". $rare . $snum .".gif' border=0>";
			}
		}
		elseif($gname === "X" or $gname === "Y" or $gname === "Omega Ruby" or $gname === "Alpha Sapphire"){
			if($forme != ""){
				if($species === "Unown"){
					if($forme === "!"){
						if(!file_exists('xy/'. $rare . $snum . 'aa.gif')){
							file_put_contents('xy/'. $rare . $snum . 'aa.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum . 'aa.gif'));
						}
						echo "<br><img src='xy/". $rare . $snum . "aa.gif' border=0>";
					} elseif($forme === "?"){
						if(!file_exists('xy/'. $rare . $snum . 'ab.gif')){
							file_put_contents('xy/'. $rare . $snum . 'ab.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum . 'ab.gif'));
						}
						echo "<br><img src='xy/". $rare . $snum . "ab.gif' border=0>";
					} else {
						if(!file_exists('xy/'. $rare . $snum . $forme .'.gif')){
							file_put_contents('xy/'. $rare . $snum . $forme .'.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum . $forme .'.gif'));
						}
						echo "<br><img src='xy/". $rare . $snum . $forme . ".gif' border=0>";
					}
				} else {
				if($forme === "F"){
					if(!file_exists('xy/'. $rare . $snum .'f.gif')){
						file_put_contents('xy/'. $rare . $snum .'f.gif', file_get_contents('http://www.greenchu.de/sprites/xy/w/'. $rare . $snum .'.gif'));
					}
					echo "<br><img src='xy/". $rare . $snum ."f.gif' border=0>";
				} elseif($forme === "M") {
					if(!file_exists('xy/'. $rare . $snum .'m.gif')){
						file_put_contents('xy/'. $rare . $snum .'m.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum .'.gif'));
					}
					echo "<br><img src='xy/". $rare . $snum ."m.gif' border=0>";
				} elseif($forme === "Cosplay") {
					if(!file_exists('xy/'. $snum .'c.gif')){
						file_put_contents('xy/'. $snum .'c.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $snum .'f.gif'));
					}
					echo "<br><img src='xy/". $snum ."c.gif' border=0>";
				} elseif($forme === "Attack") {
					if(!file_exists('xy/'. $snum .'a.gif')){
						file_put_contents('xy/'. $snum .'a.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $snum .'a.gif'));
					}
					echo "<br><img src='xy/". $snum ."a.gif' border=0>";
				} elseif($forme === "Defense") {
					if(!file_exists('xy/'. $snum .'d.gif')){
						file_put_contents('xy/'. $snum .'d.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $snum .'b.gif'));
					}
					echo "<br><img src='xy/". $snum ."d.gif' border=0>";
				} elseif($forme === "Speed") {
					if(!file_exists('xy/'. $snum .'s.gif')){
						file_put_contents('xy/'. $snum .'s.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $snum .'c.gif'));
					}
					echo "<br><img src='xy/". $snum ."s.gif' border=0>";
				} elseif($forme === "West") {
					if(!file_exists('xy/'. $rare . $snum .'w.gif')){
						file_put_contents('xy/'. $rare . $snum .'w.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum .'.gif'));
					}
					echo "<br><img src='xy/". $rare . $snum ."w.gif' border=0>";
				} elseif($forme === "East") {
					if(!file_exists('xy/'. $rare . $snum .'e.gif')){
						file_put_contents('xy/'. $rare . $snum .'e.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum .'a.gif'));
					}
					echo "<br><img src='xy/". $rare . $snum ."e.gif' border=0>";
				}
				elseif($forme === "Altered") {
					if(!file_exists('xy/'. $rare . $snum .'a.gif')){
						file_put_contents('xy/'. $rare . $snum .'a.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum .'.gif'));
					}
					echo "<br><img src='xy/". $rare . $snum ."a.gif' border=0>";
				} elseif($forme === "Origin") {
					if(!file_exists('xy/'. $rare . $snum .'o.gif')){
						file_put_contents('xy/'. $rare . $snum .'o.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum .'a.gif'));
					}
					echo "<br><img src='xy/". $rare . $snum ."o.gif' border=0>";
				} elseif($forme === "Frost") {
					if(!file_exists('xy/'. $snum .'r.gif')){
						file_put_contents('xy/'. $snum .'r.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $snum .'c.gif'));
					}
					echo "<br><img src='xy/". $snum ."r.gif' border=0>";
				} elseif($forme === "Fan") {
					if(!file_exists('xy/'. $snum .'f.gif')){
						file_put_contents('xy/'. $snum .'f.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $snum .'d.gif'));
					}
					echo "<br><img src='xy/". $snum ."f.gif' border=0>";
				} elseif($forme === "Red Stripe") {
					if(!file_exists('xy/'. $rare . $snum .'r.gif')){
						file_put_contents('xy/'. $rare . $snum .'r.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum .'.gif'));
					}
					echo "<br><img src='xy/". $rare . $snum ."r.gif' border=0>";
				} elseif($forme === "Blue Stripe") {
					if(!file_exists('xy/'. $rare . $snum .'b.gif')){
						file_put_contents('xy/'. $rare . $snum .'b.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum .'a.gif'));
					}
					echo "<br><img src='xy/". $rare . $snum ."b.gif' border=0>";
				} elseif($forme === "Spring") {
					if(!file_exists('xy/'. $snum .'f.gif')){
						file_put_contents('xy/'. $snum .'f.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $snum .'.gif'));
					}
					echo "<br><img src='xy/". $snum ."f.gif' border=0>";
				} elseif($forme === "Summer") {
					if(!file_exists('xy/'. $snum .'s.gif')){
						file_put_contents('xy/'. $snum .'s.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $snum .'a.gif'));
					}
					echo "<br><img src='xy/". $snum ."s.gif' border=0>";
				} elseif($forme === "Autumn") {
					if(!file_exists('xy/'. $snum .'h.gif')){
						file_put_contents('xy/'. $snum .'h.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $snum .'b.gif'));
					}
					echo "<br><img src='xy/". $snum ."h.gif' border=0>";
				} elseif($forme === "Winter") {
					if(!file_exists('xy/'. $snum .'w.gif')){
						file_put_contents('xy/'. $snum .'w.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $snum .'c.gif'));
					}
					echo "<br><img src='xy/". $snum ."w.gif' border=0>";
				} elseif($forme === "Incarnate") {
					if(!file_exists('xy/'. $rare . $snum .'i.gif')){
						file_put_contents('xy/'. $rare . $snum .'i.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum .'.gif'));
					}
					echo "<br><img src='xy/". $rare . $snum ."i.gif' border=0>";
				} elseif($forme === "Therian") {
					if(!file_exists('xy/'. $rare . $snum .'t.gif')){
						file_put_contents('xy/'. $rare . $snum .'t.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum .'a.gif'));
					}
					echo "<br><img src='xy/". $rare . $snum ."t.gif' border=0>";
				} elseif($forme === "Red") {
					if(!file_exists('xy/'. $rare . $snum .'r.gif')){
						file_put_contents('xy/'. $rare . $snum .'r.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum .'.gif'));
					}
					echo "<br><img src='xy/". $rare . $snum ."r.gif' border=0>";
				} elseif($forme === "Yellow") {
					if(!file_exists('xy/'. $rare . $snum .'y.gif')){
						file_put_contents('xy/'. $rare . $snum .'y.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum .'a.gif'));
					}
					echo "<br><img src='xy/". $rare . $snum ."y.gif' border=0>";
				}
				elseif($forme === "Orange") {
					if(!file_exists('xy/'. $rare . $snum .'o.gif')){
						file_put_contents('xy/'. $rare . $snum .'o.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum .'b.gif'));
					}
					echo "<br><img src='xy/". $rare . $snum ."o.gif' border=0>";
				}
				elseif($forme === "Blue") {
					if(!file_exists('xy/'. $rare . $snum .'b.gif')){
						file_put_contents('xy/'. $rare . $snum .'b.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum .'c.gif'));
					}
					echo "<br><img src='xy/". $rare . $snum ."b.gif' border=0>";
				}
				elseif($forme === "White") {
					if(!file_exists('xy/'. $rare . $snum .'w.gif')){
						file_put_contents('xy/'. $rare . $snum .'w.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum .'d.gif'));
					}
					echo "<br><img src='xy/". $rare . $snum ."w.gif' border=0>";
				} else {
					if(!file_exists('xy/'. $rare . $snum .'.gif')){
						file_put_contents('xy/'. $rare . $snum .'.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum .'.gif'));
					}
					echo "<br><img src='xy/". $rare . $snum .".gif' border=0>";
				}
				
			}
			} else {
				if(!file_exists('xy/'. $rare . $snum .'.gif')){
					file_put_contents('xy/'. $rare . $snum .'.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum .'.gif'));
				}
				echo "<br><img src='xy/". $rare . $snum .".gif' border=0>";
			}
		}
		elseif($gname === "Sun" or $gname === "Moon" or $gname === "Ultra Sun" or $gname === "Ultra Moon"){
			if($forme != ""){
				if($species === "Unown"){
					if($forme === "!"){
						if(!file_exists('sm/'. $rare . $snum . 'aa.gif')){
							file_put_contents('sm/'. $rare . $snum . 'aa.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum . 'aa.gif'));
						}
						echo "<br><img src='sm/". $rare . $snum . "aa.gif' border=0>";
					} elseif($forme === "?"){
						if(!file_exists('sm/'. $rare . $snum . 'ab.gif')){
							file_put_contents('sm/'. $rare . $snum . 'ab.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum . 'ab.gif'));
						}
						echo "<br><img src='sm/". $rare . $snum . "ab.gif' border=0>";
					} else {
						if(!file_exists('sm/'. $rare . $snum . $forme .'.gif')){
							file_put_contents('sm/'. $rare . $snum . $forme .'.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum . $forme .'.gif'));
						}
						echo "<br><img src='sm/". $rare . $snum . $forme . ".gif' border=0>";
					}
				} else {
				if($forme === "F"){
					if(!file_exists('sm/'. $rare . $snum .'f.gif')){
						file_put_contents('sm/'. $rare . $snum .'f.gif', file_get_contents('http://www.greenchu.de/sprites/xy/w/'. $rare . $snum .'.gif'));
					}
					echo "<br><img src='sm/". $rare . $snum ."f.gif' border=0>";
				} elseif($forme === "M") {
					if(!file_exists('sm/'. $rare . $snum .'m.gif')){
						file_put_contents('sm/'. $rare . $snum .'m.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum .'.gif'));
					}
					echo "<br><img src='sm/". $rare . $snum ."m.gif' border=0>";
				} elseif($forme === "Original Cap") {
					if(!file_exists('sm/'. $rare . $snum .'c1.gif')){
						file_put_contents('sm/'. $rare . $snum .'c1.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum .'g.gif'));
					}
					echo "<br><img src='sm/". $rare . $snum ."c1.gif' border=0>";
				} elseif($forme === "Kalos Cap") {
					if(!file_exists('sm/'. $rare . $snum .'c6.gif')){
						file_put_contents('sm/'. $rare . $snum .'c6.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum .'k.gif'));
					}
					echo "<br><img src='sm/". $rare . $snum ."c6.gif' border=0>";
				} elseif($forme === "Attack") {
					if(!file_exists('sm/'. $snum .'a.gif')){
						file_put_contents('sm/'. $snum .'a.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $snum .'a.gif'));
					}
					echo "<br><img src='sm/". $snum ."a.gif' border=0>";
				} elseif($forme === "Defense") {
					if(!file_exists('sm/'. $snum .'d.gif')){
						file_put_contents('sm/'. $snum .'d.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $snum .'b.gif'));
					}
					echo "<br><img src='sm/". $snum ."d.gif' border=0>";
				} elseif($forme === "Speed") {
					if(!file_exists('sm/'. $snum .'s.gif')){
						file_put_contents('sm/'. $snum .'s.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $snum .'c.gif'));
					}
					echo "<br><img src='sm/". $snum ."s.gif' border=0>";
				} elseif($forme === "West") {
					if(!file_exists('sm/'. $rare . $snum .'w.gif')){
						file_put_contents('sm/'. $rare . $snum .'w.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum .'.gif'));
					}
					echo "<br><img src='sm/". $rare . $snum ."w.gif' border=0>";
				} elseif($forme === "East") {
					if(!file_exists('sm/'. $rare . $snum .'e.gif')){
						file_put_contents('sm/'. $rare . $snum .'e.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum .'a.gif'));
					}
					echo "<br><img src='sm/". $rare . $snum ."e.gif' border=0>";
				}
				elseif($forme === "Altered") {
					if(!file_exists('sm/'. $rare . $snum .'a.gif')){
						file_put_contents('sm/'. $rare . $snum .'a.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum .'.gif'));
					}
					echo "<br><img src='sm/". $rare . $snum ."a.gif' border=0>";
				} elseif($forme === "Origin") {
					if(!file_exists('sm/'. $rare . $snum .'o.gif')){
						file_put_contents('sm/'. $rare . $snum .'o.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum .'a.gif'));
					}
					echo "<br><img src='sm/". $rare . $snum ."o.gif' border=0>";
				} elseif($forme === "Frost") {
					if(!file_exists('sm/'. $snum .'r.gif')){
						file_put_contents('sm/'. $snum .'r.gif', file_get_contents('http://www.greenchu.de/sprites/sm/'. $snum .'c.gif'));
					}
					echo "<br><img src='sm/". $snum ."r.gif' border=0>";
				} elseif($forme === "Fan") {
					if(!file_exists('sm/'. $snum .'f.gif')){
						file_put_contents('sm/'. $snum .'f.gif', file_get_contents('http://www.greenchu.de/sprites/sm/'. $snum .'d.gif'));
					}
					echo "<br><img src='sm/". $snum ."f.gif' border=0>";
				} elseif($forme === "Red Stripe") {
					if(!file_exists('sm/'. $rare . $snum .'r.gif')){
						file_put_contents('sm/'. $rare . $snum .'r.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum .'.gif'));
					}
					echo "<br><img src='sm/". $rare . $snum ."r.gif' border=0>";
				} elseif($forme === "Blue Stripe") {
					if(!file_exists('sm/'. $rare . $snum .'b.gif')){
						file_put_contents('sm/'. $rare . $snum .'b.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum .'a.gif'));
					}
					echo "<br><img src='sm/". $rare . $snum ."b.gif' border=0>";
				} elseif($forme === "Spring") {
					if(!file_exists('sm/'. $snum .'f.gif')){
						file_put_contents('sm/'. $snum .'f.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $snum .'.gif'));
					}
					echo "<br><img src='sm/". $snum ."f.gif' border=0>";
				} elseif($forme === "Summer") {
					if(!file_exists('sm/'. $snum .'s.gif')){
						file_put_contents('sm/'. $snum .'s.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $snum .'a.gif'));
					}
					echo "<br><img src='sm/". $snum ."s.gif' border=0>";
				} elseif($forme === "Autumn") {
					if(!file_exists('sm/'. $snum .'h.gif')){
						file_put_contents('sm/'. $snum .'h.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $snum .'b.gif'));
					}
					echo "<br><img src='sm/". $snum ."h.gif' border=0>";
				} elseif($forme === "Winter") {
					if(!file_exists('sm/'. $snum .'w.gif')){
						file_put_contents('sm/'. $snum .'w.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $snum .'c.gif'));
					}
					echo "<br><img src='sm/". $snum ."w.gif' border=0>";
				} elseif($forme === "Incarnate") {
					if(!file_exists('sm/'. $rare . $snum .'i.gif')){
						file_put_contents('sm/'. $rare . $snum .'i.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum .'.gif'));
					}
					echo "<br><img src='sm/". $rare . $snum ."i.gif' border=0>";
				} elseif($forme === "Therian") {
					if(!file_exists('sm/'. $rare . $snum .'t.gif')){
						file_put_contents('sm/'. $rare . $snum .'t.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum .'a.gif'));
					}
					echo "<br><img src='sm/". $rare . $snum ."t.gif' border=0>";
				} elseif($forme === "Red") {
					if(!file_exists('sm/'. $rare . $snum .'r.gif')){
						file_put_contents('sm/'. $rare . $snum .'r.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum .'.gif'));
					}
					echo "<br><img src='sm/". $rare . $snum ."r.gif' border=0>";
				} elseif($forme === "Yellow") {
					if(!file_exists('sm/'. $rare . $snum .'y.gif')){
						file_put_contents('sm/'. $rare . $snum .'y.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum .'a.gif'));
					}
					echo "<br><img src='sm/". $rare . $snum ."y.gif' border=0>";
				}
				elseif($forme === "Orange") {
					if(!file_exists('sm/'. $rare . $snum .'o.gif')){
						file_put_contents('sm/'. $rare . $snum .'o.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum .'b.gif'));
					}
					echo "<br><img src='sm/". $rare . $snum ."o.gif' border=0>";
				}
				elseif($forme === "Blue") {
					if(!file_exists('sm/'. $rare . $snum .'b.gif')){
						file_put_contents('sm/'. $rare . $snum .'b.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum .'c.gif'));
					}
					echo "<br><img src='sm/". $rare . $snum ."b.gif' border=0>";
				}
				elseif($forme === "White") {
					if(!file_exists('sm/'. $rare . $snum .'w.gif')){
						file_put_contents('sm/'. $rare . $snum .'w.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum .'d.gif'));
					}
					echo "<br><img src='sm/". $rare . $snum ."w.gif' border=0>";
				} elseif($forme === "Alola") {
						if(!file_exists('sm/'. $snum .'al.gif')){
							file_put_contents('sm/'. $snum .'al.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $snum .'a.gif'));
						}
						echo "<br><img src='sm/". $snum ."al.gif' border=0>";
				} elseif($forme === "Pom-Pom") {
						if(!file_exists('sm/'. $snum .'c.gif')){
							file_put_contents('sm/'. $snum .'c.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $snum .'.gif'));
						}
						echo "<br><img src='sm/". $snum ."c.gif' border=0>";
				} elseif($forme === "Pa'u") {
						if(!file_exists('sm/'. $snum .'p.gif')){
							file_put_contents('sm/'. $snum .'p.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $snum .'a.gif'));
						}
						echo "<br><img src='sm/". $snum ."p.gif' border=0>";
				} elseif($forme === "Midday") {
						if(!file_exists('sm/'. $snum .'d.gif')){
							file_put_contents('sm/'. $snum .'d.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $snum .'.gif'));
						}
						echo "<br><img src='sm/". $snum ."d.gif' border=0>";
				} elseif($forme === "Midnight") {
						if(!file_exists('sm/'. $snum .'n.gif')){
							file_put_contents('sm/'. $snum .'n.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $snum .'a.gif'));
						}
						echo "<br><img src='sm/". $snum ."n.gif' border=0>";
				} elseif($forme === "Dusk") {
						if(!file_exists('sm/'. $snum .'t.gif')){
							file_put_contents('sm/'. $snum .'t.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $snum .'b.gif'));
						}
						echo "<br><img src='sm/". $snum ."t.gif' border=0>";
				} elseif($forme === "Blue Core") {
						if(!file_exists('sm/'. $snum .'b.gif')){
							file_put_contents('sm/'. $snum .'b.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $snum .'e.gif'));
						}
						echo "<br><img src='sm/". $snum ."b.gif' border=0>";
				} elseif($forme === "Violet Core") {
						if(!file_exists('sm/'. $snum .'v.gif')){
							file_put_contents('sm/'. $snum .'v.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $snum .'g.gif'));
						}
						echo "<br><img src='sm/". $snum ."v.gif' border=0>";
				} else {
					if(!file_exists('sm/'. $rare . $snum .'.gif')){
						file_put_contents('sm/'. $rare . $snum .'.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum .'.gif'));
					}
					echo "<br><img src='sm/". $rare . $snum .".gif' border=0>";
				}
				
			}
			} else {
				if(!file_exists('sm/'. $rare . $snum .'.gif')){
					file_put_contents('sm/'. $rare . $snum .'.gif', file_get_contents('http://www.greenchu.de/sprites/xy/'. $rare . $snum .'.gif'));
				}
				echo "<br><img src='sm/". $rare . $snum .".gif' border=0>";
			}
		}
		elseif($gname === "Bank VI" or $gname === "Bank VII"){
			if($forme != ""){
				if($species === "Unown"){
					if($forme === "!"){
						if(!file_exists('bank/'. $snum . 'aa.png')){
							file_put_contents('bank/'. $snum . 'aa.png', file_get_contents('http://www.greenchu.de/sprites/bank/'. $snum . 'aa.png'));
						}
						echo "<br><img src='bank/". $snum . "aa.png' border=0>";
					} elseif($forme === "?"){
						if(!file_exists('bank/'. $snum . 'ab.png')){
							file_put_contents('bank/'. $snum . 'ab.png', file_get_contents('http://www.greenchu.de/sprites/bank/'. $snum . 'ab.png'));
						}
						echo "<br><img src='bank/". $snum . "ab.png' border=0>";
					} else {
						if(!file_exists('bank/'. $snum . $forme .'.png')){
							file_put_contents('bank/'. $snum . $forme .'.png', file_get_contents('http://www.greenchu.de/sprites/bank/'. $snum . $forme .'.png'));
						}
						echo "<br><img src='bank/". $snum . $forme . ".png' border=0>";
					}
				} else {
					if($forme === "F"){
						if(!file_exists('bank/'. $rare . $snum .'f.png')){
							file_put_contents('bank/'. $rare . $snum .'f.png', file_get_contents('http://www.greenchu.de/sprites/bank/'. $rare . $snum .'f.png'));
						}
						echo "<br><img src='bank/". $rare . $snum ."f.png' border=0>";
					} elseif($forme === "M") {
						if(!file_exists('bank/'. $rare . $snum .'m.png')){
							file_put_contents('bank/'. $rare . $snum .'m.png', file_get_contents('http://www.greenchu.de/sprites/bank/'. $rare . $snum .'.png'));
						}
						echo "<br><img src='bank/". $rare . $snum ."m.png' border=0>";
					} else if($forme === "Original Cap") {
						if(!file_exists('bank/'. $rare . $snum .'c1.png')){
							file_put_contents('bank/'. $rare . $snum .'c1.png', file_get_contents('http://www.greenchu.de/sprites/bank/'. $rare . $snum .'g.png'));
						}
						echo "<br><img src='bank/". $rare . $snum ."c1.png' border=0>";
					} elseif($forme === "Kalos Cap") {
						if(!file_exists('bank/'. $rare . $snum .'c6.png')){
							file_put_contents('bank/'. $rare . $snum .'c6.png', file_get_contents('http://www.greenchu.de/sprites/bank/'. $rare . $snum .'k.png'));
						}
						echo "<br><img src='bank/". $rare . $snum ."c6.png' border=0>";
					} elseif($forme === "Attack") {
						if(!file_exists('bank/'. $snum .'a.png')){
							file_put_contents('bank/'. $snum .'a.png', file_get_contents('http://www.greenchu.de/sprites/bank/'. $snum .'a.png'));
						}
						echo "<br><img src='bank/". $snum ."a.png' border=0>";
					} elseif($forme === "Defense") {
						if(!file_exists('bank/'. $snum .'d.png')){
							file_put_contents('bank/'. $snum .'d.png', file_get_contents('http://www.greenchu.de/sprites/bank/'. $snum .'b.png'));
						}
						echo "<br><img src='bank/". $snum ."d.png' border=0>";
					} elseif($forme === "Speed") {
						if(!file_exists('bank/'. $snum .'s.png')){
							file_put_contents('bank/'. $snum .'s.png', file_get_contents('http://www.greenchu.de/sprites/bank/'. $snum .'c.png'));
						}
						echo "<br><img src='bank/". $snum ."s.png' border=0>";
					} elseif($forme === "West") {
						if(!file_exists('bank/'. $snum .'w.png')){
							file_put_contents('bank/'. $snum .'w.png', file_get_contents('http://www.greenchu.de/sprites/bank/'. $snum .'.png'));
						}
						echo "<br><img src='bank/". $snum ."w.png' border=0>";
					} elseif($forme === "East") {
						if(!file_exists('bank/'. $snum .'e.png')){
							file_put_contents('bank/'. $snum .'e.png', file_get_contents('http://www.greenchu.de/sprites/bank/'. $snum .'a.png'));
						}
						echo "<br><img src='bank/". $snum ."e.png' border=0>";
					}
					elseif($forme === "Altered") {
						if(!file_exists('bank/'. $snum .'a.png')){
							file_put_contents('bank/'. $snum .'a.png', file_get_contents('http://www.greenchu.de/sprites/bank/'. $snum .'.png'));
						}
						echo "<br><img src='bank/". $snum ."a.png' border=0>";
					} elseif($forme === "Origin") {
						if(!file_exists('bank/'. $snum .'o.png')){
							file_put_contents('bank/'. $snum .'o.png', file_get_contents('http://www.greenchu.de/sprites/bank/'. $snum .'a.png'));
						}
						echo "<br><img src='bank/". $snum ."o.png' border=0>";
					} elseif($forme === "Frost") {
						if(!file_exists('bank/'. $snum .'r.png')){
							file_put_contents('bank/'. $snum .'r.png', file_get_contents('http://www.greenchu.de/sprites/bank/'. $snum .'c.png'));
						}
						echo "<br><img src='bank/". $snum ."r.png' border=0>";
					} elseif($forme === "Fan") {
						if(!file_exists('bank/'. $snum .'f.png')){
							file_put_contents('bank/'. $snum .'f.png', file_get_contents('http://www.greenchu.de/sprites/bank/'. $snum .'d.png'));
						}
						echo "<br><img src='bank/". $snum ."f.png' border=0>";
					} elseif($forme === "Red Stripe") {
						if(!file_exists('bank/'. $snum .'r.png')){
							file_put_contents('bank/'. $snum .'r.png', file_get_contents('http://www.greenchu.de/sprites/bank/'. $snum .'.png'));
						}
						echo "<br><img src='bank/". $snum ."r.png' border=0>";
					} elseif($forme === "Blue Stripe") {
						if(!file_exists('bank/'. $snum .'b.png')){
							file_put_contents('bank/'. $snum .'b.png', file_get_contents('http://www.greenchu.de/sprites/bank/'. $snum .'a.png'));
						}
						echo "<br><img src='bank/". $snum ."b.png' border=0>";
					} elseif($forme === "Incarnate") {
						if(!file_exists('bank/'. $snum .'i.png')){
							file_put_contents('bank/'. $snum .'i.png', file_get_contents('http://www.greenchu.de/sprites/bank/'. $snum .'.png'));
						}
						echo "<br><img src='bank/". $snum ."i.png' border=0>";
					} elseif($forme === "Therian") {
						if(!file_exists('bank/'. $snum .'t.png')){
							file_put_contents('bank/'. $snum .'t.png', file_get_contents('http://www.greenchu.de/sprites/bank/'. $snum .'a.png'));
						}
						echo "<br><img src='bank/". $snum ."t.png' border=0>";
					} elseif($forme === "Red") {
						if(!file_exists('bank/'. $snum .'r.png')){
							file_put_contents('bank/'. $snum .'r.png', file_get_contents('http://www.greenchu.de/sprites/bank/'. $snum .'.png'));
						}
						echo "<br><img src='bank/". $snum ."r.png' border=0>";
					} elseif($forme === "Yellow") {
						if(!file_exists('bank/'. $snum .'y.png')){
							file_put_contents('bank/'. $snum .'y.png', file_get_contents('http://www.greenchu.de/sprites/bank/'. $snum .'a.png'));
						}
						echo "<br><img src='bank/". $snum ."y.png' border=0>";
					}
					elseif($forme === "Orange") {
						if(!file_exists('bank/'. $snum .'o.png')){
							file_put_contents('bank/'. $snum .'o.png', file_get_contents('http://www.greenchu.de/sprites/bank/'. $snum .'b.png'));
						}
						echo "<br><img src='bank/". $snum ."o.png' border=0>";
					}
					elseif($forme === "Blue") {
						if(!file_exists('bank/'. $snum .'b.png')){
							file_put_contents('bank/'. $snum .'b.png', file_get_contents('http://www.greenchu.de/sprites/bank/'. $snum .'c.png'));
						}
						echo "<br><img src='bank/". $snum ."b.png' border=0>";
					}
					elseif($forme === "White") {
						if(!file_exists('bank/'. $snum .'w.png')){
							file_put_contents('bank/'. $snum .'w.png', file_get_contents('http://www.greenchu.de/sprites/bank/'. $snum .'d.png'));
						}
						echo "<br><img src='bank/". $snum ."w.png' border=0>";
					} elseif($forme === "Alola") {
						if(!file_exists('bank/'. $snum .'al.png')){
							file_put_contents('bank/'. $snum .'al.png', file_get_contents('http://www.greenchu.de/sprites/bank/'. $snum .'a.png'));
						}
						echo "<br><img src='bank/". $snum ."al.png' border=0>";
					} elseif($forme === "Pom-Pom") {
						if(!file_exists('bank/'. $snum .'c.png')){
							file_put_contents('bank/'. $snum .'c.png', file_get_contents('http://www.greenchu.de/sprites/bank/'. $snum .'.png'));
						}
						echo "<br><img src='bank/". $snum ."c.png' border=0>";
					} elseif($forme === "Pa'u") {
						if(!file_exists('bank/'. $snum .'p.png')){
							file_put_contents('bank/'. $snum .'p.png', file_get_contents('http://www.greenchu.de/sprites/bank/'. $snum .'a.png'));
						}
						echo "<br><img src='bank/". $snum ."p.png' border=0>";
					} elseif($forme === "Midday") {
						if(!file_exists('bank/'. $snum .'d.png')){
							file_put_contents('bank/'. $snum .'d.png', file_get_contents('http://www.greenchu.de/sprites/bank/'. $snum .'.png'));
						}
						echo "<br><img src='bank/". $snum ."d.png' border=0>";
					} elseif($forme === "Midnight") {
						if(!file_exists('bank/'. $snum .'n.png')){
							file_put_contents('bank/'. $snum .'n.png', file_get_contents('http://www.greenchu.de/sprites/bank/'. $snum .'a.png'));
						}
						echo "<br><img src='bank/". $snum ."n.png' border=0>";
					} elseif($forme === "Dusk") {
						if(!file_exists('bank/'. $snum .'t.png')){
							file_put_contents('bank/'. $snum .'t.png', file_get_contents('http://www.greenchu.de/sprites/bank/'. $snum .'b.png'));
						}
						echo "<br><img src='bank/". $snum ."t.png' border=0>";
					} elseif($forme === "Blue Core") {
						if(!file_exists('bank/'. $snum .'b.png')){
							file_put_contents('bank/'. $snum .'b.png', file_get_contents('http://www.greenchu.de/sprites/bank/'. $snum .'e.png'));
						}
						echo "<br><img src='bank/". $snum ."b.png' border=0>";
					} elseif($forme === "Violet Core") {
						if(!file_exists('bank/'. $snum .'v.png')){
							file_put_contents('bank/'. $snum .'v.png', file_get_contents('http://www.greenchu.de/sprites/bank/'. $snum .'g.png'));
						}
						echo "<br><img src='bank/". $snum ."v.png' border=0>";
					} else {
						if(!file_exists('bank/'. $snum .'.png')){
							file_put_contents('bank/'. $snum .'.png', file_get_contents('http://www.greenchu.de/sprites/bank/'. $snum .'.png'));
						}
						echo "<br><img src='bank/". $snum .".png' border=0>";
					}
				}
			} else {
				if(!file_exists('bank/'. $snum .'.png')){
					file_put_contents('bank/'. $snum .'.png', file_get_contents('http://www.greenchu.de/sprites/bank/'. $snum .'.png'));
				}
				echo "<br><img src='bank/". $snum .".png' border=0>";
			}
		} elseif($gname === "Lets Go Pikachu" or $gname === "Lets Go Eevee"){
			if(!file_exists('yellow/'. $snum .'.png')){
				file_put_contents('yellow/'. $snum .'.png', file_get_contents('http://www.greenchu.de/sprites/lgpe/'. $rare . $snum .'.png'));
			}
			echo "<br><img src='yellow/". $snum .".png' border=0>";
		}
	}
?>
</span></p>
<p class="split-para">
<span>
<br>
<?php
	if($pkrs === "Have"){
		echo "<img src='pkrs.png' border=0>";
	}
	if($pkrs === "Cured"){
		echo "<img src='cure.png' border=0>";
	}
?>
Pkrs: <select id="pkrs" name="pkrs" style="border:0px;background-color:#9EDA71;" onchange="turnText('pkrs')"/>
	<option value = 'No'></option>
	<?php
		$spra = ["Have","Cured"];
		
		foreach($spra as $sp){
			if($pkrs === $sp){
				echo "<option value='".$sp."' selected>".$sp."</option>";
			} else {
				echo "<option value='".$sp."'>".$sp."</option>";
			}
		}
	?>
</select>
</span>
</p>
<p class ="split-para">
Ability: <input type="text" id="ability" name="ability" style="border:0px;background-color:#9EDA71;" size="18" onchange="turnText('ability')" value="<?= $ability ?>" />
<br>
Nature: <select id="nature" name="nature" style="border:0px;background-color:#9EDA71;" onchange="turnText('nature')"/>
	<option value = ''></option>
	<?php
		$natue = file("natureList.txt");
		$natures=array_map('trim',$natue);
		
		foreach($natures as $na){
			if($nature === $na){
				echo "<option value='".$na."' selected>".$na."</option>";
			} else {
				echo "<option value='".$na."'>".$na."</option>";
			}
		}
	?>
</select>
<span>
Moves:
</span>
</p>

<p class ="split-para">
HP <input type="text" id="hp" name="hp" style="border:0px;background-color:#9EDA71;" size="3" maxlength="3" onchange="turnText('hp')" value="<?= $hp ?>" />
<span>
<input type="text" id="move1" name="moves[]" style="border:0px;background-color:#9EDA71;" size="18" onchange="turnText('move1')" value="<?= $moves[0] ?>" />
</span>
</p>

<p class ="split-para">
<?php
echo 'Attack <input type="text" id="atk" name="atk" style="border:0px;background-color:#9EDA71;';
 
if($nature === "Lonely" or $nature === "Adamant" or $nature === "Naughty" or $nature === "Brave"){
	echo "color:#FF0000;";
} else if($nature === "Bold" or $nature === "Modest" or $nature === "Calm" or $nature === "Timid"){
	echo "color:#0000FF;";
} else if($nature === "Hardy"){
	echo "color:#FF00FF;";
}

echo ' size="3"  maxlength="3" onchange="turnText(\'atk\')" value='.$atk. ' />';
?>
<span>
<input type="text" id="move2" name="moves[]" style="border:0px;background-color:#9EDA71;" size="18" onchange="turnText('move2')" value="<?= $moves[1] ?>" />
</span>
</p>

<p class ="split-para">
<?php
echo 'Defense <input type="text" id="def" name="def" style="border:0px;background-color:#9EDA71;';
 
if($nature === "Bold" or $nature === "Impish" or $nature === "Lax" or $nature === "Relaxed"){
	echo "color:#FF0000;";
} else if($nature === "Lonely" or $nature === "Mild" or $nature === "Gentle" or $nature === "Hasty"){
	echo "color:#0000FF;";
} else if($nature === "Docile"){
	echo "color:#FF00FF;";
}

echo ' size="3" maxlength="3" onchange="turnText(\'def\')" value='.$def. ' />';
?>
<span>
<input type="text" id="move3" name="moves[]" style="border:0px;background-color:#9EDA71;" size="18" onchange="turnText('move3')" value="<?= $moves[2] ?>" />
</span>
</p>

<p class ="split-para">
<?php
echo 'Sp. Atk <input type="text" id="sat" name="sat" style="border:0px;background-color:#9EDA71;';
 
if($nature === "Modest" or $nature === "Mild" or $nature === "Quiet" or $nature === "Rash"){
	echo "color:#FF0000;";
} else if($nature === "Adamant" or $nature === "Impish" or $nature === "Careful" or $nature === "Jolly"){
	echo "color:#0000FF;";
} else if($nature === "Bashful"){
	echo "color:#FF00FF;";
}

echo ' size="3" maxlength="3" onchange="turnText(\'sat\')" value='.$sat. ' />';
?>
<span>
<input type="text" id="move4" name="moves[]" style="border:0px;background-color:#9EDA71;" size="18" onchange="turnText('move4')" value="<?= $moves[3] ?>" />
</span>
</p>

<p class ="split-para">
<?php
echo 'Sp. Def <input type="text" id="sde" name="sde" style="border:0px;background-color:#9EDA71;';
 
if($nature === "Calm" or $nature === "Gentle" or $nature === "Careful" or $nature === "Sassy"){
	echo "color:#FF0000;";
} else if($nature === "Naughty" or $nature === "Lax" or $nature === "Rash" or $nature === "Naive"){
	echo "color:#0000FF;";
} else if($nature === "Quirky"){
	echo "color:#FF00FF;";
}

echo ' size="3" maxlength="3" onchange="turnText(\'sde\')" value='.$sde. ' />';
?>
<span>
OT: <select "ot" id="ot" name="ot" style="border:0px;background-color:#9EDA71;" onchange="turnText('ot')"/>
	<option value = ''></option>
	<?php
		$natue = file("otList.txt");
		$natures=array_map('trim',$natue);
		
		foreach($natures as $na){
			if($ot === $na){
				echo "<option value='".$na."' selected>".$na."</option>";
			} else {
				echo "<option value='".$na."'>".$na."</option>";
			}
		}
	?>
</select>
</span>
</p>

<p class ="split-para">
<?php
echo 'Speed <input type="text" id="spd" name="spd" style="border:0px;background-color:#9EDA71;';
 
if($nature === "Timid" or $nature === "Hasty" or $nature === "Jolly" or $nature === "Naive"){
	echo "color:#FF0000;";
} else if($nature === "Brave" or $nature === "Relaxed" or $nature === "Quiet" or $nature === "Sassy"){
	echo "color:#0000FF;";
} else if($nature === "Serious"){
	echo "color:#FF00FF;";
}

echo ' size="3" maxlength="3" onchange="turnText(\'spd\')" value='.$spd. ' />';
?>
<span>
Game: <select id="game" name="game" style="border:0px;background-color:#9EDA71;" onchange="turnText('game')"/>
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
</span>
</p>
<p class ="split-para">
<span>
System: <select id="system" name="system" style="border:0px;background-color:#9EDA71;" onchange="turnText('system')"/>
	<option value = ''></option>
	<?php
		
		$tems= ["GBA","DS","3DS","Switch"];
		
		foreach($tems as $ga){
			if($temmy === $ga){
				echo "<option value='".$ga."' selected>".$ga."</option>";
			} else {
				echo "<option value='".$ga."'>".$ga."</option>";
			}
		}
	?>
</select>
</span>
</p>
<p class="shug"><input type="submit" value="Edit">
</form>
</p>


<form action="gameSort2.php" method="post">
<p class="shug"><input type="submit" value="Game-Species Sort"></p>
</form>
<form action="gameSort.php" method="post">
<p class="shug"><input type="submit" value="Game-Level Sort"></p>
</form>
<form action="genSort.php" method="post">
<p class="shug"><input type="submit" value="Gen-Species Sort"></p>
</form>
<form action="genSort2.php" method="post">
<p class="shug"><input type="submit" value="Gen-Level Sort"></p>
</form>
<form action="speciesSort.php" method="post">
<p class="shug"><input type="submit" value="All Species Sort"></p>
</form>
<form action="levelSort.php" method="post">
<p class="shug"><input type="submit" value="All Level Sort"></p>
</form>
<form action="moveSort.php" method="post">
<p class="shug"><input type="submit" value="Move Sort"></p>
</form>
<form action="listLevels.php" method="post">
<p class="shug"><input type="submit" value="List Levels">
</form>
<form action="listSpecies.php" method="post">
<p class="shug"><input type="submit" value="List Species">
</form>
<form action="listSpecies2.php" method="post">
<p class="shug"><input type="submit" value="List Species By Game">
</form>
<form action="listMates.php" method="post">
<p class="shug">
<input type="submit" value="List Mates">
</form>
<form action="listGames.php" method="post">
<p class="shug"><input type="submit" value="List Games">
</form>
<form action="listSpeciesMoves.php" method="post">
<p class="shug"><input type="submit" value="List Species' Moves">
</form>
<form action="listMoves.php" method="post">
<p class="shug"><input type="submit" value="List Moves">
</form>
<form action="listMovesets.php" method="post">
<p class="shug"><input type="submit" value="List Movesets">
</form>
<form action="listLanguages.php" method="post">
<p class="shug"><input type="submit" value="List Languages">
</form>
<form action="listSystems.php" method="post">
<p class="shug"><input type="submit" value="List Systems">
</form>
<form action="listBalls.php" method="post">
<p class="shug"><input type="submit" value="List Balls">
</form>
<form action="listBalls2.php" method="post">
<p class="shug"><input type="submit" value="List Species' Balls">
</form>
<form action="listPkrs.php" method="post">
<p class="shug"><input type="submit" value="List Pokérus">
</form>
<form action="listTransfer.php" method="post">
<p class="shug"><input type="submit" value="List Transferrable">
</form>
<form action="listNatures.php" method="post">
<p class="shug"><input type="submit" value="List Natures">
</form>
<form action="listNatures2.php" method="post">
<p class="shug"><input type="submit" value="List Species' Natures">
</form>
<form action="listAbilities.php" method="post">
<p class="shug"><input type="submit" value="List Abilities">
</form>
<form action="listAbilities2.php" method="post">
<p class="shug"><input type="submit" value="List Species' Abilities">
</form>
<form action="listOTs.php" method="post">
<p class="shug"><input type="submit" value="List OTs">
</form>
<form action="otFlip.php" method="post">
<p class="shug"><input type="submit" value="OT Flip">
</form>
<form action="uniqueMons.php" method="post">
<p class="shug"><input type="submit" value="Unique">
</form>
<form action="newMons.php" method="post">
<p class="shug"><input type="submit" value="New Mons">
</form>
<form action="niqCalc.php" method="post">
<p class="shug"><input type="submit" value="Uniqalc">
</form>

<script>
function dec() {
	o = parseInt(getCookie('off'));
	if(o > 0){
		setCookie("off",o-1);
	}
	window.location.reload();
}
function dec10() {
	o = parseInt(getCookie('off'));
	if(o > 9){
		setCookie("off",o-10);
	} else {
		setCookie("off",0);
	}
	window.location.reload();
}
function dec100() {
	o = parseInt(getCookie('off'));
	if(o > 99){
		setCookie("off",o-100);
	} else {
		setCookie("off",0);
	}
	window.location.reload();
}
function dec1000() {
	o = parseInt(getCookie('off'));
	if(o > 999){
		setCookie("off",o-1000);
	} else {
		setCookie("off",0);
	}
	window.location.reload();
}
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

</body>
</html>