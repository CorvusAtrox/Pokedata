<html>
<body>
<?php 

	$off = $_COOKIE['off'];
	$jin = file_get_contents("pokedata.json") or die("Unable to open file!");
	$data = json_decode($jin, true);

	$_POST = array_filter($_POST);
	if($_POST['name']){
		$data[$off]['Name'] = $_POST['name'];	
	}
	if($_POST['lv']){
		$data[$off]['Lv'] = (int)$_POST['lv'];	
	}
	if($_POST['gender']){
		$data[$off]['Gender'] = $_POST['gender'];	
	}
	if($_POST['species']){
		$data[$off]['Species'] = $_POST['species'];	
	}
	if($_POST['ability']){
		$data[$off]['Ability'] = $_POST['ability'];	
	}
	if($_POST['nature']){
		$data[$off]['Nature'] = $_POST['nature'];	
	}
	if($_POST["moves"]){
		$data[$off]['Moves'] = array_filter($_POST["moves"]);
		if(empty($data[$off]['Moves'][0])){
			unset($data[$off]['Moves']);
		}
	}
	if($_POST['ot']){
		$data[$off]['OT'] = $_POST['ot'];	
	}
	if($_POST['idn']){
		$data[$off]['ID'] = $_POST['idn'];	
	}
	if($_POST['game']){
		$data[$off]['Game'] = $_POST['game'];	
	}
	$gam = fopen("gameList.txt", "r");
	$games = [];
	while(! feof($gam)){
		$l = fgets($gam);
		$g = explode(',',$l);
		array_push($games,$g[0]);
		if($data[$off]['Game'] === $g[0]){
			$data[$off]['Gen'] = $g[1];
			$data[$off]['System'] = $g[2];
		}
	}
	fclose($gam);
	if($_POST['trainer']){
		$data[$off]['Trainer'] = $_POST['trainer'];	
	}
	if($_POST['lang']){
		$data[$off]['Lang'] = $_POST['lang'];	
	}
	if($_POST['ball']){
		$data[$off]['Ball'] = $_POST['ball'];	
	}
	if($_POST['forme']){
		$data[$off]['Forme'] = $_POST['forme'];	
	}
	if($_POST['shine']){
		$data[$off]['Shiny'] = $_POST['shine'];	
	}
	if($_POST['pkrs']){
		$data[$off]['Pkrs'] = $_POST['pkrs'];	
	}
	if($_POST['hp']){
		$data[$off]['HP'] = (int)$_POST['hp'];	
	}
	if($_POST['atk']){
		$data[$off]['Atk'] = (int)$_POST['atk'];	
	}
	if($_POST['def']){
		$data[$off]['Def'] = (int)$_POST['def'];	
	}
	if($_POST['sat']){
		$data[$off]['SAt'] = (int)$_POST['sat'];	
	}
	if($_POST['sde']){
		$data[$off]['SDe'] = (int)$_POST['sde'];	
	}
	if($_POST['spd']){
		$data[$off]['Spd'] = (int)$_POST['spd'];	
	}
	
	$jen = json_encode($data);
		//echo $jen;
		
		$len = strlen($jen); 
		$new_json = "";
		for($c = 0; $c < $len; $c++) 
		{ 
			$char = $jen[$c];
			if($c+1 < $len){
				$nchar = $jen[$c+1];
			}
			switch($nchar) 
			{ 
				case '{': 
					$new_json .= $char . "\n";
					break; 
				default: 
					$new_json .= $char; 
					break;                    
			} 
		} 
		
		$myfile = fopen("pokedata.json.new", "w") or die("Unable to open file!");
		fwrite($myfile, $new_json);
		fclose($myfile);
		rename("pokedata.json.new","pokedata.json");
	
	header('Location: index.php');
	die();
?>

</body>
</html>