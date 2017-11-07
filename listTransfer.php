<html>
<title>Transferrable List</title>
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
$data = json_decode($jin, true);

$dex = file("NatLine Dex.txt");
$tdex = array_map('trim',$dex);

$ga = file("gameList.txt");
$tga=array_map('trim',$ga);

$el = count($data);
$glist = [];

for ($j = 0; $j < $el; $j++){
	$data[$j]['LNum'] = array_search($data[$j]['Species'],$tdex);
}

$gsc = [[]];

for($s = 0;$s <= 4;$s++){
	for($g = 1; $g <= 7; $g++){
		$gsc[$g][$s] = 0;
	}
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
	$gsc[$data[$j]['Gen']][$data[$j]['VC']]++;
	
}
usort($data, 'mySort');

$nam = "";
$t = false;
$g = 0;
/*
for ($j = 0; $j < $el; $j++){
	if($g != $data[$j]['Gen']){
		$g = $data[$j]['Gen'];
		$t = false;
		$nam = $data[$j]['Species'];
		echo "Gen " . $g . "<br>"; 
	} else if (strcmp($nam, $data[$j]['Species']) != 0) {
		$nam = $data[$j]['Species'];
		$t = false;
	} else if(strcmp($nam, $data[$j]['Species']) == 0 and $t == false){
		$snum = array_search($nam,$tkan) + 1;
		$snum = str_pad($snum, 3, '0', STR_PAD_LEFT);
		if($snum != 0){
			echo "<img src='icons/". $snum .".png' border=0>";
		}
		echo $nam . "<br>";
		$t = true;
	}
}
*/
$a1 = 0;
$a2 = 0;
$x1 = 1;
$x2 = 2;
$y1 = 3;
$y2 = 3;
$b1 = $gsc[$x1][$y1];
$b2 = $gsc[$x2][$y2];
echo "<br><b>I (3DS)->II (3DS)</b><br>";
//echo $b1 . " " . $b2;
for ($j = 0; $j < $el; $j++){
	if(strcmp($nam, $data[$j]['Species']) != 0){
		if($a1 >= 2 && ($a1/$b1) > (($a2+1)/($b2+1)) && $a1 > $a2){
			if($snum != 0){
				echo "<img src='icons/". $snum .".png' border=0>" . $nam. " " . round((($a1/$b1)-(($a2+1)/($b2+1))),5) . " " . ($a1-($a2+1)) . " " . "I (3DS)->II (3DS)";
			}
			$glc = array_count_values($glist);
			foreach ($glc as $key => $value) {
				echo "$key: $value; ";
			}
			echo "</br>";
		}
		$a1 = 0;
		$a2 = 0;
		$nam = $data[$j]['Species'];
		$snum = array_search($nam,$tkan) + 1;
		$snum = str_pad($snum, 3, '0', STR_PAD_LEFT);
		if($data[$j]['Gen'] == $x1 && $data[$j]['VC'] == $y1){
			$a1++;
		} elseif($data[$j]['Gen'] == $x2 && $data[$j]['VC'] == $y2){
			$a2++;
		}
	} else {
		if($data[$j]['Gen'] == $x1 && $data[$j]['VC'] == $y1){
			$a1++;
		} elseif($data[$j]['Gen'] == $x2 && $data[$j]['VC'] == $y2){
			$a2++;
		}
	}
}

if($a >= 2){
	if($snum != 0){
		echo "<img src='icons/". $snum .".png' border=0>" . $nam . " " . round((($a1/$b1)-(($a2+1)/($b2+1))),5) . " " . ($a1-($a2+1)) . " " . "I (3DS)->II (3DS)";
	}
	$glc = array_count_values($glist);
	foreach ($glc as $key => $value) {
		echo "$key: $value; ";
	}
	echo "</br>";
}

