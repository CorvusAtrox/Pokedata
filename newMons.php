<html>
<title>New Mons</title>
<style>
body {
    background-color: #00FF00;
}

.shug { display:block;text-align:center;width:50%;margin-right:200px;}
.split-para      { display:block;margin:10px;}
.split-para span { display:block;float:right;width:50%;margin-left:10px;}
</style>
<body>
<?php 

error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
	
	$off = $_COOKIE['off'];
	setCookie("firs",$_POST['from']);
	setCookie("las",$_POST['to']);
	$jin = file_get_contents("pokedata.json") or die("Unable to open file!");
	$data = json_decode($jin, true);
	
	$el = count($data);
?>	
	<form action="newMons.php" method="post">
	From: <select id="from" name="from" style="border:0px;background-color:#00FF00;"/>
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
	To: <select id="to" name="to" style="border:0px;background-color:#00FF00;"/>
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
	<p class="shug"><input type="submit" value="Generate New">
	</form>
	<form action="index.php" method="post">
	<p class="shug"><input type="submit" value="Back">
	</form>

	<?php	
	usort($data, 'gameSort');
	
	$kanto = file("kanto.txt");
	$kanto[0] = "Bulbasaur";
	$kanto = array_filter(array_map('trim', $kanto));
	$gen = array();
	$gen[1] = array_slice($kanto,0,151);
	$gen[2] = array_slice($kanto,0,251);
	$gen[3] = array_slice($kanto,0,386);
	$gen[4] = array_slice($kanto,0,493);
	$gen[5] = array_slice($kanto,0,649);
	$gen[6] = array_slice($kanto,0,721);
	$gen[7] = array_slice($kanto,0,802);
	$ga = file("gameList.txt");
	$tga=array_map('trim',$ga);
	
	$spec = array();
	$fn = array_search($_COOKIE["firs"],$tga);
	$ln = array_search($_COOKIE["las"],$tga);
	$nam = false;
	for($j = 0; $j < $el; $j++){
		if($data[$j]['GNum'] >= $fn and $data[$j]['GNum'] <= $ln){
			array_push($spec, $data[$j]['Species']);
			$gnm = $data[$j]['Gen'];
		}
	}
	$nha = array_diff($gen[$gnm],$spec);
	$nha2= array();
	foreach($nha as $mon){
		array_push($nha2,$mon);
	}
	$html = file_get_contents('https://www.random.org/integers/?num=1&min=1&max='. count($nha) .'&col=1&base=10&format=plain&rnd=new');
	$shug = (int)$html;
	echo 'Result: ' . $nha2[$shug-1] . ' ' . $shug . ' ' . count($nha) .'<br>';
	var_dump($nha2);
	echo "<br>";
function gameSort($a, $b)
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

</body>
</html>