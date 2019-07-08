<html>
<title>Exchange</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<style>
body {
    background-color: #9EDA71;
}

.shug { display:block;text-align:center;width:50%;margin-right:200px;}
.split-para      { display:block;margin:10px;}
.split-para span { display:block;float:right;width:50%;margin-left:10px;}
</style>
<body>
<div class="container-fluid"><div class="row">
<?php

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);


$myfile = fopen("pokedata.json", "r") or die("Unable to open file!");
$jin = fread($myfile,filesize("pokedata.json"));
$poke = json_decode($jin, true);

$arra = [];
$arrb = [];

$act = [];
$bct = [];

$acl = [];
$bcl = [];

$gama = "Gold [Dorothy]";
$gamb = "Crystal [Catria]";

$trade = true;

foreach($poke as $p){
	if($p['Game'] === $gama){
		array_push($arra, $p);
	} else if($p['Game'] === $gamb){
		array_push($arrb, $p);
	}
}

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

$ca = sizeof($arra);
$cb = sizeof($arrb);

foreach($arra as $a){
	array_push($act,$a['Species']);
	array_push($acl,$lines[$a['Species']]);
	$mnum = sizeof($a['Moves']);
	for($m = 0; $m < $mnum; $m++){
		array_push($act,$a['Moves'][$m]);
	}
}

$act = array_count_values($act);
$acl = array_count_values($acl);

foreach($arrb as $b){
	array_push($bct,$b['Species']);
	array_push($bcl,$lines[$b['Species']]);
	$mnum = sizeof($b['Moves']);
	for($m = 0; $m < $mnum; $m++){
		array_push($bct,$b['Moves'][$m]);
	}
}

$bct = array_count_values($bct);
$bcl = array_count_values($bcl);

$vala = [];

foreach($arra as $p){
	$t = array(0,0,0,0,0);
	
	$t[0] = (($act[$p['Species']]-1)/$ca) * 2;
	$t[0] += (($acl[$lines[$p['Species']]]-1)/$ca);
	if(array_key_exists($p['Species'],$bct)){
		$t[0] -= (($bct[$p['Species']])/$cb) * 2;
		$t[0] -= (($bcl[$lines[$p['Species']]]-1)/$cb);
	}
	$t[0] = $t[0]/3;
	
	$mnum = sizeof($p['Moves']);
	for($m = 0; $m < $mnum; $m++){
		$t[$m+1] = (($act[$p['Moves'][$m]]-1)/$ca);
		if(array_key_exists($p['Moves'][$m],$bct)){
			$t[$m+1] = $t[$m+1] - (($bct[$p['Moves'][$m]])/$cb);
		}
		$t[$m+1] = $t[$m+1]/4;
	}
	$tot = round(array_sum($t),5);
	
	$text = $p['Name'] . ": ";
	if($t[0] > 0) {
		$text .= "<font color='blue'>" . $p['Species'] . "</font> [";
	} else if ($t[0] < 0) {
		$text .= "<font color='red'>" . $p['Species'] . "</font> [";
	} else {
		$text .= $p['Species'] . " [";
	}
	$mnum = sizeof($p['Moves']);
	for($m = 0; $m < $mnum; $m++){
		if($t[$m+1] > 0) {
			$text .= " <font color='blue'>" . $p['Moves'][$m]. "</font>";
		} else if ($t[$m+1] < 0) {
			$text .= " <font color='red'>" . $p['Moves'][$m]. "</font>";
		} else {
			$text .= " " . $p['Moves'][$m];
		}
	}
	$text .= "] (" . $tot . ") <br>";
	
	array_push($vala, array($tot,$text));
}

$valb = [];

foreach($arrb as $p){
	$t = array(0,0,0,0,0);
	
	$t[0] = (($bct[$p['Species']]-1)/$cb) * 2;
	$t[0] += (($bcl[$lines[$p['Species']]]-1)/$cb);
	if(array_key_exists($p['Species'],$act)){
		$t[0] -= (($act[$p['Species']])/$ca) * 2;
		$t[0] -= (($acl[$lines[$p['Species']]]-1)/$ca);
	}
	$t[0] = $t[0]/3;
	
	$mnum = sizeof($p['Moves']);
	for($m = 0; $m < $mnum; $m++){
		$t[$m+1] = (($bct[$p['Moves'][$m]]-1)/$cb);
		if(array_key_exists($p['Moves'][$m],$act)){
			$t[$m+1] = $t[$m+1] - (($act[$p['Moves'][$m]])/$ca);
		}
		$t[$m+1] = $t[$m+1]/4;
	}
	$tot = round(array_sum($t),5);
	
	$text = $p['Name'] . ": ";
	if($t[0] > 0) {
		$text .= "<font color='blue'>" . $p['Species'] . "</font> [";
	} else if ($t[0] < 0) {
		$text .= "<font color='red'>" . $p['Species'] . "</font> [";
	} else {
		$text .= $p['Species'] . " [";
	}
	$mnum = sizeof($p['Moves']);
	for($m = 0; $m < $mnum; $m++){
		if($t[$m+1] > 0) {
			$text .= " <font color='blue'>" . $p['Moves'][$m]. "</font>";
		} else if ($t[$m+1] < 0) {
			$text .= " <font color='red'>" . $p['Moves'][$m]. "</font>";
		} else {
			$text .= " " . $p['Moves'][$m];
		}
	}
	$text .= "] (" . $tot . ") <br>";
	
	array_push($valb, array($tot,$text));
}

usort($vala,'diffSort');
usort($valb,'diffSort');

?>
<div class="col-xs-6">
<?php
echo "<b>" . $gama . "</b></br>";
foreach($vala as $v){
	echo $v[1];
}
?>
</div><div class="col-xs-6">
<?php
if($trade){
	echo "<b>" . $gamb . "</b></br>";
	foreach($valb as $v){
		echo $v[1];
	}
}
?>
</div>
<?php
function diffSort($a, $b)
{
    return $a[0] < $b[0];
}
?>
</div></div>
</body>