$a1 = 0;
$a2 = 0;
$x1 = 1;
$x2 = 7;
$y1 = 3;
$y2 = 3;
$b1 = $gsc[$x1][$y1];
$b2 = $gsc[$x2][$y2];
echo "<br><b>I (3DS)->VII (3DS)</b><br>";
//echo $b1 . " " . $b2;
for ($j = 0; $j < $el; $j++){
	if(strcmp($nam, $data[$j]['Species']) != 0){
		if($a1 >= 2 && ($a1/$b1) > (($a2+1)/($b2+1)) && $a1 > $a2){
			if($snum != 0){
				echo "<img src='icons/". $snum .".png' border=0>" . $nam. " " . round((($a1/$b1)-(($a2+1)/($b2+1))),5) . " " . ($a1-($a2+1)) . " " . "I (3DS)->VII (3DS)";
			}
			$glc = array_count_values($glist);
			foreach ($glc as $key => $value) {
				echo "$key: $value; ";
			}
			echo "</br>";
		}
		$a1 = 0;
		$a2 = 0;
		$nam = $data[$j]['Species'];
		$snum = array_search($nam,$tkan) + 1;
		$snum = str_pad($snum, 3, '0', STR_PAD_LEFT);
		if($data[$j]['Gen'] == $x1 && $data[$j]['VC'] == $y1){
			$a1++;
		} elseif($data[$j]['Gen'] == $x2 && $data[$j]['VC'] == $y2){
			$a2++;
		}
	} else {
		if($data[$j]['Gen'] == $x1 && $data[$j]['VC'] == $y1){
			$a1++;
		} elseif($data[$j]['Gen'] == $x2 && $data[$j]['VC'] == $y2){
			$a2++;
		}
	}
}

if($a >= 2){
	if($snum != 0){
		echo "<img src='icons/". $snum .".png' border=0>" . $nam. " " . round((($a1/$b1)-(($a2+1)/($b2+1))),5) . " " . ($a1-($a2+1)) . " " . "I (3DS)->VII (3DS)";
	}
	$glc = array_count_values($glist);
	foreach ($glc as $key => $value) {
		echo "$key: $value; ";
	}
	echo "</br>";
}

$a1 = 0;
$a2 = 0;
$x1 = 2;
$x2 = 1;
$y1 = 3;
$y2 = 3;
$b1 = $gsc[$x1][$y1];
$b2 = $gsc[$x2][$y2];
echo "<br><br><b>II (3DS)->I (3DS)</b><br>";
//echo $b1 . " " . $b2;
for ($j = 0; $j < $el; $j++){
	if(strcmp($nam, $data[$j]['Species']) != 0){
		if($a1 >= 2 && ($a1/$b1) > (($a2+1)/($b2+1)) && $a1 > $a2){
			if($snum != 0){
				echo "<img src='icons/". $snum .".png' border=0>" . $nam. " " . round((($a1/$b1)-(($a2+1)/($b2+1))),5) . " " . ($a1-($a2+1)) . " II (3DS)->I (3DS)";
			}
			$glc = array_count_values($glist);
			foreach ($glc as $key => $value) {
				echo "$key: $value; ";
			}
			echo "</br>";
		}
		$a1 = 0;
		$a2 = 0;
		$nam = $data[$j]['Species'];
		$snum = array_search($nam,$tkan) + 1;
		$snum = str_pad($snum, 3, '0', STR_PAD_LEFT);
		if($snum <= 151){
			if($data[$j]['Gen'] == $x1 && $data[$j]['VC'] == $y1){
				$a1++;
			} elseif($data[$j]['Gen'] == $x2 && $data[$j]['VC'] == $y2){
				$a2++;
			}
		}
	} else {
		if($snum <= 151){
			if($data[$j]['Gen'] == $x1 && $data[$j]['VC'] == $y1){
				$a1++;
			} elseif($data[$j]['Gen'] == $x2 && $data[$j]['VC'] == $y2){
				$a2++;
			}
		}
	}
}

if($a >= 2){
	if($snum != 0){
		echo "<img src='icons/". $snum .".png' border=0>" . $nam. " "  . round((($a1/$b1)-(($a2+1)/($b2+1))),5) . " " . ($a1-($a2+1)) . " II (3DS)->I (3DS)";
	}
	$glc = array_count_values($glist);
	foreach ($glc as $key => $value) {
		echo "$key: $value; ";
	}
	echo "</br>";
}

