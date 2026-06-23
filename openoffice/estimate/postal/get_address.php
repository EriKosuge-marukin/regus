<?php
$datapath="./jsontext";
$data=array("pref"=>"", "city"=>"","town"=>"");
if($_POST["postcode"]){
	if(strlen($_POST["postcode"])>=3){
		$code3=substr($_POST["postcode"], 0, 3);
		if(file_exists("{$datapath}/{$code3}/pref.txt")){
			$json_txt = file_get_contents("{$datapath}/{$code3}/pref.txt");
			$json_data=json_decode($json_txt,true);
			$data["pref"]=$json_data["p"];
		}

		if(file_exists("{$datapath}/{$code3}/address.txt")){
			$json_txt = file_get_contents("{$datapath}/{$code3}/address.txt");
			$json_data=json_decode("{".$json_txt."}",true);
			if(isset($json_data["c_".$_POST["postcode"]])){
				$data["pref"]=$json_data["c_".$_POST["postcode"]]["p"];
				$data["city"]=$json_data["c_".$_POST["postcode"]]["c"];
				$data["town"]=$json_data["c_".$_POST["postcode"]]["a"];
			}
		}
	}
}
echo json_encode($data);
?>
