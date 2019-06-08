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

$myfile = fopen("pokedata.json", "r") or die("Unable to open file!");
$jin = fread($myfile,filesize("pokedata.json"));
$poke = json_decode($jin, true);

$arra = [];
$arrb = [];

$act = [];
$bct = [];

$trade = true;

foreach($poke as $p){
	if($p['Game'] === "Yellow [Juan]"){
		array_push($arra, $p);
	} else if($p['Game'] === "Silver [Yuna]"){
		array_push($arrb, $p);
	}
}

$ca = sizeof($arra);
$cb = sizeof($arrb);

foreach($arra as $a){
	array_push($act,$a['Species']);
	$mnum = sizeof($a['Moves']);
	for($m = 0; $m < $mnum; $m++){
		array_push($act,$a['Moves'][$m]);
	}
}

$act = array_count_values($act);

foreach($arrb as $b){
	array_push($bct,$b['Species']);
	$mnum = sizeof($b['Moves']);
	for($m = 0; $m < $mnum; $m++){
		array_push($bct,$b['Moves'][$m]);
	}
}

$bct = array_count_values($bct);

$vala = [];

foreach($arra as $p){
	$t = array(0,0,0,0,0);
	
	$t[0] = (($act[$p['Species']]-1)/$ca);
	if(array_key_exists($p['Species'],$bct)){
		$t[0] = $t[0] - (($bct[$p['Species']])/$cb);
	}
	
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
	
	$t[0] = (($bct[$p['Species']]-1)/$cb);
	if(array_key_exists($p['Species'],$act)){
		$t[0] = $t[0] - (($act[$p['Species']])/$ca);
	}
	
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
foreach($vala as $v){
	echo $v[1];
}
?>
</div><div class="col-xs-6">
<?php
if($trade){
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