$a1 = 0;
$a2 = 0;
$x1 = 3;
$x2 = 4;
$y1 = 1;
$y2 = 2;
$b1 = $gsc[$x1][$y1];
$b2 = $gsc[$x2][$y2];
echo "<br><br><b>III (GBA)->IV (DS)</b><br>";
for ($j = 0; $j < $el; $j++){
	if(strcmp($nam, $data[$j]['Species']) != 0){
		if($a1 >= 2  && ($a1/$b1) > (($a2+1)/($b2+1)) && $a1 > $a2){
			if($snum != 0){
				echo "<img src='icons/". $snum .".png' border=0>" . $nam. " " . round((($a1/$b1)-(($a2+1)/($b2+1))),5) . " " . ($a1-($a2+1)) . " III (GBA)->IV (DS)";
			}
			$glc = array_count_values($glist);
			foreach ($glc as $key => $value) {
				echo "$key: $value; ";
			}
			echo "</br>";
		}
		$a1 = 0;
		$a2 = 0;
		$nam = $data[$j]['Species'];
		$snum = array_search($nam,$tkan) + 1;
		$snum = str_pad($snum, 3, '0', STR_PAD_LEFT);
		if($data[$j]['Gen'] == $x1 && $data[$j]['VC'] == $y1){
			$a1++;
		} elseif($data[$j]['Gen'] == $x2 && $data[$j]['VC'] == $y2){
			$a2++;
		}
	} else {
		if($data[$j]['Gen'] == $x1 && $data[$j]['VC'] == $y1){
			$a1++;
		} elseif($data[$j]['Gen'] == $x2 && $data[$j]['VC'] == $y2){
			$a2++;
		}
	}
}

if($a >= 2){
	if($snum != 0){
		echo "<img src='icons/". $snum .".png' border=0>" . $nam. " ". round((($a1/$b1)-(($a2+1)/($b2+1))),5) . " " . ($a1-($a2+1)) . " III (GBA)->IV (DS)";
	}
	$glc = array_count_values($glist);
	foreach ($glc as $key => $value) {
		echo "$key: $value; ";
	}
	echo "</br>";
}

$a1 = 0;
$a2 = 0;
$x1 = 3;
$x2 = 5;
$y1 = 1;
$y2 = 2;
$b1 = $gsc[$x1][$y1];
$b2 = $gsc[$x2][$y2];
echo "<br><b>III (GBA)->V (DS)</b><br>";
for ($j = 0; $j < $el; $j++){
	if(strcmp($nam, $data[$j]['Species']) != 0){
		if($a1 >= 2  && ($a1/$b1) > (($a2+1)/($b2+1)) && $a1 > $a2){
			if($snum != 0){
				echo "<img src='icons/". $snum .".png' border=0>" . $nam. " " . round((($a1/$b1)-(($a2+1)/($b2+1))),5) . " " . ($a1-($a2+1)) . " III (GBA)->V (DS)";
			}
			$glc = array_count_values($glist);
			foreach ($glc as $key => $value) {
				echo "$key: $value; ";
			}
			echo "</br>";
		}
		$a1 = 0;
		$a2 = 0;
		$nam = $data[$j]['Species'];
		$snum = array_search($nam,$tkan) + 1;
		$snum = str_pad($snum, 3, '0', STR_PAD_LEFT);
		if($data[$j]['Gen'] == $x1 && $data[$j]['VC'] == $y1){
			$a1++;
		} elseif($data[$j]['Gen'] == $x2 && $data[$j]['VC'] == $y2){
			$a2++;
		}
	} else {
		if($data[$j]['Gen'] == $x1 && $data[$j]['VC'] == $y1){
			$a1++;
		} elseif($data[$j]['Gen'] == $x2 && $data[$j]['VC'] == $y2){
			$a2++;
		}
	}
}

if($a >= 2){
	if($snum != 0){
		echo "<img src='icons/". $snum .".png' border=0>" . $nam. " ". round((($a1/$b1)-(($a2+1)/($b2+1))),5) . " " . ($a1-($a2+1)) . " III (GBA)->V (DS)";
	}
	$glc = array_count_values($glist);
	foreach ($glc as $key => $value) {
		echo "$key: $value; ";
	}
	echo "</br>";
}

