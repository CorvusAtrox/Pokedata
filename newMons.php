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
	$jin = file_get_contents("pokedata.json") or die("Unable to open file!");
	$data = json_decode($jin, true);
	
	$el = count($data);
	
	usort($data, 'gameSort');
	
	$kanto = file("kanto.txt");
	$kanto = array_filter(array_map('trim', $kanto));
	$gen = array();
	$gen[0] = array_slice($kanto,0,151);
	$gen[1] = array_slice($kanto,0,251);
	$gen[2] = array_slice($kanto,0,386);
	$gen[3] = array_slice($kanto,0,493);
	$gen[4] = array_slice($kanto,0,649);
	$gen[5] = array_slice($kanto,0,721);
	
	$spec = array();
	$gn = 0;
	$gnm = 0;
	$nam = 'Red [Dustin]';
	for($j = 0; $j < $el; $j++){
		if($data[$j]['GNum'] == $gn){
			array_push($spec, $data[$j]['Species']);
		} else if ($data[$j]['Game'] == "Ranch"){
			$gn++;
		}else {
			$nha = array_diff($gen[$gnm],$spec);
			$nha2= array();
			foreach($nha as $mon){
				array_push($nha2,$mon);
			}
			$html = file_get_contents('https://www.random.org/integers/?num=1&min=0&max='. count($nha) .'&col=1&base=10&format=plain&rnd=new');
			$shug = (int)$html;
			echo $nam . ': ' . $nha2[$shug-1] . ' ' . $shug . ' ' . count($nha) . '<br>';
			$spec = array();
			$gn = $data[$j]['GNum'];
			$gnm = $data[$j]['Gen'] - 1;
			$nam = $data[$j]['Game'];
			array_push($spec, $data[$j]['Species']);
		}
	}
	$nha = array_diff($gen[$gnm],$spec);
	$nha2= array();
	foreach($nha as $mon){
		array_push($nha2,$mon);
	}
	$html = file_get_contents('https://www.random.org/integers/?num=1&min=0&max='. count($nha) .'&col=1&base=10&format=plain&rnd=new');
	$shug = (int)$html;
	echo $nam . ': ' . $nha2[$shug-1] . ' ' . $shug . ' ' . count($nha) .'<br>';
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