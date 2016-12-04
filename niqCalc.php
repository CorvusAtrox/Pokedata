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

$off = 0;

if(isset($_COOKIE["off"])){
	$off = $_COOKIE["off"];
} else {
	setCookie("off",$off);
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


$el = count($data);

$nar = [""];

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

Name: <input type="text" id="name" name="name" style="border:0px;background-color:#00FF00;" size="12" onchange="turnText('name')" value="<?= $name ?>" />
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
<br>
Species: <input type="text" id="species" name="species" style="border:0px;background-color:#00FF00;" size="12" onchange="turnText('species')" value="<?= $species ?>" />
<?php
	
?>
<br>

<form action="index.php" method="post">
<p class="shug"><input type="submit" value="Back">
</form>

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