$a1 = 0;
$a2 = 0;
$x1 = 3;
$x2 = 6;
$y1 = 1;
$y2 = 3;
$b1 = $gsc[$x1][$y1];
$b2 = $gsc[$x2][$y2];
echo "<br><b>III (GBA)->VI (3DS)</b><br>";
for ($j = 0; $j < $el; $j++){
	if(strcmp($nam, $data[$j]['Species']) != 0){
		if($a1 >= 2  && ($a1/$b1) > (($a2+1)/($b2+1)) && $a1 > $a2){
			if($snum != 0){
				echo "<img src='icons/". $snum .".png' border=0>" . $nam. " " . round((($a1/$b1)-(($a2+1)/($b2+1))),5) . " " . ($a1-($a2+1)) . " III (GBA)->VI (3DS)";
			}
			$glc = array_count_values($glist);
			foreach ($glc as $key => $value) {
				echo "$key: $value; ";
			}
			echo "</br>";
		}
		$a1 = 0;
		$a2 = 0;
		$nam = $data[$j]['Species'];
		$snum = array_search($nam,$tkan) + 1;
		$snum = str_pad($snum, 3, '0', STR_PAD_LEFT);
		if($data[$j]['Gen'] == $x1 && $data[$j]['VC'] == $y1){
			$a1++;
		} elseif($data[$j]['Gen'] == $x2 && $data[$j]['VC'] == $y2){
			$a2++;
		}
	} else {
		if($data[$j]['Gen'] == $x1 && $data[$j]['VC'] == $y1){
			$a1++;
		} elseif($data[$j]['Gen'] == $x2 && $data[$j]['VC'] == $y2){
			$a2++;
		}
	}
}

if($a >= 2){
	if($snum != 0){
		echo "<img src='icons/". $snum .".png' border=0>" . $nam. " ". round((($a1/$b1)-(($a2+1)/($b2+1))),5) . " " . ($a1-($a2+1)) . " III (GBA)->VI (3DS)";
	}
	$glc = array_count_values($glist);
	foreach ($glc as $key => $value) {
		echo "$key: $value; ";
	}
	echo "</br>";
}

$a1 = 0;
$a2 = 0;
$x1 = 3;
$x2 = 7;
$y1 = 1;
$y2 = 3;
$b1 = $gsc[$x1][$y1];
$b2 = $gsc[$x2][$y2];
echo "<br><b>III (GBA)->VII (3DS)</b><br>";
for ($j = 0; $j < $el; $j++){
	if(strcmp($nam, $data[$j]['Species']) != 0){
		if($a1 >= 2  && ($a1/$b1) > (($a2+1)/($b2+1)) && $a1 > $a2){
			if($snum != 0){
				echo "<img src='icons/". $snum .".png' border=0>" . $nam . " " . round((($a1/$b1)-(($a2+1)/($b2+1))),5) . " " . ($a1-($a2+1)) . " III (GBA)->VII (3DS)";
			}
			$glc = array_count_values($glist);
			foreach ($glc as $key => $value) {
				echo "$key: $value; ";
			}
			echo "</br>";
		}
		$a1 = 0;
		$a2 = 0;
		$nam = $data[$j]['Species'];
		$snum = array_search($nam,$tkan) + 1;
		$snum = str_pad($snum, 3, '0', STR_PAD_LEFT);
		if($data[$j]['Gen'] == $x1 && $data[$j]['VC'] == $y1){
			$a1++;
		} elseif($data[$j]['Gen'] == $x2 && $data[$j]['VC'] == $y2){
			$a2++;
		}
	} else {
		if($data[$j]['Gen'] == $x1 && $data[$j]['VC'] == $y1){
			$a1++;
		} elseif($data[$j]['Gen'] == $x2 && $data[$j]['VC'] == $y2){
			$a2++;
		}
	}
}

if($a >= 2){
	if($snum != 0){
		echo "<img src='icons/". $snum .".png' border=0>" . $nam. " ". round((($a1/$b1)-(($a2+1)/($b2+1))),5) . " " . ($a1-($a2+1)) . " III (GBA)->VII (3DS)";
	}
	$glc = array_count_values($glist);
	foreach ($glc as $key => $value) {
		echo "$key: $value; ";
	}
	echo "</br>";
}

$a1 = 0;
$a2 = 0;
$x1 = 4;
$x2 = 5;
$y1 = 2;
$y2 = 2;
$b1 = $gsc[$x1][$y1];
$b2 = $gsc[$x2][$y2];
echo "<br><br><b>IV (DS)->V (DS)</b><br>";
for ($j = 0; $j < $el; $j++){
	if(strcmp($nam, $data[$j]['Species']) != 0){
		if($a1 >= 2  && ($a1/$b1) > (($a2+1)/($b2+1)) && $a1 > $a2){
			if($snum != 0){
				echo "<img src='icons/". $snum .".png' border=0>" . $nam. " " . round((($a1/$b1)-(($a2+1)/($b2+1))),5) . " " . ($a1-($a2+1)) . " IV (DS)->V (DS)";
			}
			$glc = array_count_values($glist);
			foreach ($glc as $key => $value) {
				echo "$key: $value; ";
			}
			echo "</br>";
		}
		$a1 = 0;
		$a2 = 0;
		$nam = $data[$j]['Species'];
		$snum = array_search($nam,$tkan) + 1;
		$snum = str_pad($snum, 3, '0', STR_PAD_LEFT);
		if($data[$j]['Gen'] == $x1 && $data[$j]['VC'] == $y1){
			$a1++;
		} elseif($data[$j]['Gen'] == $x2 && $data[$j]['VC'] == $y2){
			$a2++;
		}
	} else {
		if($data[$j]['Gen'] == $x1 && $data[$j]['VC'] == $y1){
			$a1++;
		} elseif($data[$j]['Gen'] == $x2 && $data[$j]['VC'] == $y2){
			$a2++;
		}
	}
}

