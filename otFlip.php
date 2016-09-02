<html>
<body>
<?php 

	$off = $_COOKIE['off'];
	$jin = file_get_contents("pokedata.json") or die("Unable to open file!");
	$data = json_decode($jin, true);
	
	$el = count($data);
	
	for ($j = 0; $j < $el; $j++){
		$ot = $data[$j]['OT'];
		if(strrpos($ot,'(')){
			$data[$j]['OT'] = substr($ot,strrpos($ot,'(')+1,-1).' ('.substr($ot,0,strrpos($ot,'(')-1).')';
		} else {
			$data[$j]['OT'] = "";
		}
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
	
	$natue = file("otList.txt");
	$natures=array_map('trim',$natue);
	$naid = array();
		
	$fp = fopen('otList.txt',"w");
	foreach($natures as $na){
		//array_push($naid, substr($na,strrpos($na,'(')+1,-1).' ('.substr($na,0,strrpos($na,'(')-1).')');
		fwrite($fp, substr($na,strrpos($na,'(')+1,-1).' ('.substr($na,0,strrpos($na,'(')-1).')'.PHP_EOL);
	}
	
	//file_put_contents('otList.txt', $naid . PHP_EOL, FILE_APPEND | LOCK_EX);  
	
?>

</body>
</html>