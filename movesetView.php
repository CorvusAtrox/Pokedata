<html>
<title>Moveset View</title>
<style>
body {
    background-color: #9EDA71;
}

.shug { display:block;text-align:center;width:50%;margin-right:200px;}
.split-para      { display:block;margin:10px;}
.split-para span { display:block;float:right;width:50%;margin-left:10px;}
</style>
<?php

$off = $_COOKIE['off'];
$jin = file_get_contents("pokedata.json") or die("Unable to open file!");
$data = json_decode($jin, true);
$mnum = $_COOKIE['mNum'];

$dex = file("NatLine Dex.txt");
$tdex = array_map('trim',$dex);

$el = count($data);

if(isset($_COOKIE["off"])){
	$off = $_COOKIE["off"];
} else {
	setCookie("off",$off);
}

if(isset($_COOKIE["mNum"])){
	$mnum = $_COOKIE["mNum"];
} else {
	setCookie("mNum",$mnum);
}

$snum = str_pad(($mnum+1), 3, '0', STR_PAD_LEFT);

echo $tdex[$mnum]." (".($mnum+1).")";
?>
<p class="shug">
<input type="button" onClick="start()" value = "|<"/>
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
<input type="button" onClick="end()" value = ">|"/>
</p>
<?php
	$spmoves = [];
	for ($j = 0; $j < $el; $j++){
		if($data[$j]['LNum'] == $mnum){
			$spmoves = array_unique(array_merge($spmoves,$data[$j]['Moves']), SORT_REGULAR);
		}
	}

	$moves = fopen("movesets/".$snum.".txt", "r");
	if ($moves) {
		while (($line = fgets($moves)) !== false) {
			$line = trim($line);
			if(in_array($line,$spmoves)){
				echo "<font color='blue'>".$line."</font><br>";
			} else {
				echo $line."<br>";
			}
			
		}
		fclose($moves);
	} else {
		$f = fopen("movesets/".$snum.".txt", "w");
		fclose($f);
	} 
	
?>
<script>

var dexNum = 809;

function indInc(p1) {
	o = parseInt(getCookie('mNum'));
	if(o+p1 < dexNum-1){
		setCookie("mNum",o+p1);
	} else {
		setCookie("mNum",dexNum-1);
	}
	window.location.reload();
}
function indDec(p1) {
	o = parseInt(getCookie('mNum'));
	if(o > p1-1){
		setCookie("mNum",o-p1);
	} else {
		setCookie("mNum",0);
	}
	window.location.reload();
}
function start() {
	setCookie("mNum",0);
	window.location.reload();
}
function end(){
	setCookie("mNum",dexNum-1);
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