if($a >= 2){
	if($snum != 0){
		echo "<img src='icons/". $snum .".png' border=0>" . $nam. " " . round((($a1/$b1)-(($a2+1)/($b2+1))),5) . " " . ($a1-($a2+1)) . " IV (DS)->V (DS)";
	}
	$glc = array_count_values($glist);
	foreach ($glc as $key => $value) {
		echo "$key: $value; ";
	}
	echo "</br>";
}

$a1 = 0;
$a2 = 0;
$x1 = 4;
$x2 = 6;
$y1 = 2;
$y2 = 3;
$b1 = $gsc[$x1][$y1];
$b2 = $gsc[$x2][$y2];
echo "<br><b>IV (DS)->VI (3DS)</b><br>";
for ($j = 0; $j < $el; $j++){
	if(strcmp($nam, $data[$j]['Species']) != 0){
		if($a1 >= 2  && ($a1/$b1) > (($a2+1)/($b2+1)) && $a1 > $a2){
			if($snum != 0){
				echo "<img src='icons/". $snum .".png' border=0>" . $nam. " " . round((($a1/$b1)-(($a2+1)/($b2+1))),5) . " " . ($a1-($a2+1)) . " IV (DS)->VI (3DS)";
			}
			$glc = array_count_values($glist);
			foreach ($glc as $key => $value) {
				echo "$key: $value; ";
			}
			echo "</br>";
		}
		$a1 = 0;
		$a2 = 0;
		$nam = $data[$j]['Species'];
		$snum = array_search($nam,$tkan) + 1;
		$snum = str_pad($snum, 3, '0', STR_PAD_LEFT);
		if($data[$j]['Gen'] == $x1 && $data[$j]['VC'] == $y1){
			$a1++;
		} elseif($data[$j]['Gen'] == $x2 && $data[$j]['VC'] == $y2){
			$a2++;
		}
	} else {
		if($data[$j]['Gen'] == $x1 && $data[$j]['VC'] == $y1){
			$a1++;
		} elseif($data[$j]['Gen'] == $x2 && $data[$j]['VC'] == $y2){
			$a2++;
		}
	}
}

if($a >= 2){
	if($snum != 0){
		echo "<img src='icons/". $snum .".png' border=0>" . $nam. " " . round((($a1/$b1)-(($a2+1)/($b2+1))),5) . " " . ($a1-($a2+1)) . " IV (DS)->VI (3DS)";
	}
	$glc = array_count_values($glist);
	foreach ($glc as $key => $value) {
		echo "$key: $value; ";
	}
	echo "</br>";
}

$a1 = 0;
$a2 = 0;
$x1 = 4;
$x2 = 7;
$y1 = 2;
$y2 = 3;
$b1 = $gsc[$x1][$y1];
$b2 = $gsc[$x2][$y2];
echo "<br><b>IV (DS)->VII (3DS)</b><br>";
for ($j = 0; $j < $el; $j++){
	if(strcmp($nam, $data[$j]['Species']) != 0){
		if($a1 >= 2  && ($a1/$b1) > (($a2+1)/($b2+1)) && $a1 > $a2){
			if($snum != 0){
				echo "<img src='icons/". $snum .".png' border=0>" . $nam. " " . round((($a1/$b1)-(($a2+1)/($b2+1))),5) . " " . ($a1-($a2+1)) . " IV (DS)->VII (3DS)";
			}
			$glc = array_count_values($glist);
			foreach ($glc as $key => $value) {
				echo "$key: $value; ";
			}
			echo "</br>";
		}
		$a1 = 0;
		$a2 = 0;
		$nam = $data[$j]['Species'];
		$snum = array_search($nam,$tkan) + 1;
		$snum = str_pad($snum, 3, '0', STR_PAD_LEFT);
		if($data[$j]['Gen'] == $x1 && $data[$j]['VC'] == $y1){
			$a1++;
		} elseif($data[$j]['Gen'] == $x2 && $data[$j]['VC'] == $y2){
			$a2++;
		}
	} else {
		if($data[$j]['Gen'] == $x1 && $data[$j]['VC'] == $y1){
			$a1++;
		} elseif($data[$j]['Gen'] == $x2 && $data[$j]['VC'] == $y2){
			$a2++;
		}
	}
}

if($a >= 2){
	if($snum != 0){
		echo "<img src='icons/". $snum .".png' border=0>" . $nam. " ". round((($a1/$b1)-(($a2+1)/($b2+1))),5) . " " . ($a1-($a2+1)) . " IV (DS)->VII (3DS)";
	}
	$glc = array_count_values($glist);
	foreach ($glc as $key => $value) {
		echo "$key: $value; ";
	}
	echo "</br>";
}

$a1 = 0;
$a2 = 0;
$x1 = 5;
$x2 = 6;
$y1 = 2;
$y2 = 3;
$b1 = $gsc[$x1][$y1];
$b2 = $gsc[$x2][$y2];
echo "<br><br><b>V (DS)->VI (3DS)</b><br>";
for ($j = 0; $j < $el; $j++){
	if(strcmp($nam, $data[$j]['Species']) != 0){
		if($a1 >= 2  && ($a1/$b1) > (($a2+1)/($b2+1)) && $a1 > $a2){
			if($snum != 0){
				echo "<img src='icons/". $snum .".png' border=0>" . $nam. " " . round((($a1/$b1)-(($a2+1)/($b2+1))),5) . " " . ($a1-($a2+1)) . " V (DS)->VI (3DS)";
			}
			$glc = array_count_values($glist);
			foreach ($glc as $key => $value) {
				echo "$key: $value; ";
			}
			echo "</br>";
		}
		$a1 = 0;
		$a2 = 0;
		$nam = $data[$j]['Species'];
		$snum = array_search($nam,$tkan) + 1;
		$snum = str_pad($snum, 3, '0', STR_PAD_LEFT);
		if($data[$j]['Gen'] == $x1 && $data[$j]['VC'] == $y1){
			$a1++;
		} elseif($data[$j]['Gen'] == $x2 && $data[$j]['VC'] == $y2){
			$a2++;
		}
	} else {
		if($data[$j]['Gen'] == $x1 && $data[$j]['VC'] == $y1){
			$a1++;
		} elseif($data[$j]['Gen'] == $x2 && $data[$j]['VC'] == $y2){
			$a2++;
		}
	}
}

if($a >= 2){
	if($snum != 0){
		echo "<img src='icons/". $snum .".png' border=0>" . $nam. " " . round((($a1/$b1)-(($a2+1)/($b2+1))),5) . " " . ($a1-($a2+1)) . " V (DS)->VI (3DS)";
	}
	$glc = array_count_values($glist);
	foreach ($glc as $key => $value) {
		echo "$key: $value; ";
	}
	echo "</br>";
}

$a1 = 0;
$a2 = 0;
$x1 = 5;
$x2 = 7;
$y1 = 2;
$y2 = 3;
$b1 = $gsc[$x1][$y1];
$b2 = $gsc[$x2][$y2];
echo "<br><b>V (DS)->VII (3DS)</b><br>";
for ($j = 0; $j < $el; $j++){
	if(strcmp($nam, $data[$j]['Species']) != 0){
		if($a1 >= 2  && ($a1/$b1) > (($a2+1)/($b2+1)) && $a1 > $a2){
			if($snum != 0){
				echo "<img src='icons/". $snum .".png' border=0>" . $nam. " " . round((($a1/$b1)-(($a2+1)/($b2+1))),5) . " " . ($a1-($a2+1)) . " V (DS)->VII (3DS)";
			}
			$glc = array_count_values($glist);
			foreach ($glc as $key => $value) {
				echo "$key: $value; ";
			}
			echo "</br>";
		}
		$a1 = 0;
		$a2 = 0;
		$nam = $data[$j]['Species'];
		$snum = array_search($nam,$tkan) + 1;
		$snum = str_pad($snum, 3, '0', STR_PAD_LEFT);
		if($data[$j]['Gen'] == $x1 && $data[$j]['VC'] == $y1){
			$a1++;
		} elseif($data[$j]['Gen'] == $x2 && $data[$j]['VC'] == $y2){
			$a2++;
		}
	} else {
		if($data[$j]['Gen'] == $x1 && $data[$j]['VC'] == $y1){
			$a1++;
		} elseif($data[$j]['Gen'] == $x2 && $data[$j]['VC'] == $y2){
			$a2++;
		}
	}
}

if($a >= 2){
	if($snum != 0){
		echo "<img src='icons/". $snum .".png' border=0>" . $nam. " ". round((($a1/$b1)-(($a2+1)/($b2+1))),5) . " " . ($a1-($a2+1)) . " V (DS)->VII (3DS)";
	}
	$glc = array_count_values($glist);
	foreach ($glc as $key => $value) {
		echo "$key: $value; ";
	}
	echo "</br>";
}

$a1 = 0;
$a2 = 0;
$x1 = 6;
$x2 = 7;
$y1 = 3;
$y2 = 3;
$b1 = $gsc[$x1][$y1];
$b2 = $gsc[$x2][$y2];
echo "<br><br><b>VI (3DS)->VII (3DS)</b><br>";
for ($j = 0; $j < $el; $j++){
	if(strcmp($nam, $data[$j]['Species']) != 0){
		if($a1 >= 2  && ($a1/$b1) > (($a2+1)/($b2+1)) && $a1 > $a2){
			if($snum != 0){
				echo "<img src='icons/". $snum .".png' border=0>" . $nam. " " . round((($a1/$b1)-(($a2+1)/($b2+1))),5) . " " . ($a1-($a2+1)) . " VI (3DS)->VII (3DS)";
			}
			$glc = array_count_values($glist);
			foreach ($glc as $key => $value) {
				echo "$key: $value; ";
			}
			echo "</br>";
		}
		$a1 = 0;
		$a2 = 0;
		$nam = $data[$j]['Species'];
		$snum = array_search($nam,$tkan) + 1;
		$snum = str_pad($snum, 3, '0', STR_PAD_LEFT);
		if($data[$j]['Gen'] == $x1 && $data[$j]['VC'] == $y1){
			$a1++;
		} elseif($data[$j]['Gen'] == $x2 && $data[$j]['VC'] == $y2){
			$a2++;
		}
	} else {
		if($data[$j]['Gen'] == $x1 && $data[$j]['VC'] == $y1){
			$a1++;
		} elseif($data[$j]['Gen'] == $x2 && $data[$j]['VC'] == $y2){
			$a2++;
		}
	}
}

if($a >= 2){
	if($snum != 0){
		echo "<img src='icons/". $snum .".png' border=0>" . $nam. " " . round((($a1/$b1)-(($a2+1)/($b2+1))),5) . " " . ($a1-($a2+1)) . " VI (3DS)->VII (3DS)";
	}
	$glc = array_count_values($glist);
	foreach ($glc as $key => $value) {
		echo "$key: $value; ";
	}
	echo "</br>";
}
/*
for ($j = 0; $j < $el; $j++){
	if(strcmp($nam, $data[$j]['Species']) != 0){
		if($snum != 0){
			echo "<img src='icons/". $snum .".png' border=0>" . $nam. "; ";
		}
		$glc = array_count_values($glist);
		foreach ($glc as $key => $value) {
			echo "$key: $value; ";
		}
		echo "</br>";
		$glist = [];
		$glist[] = $data[$j]['Gen'];
		$nam = $data[$j]['Species'];
		$snum = array_search($nam,$tkan) + 1;
		$snum = str_pad($snum, 3, '0', STR_PAD_LEFT);
	} else {
		$glist[] = $data[$j]['Gen'];
	}
}

	if($snum != 0){
		echo "<img src='icons/". $snum .".png' border=0>" . $nam. "; ";
	}
	$glc = array_count_values($glist);
	foreach ($glc as $key => $value) {
		echo "$key: $value; ";
	}
	echo "</br>";
*/
function mySort($a, $b)
{
    $diff = (int)$a['LNum'] - (int)$b['LNum'];
	if($diff == 0){ 
		$diff = (int)$a['GNum'] - (int)$b['GNum'];
		if($diff == 0){	
			$diff = (int)$a['Lv'] - (int)$b['Lv'];
			if($diff == 0){
				$diff = strcmp($a['Ball'],$b['Ball']);
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

?>
</html>