<?php



	$main = $_GET['digits'];
	$test = str_replace(' ', '', $main);
	$new_a = str_split($test);


	function strFilter($new_ar){

		$int_range = ["0","1","2","3","4","5","6","7","8","9","."];
		$results = [];
		$arr_test = [];
		

		for($p = 0;$p < count($new_ar); $p++){
			
			if($new_ar[0] == "-"){
				array_push($arr_test, $new_ar[0]);
				$new_ar[0] = " ";
			}
			elseif($new_ar[$p] == "-" && is_string(end($results))){
				array_push($arr_test, $new_ar[$p]);
			}
			elseif(in_array($new_ar[$p], $int_range)){
				
				array_push($arr_test, $new_ar[$p]);

				if($p == count($new_ar)-1){
					array_push($results, numConv($arr_test));
				}

			}
			elseif(is_string($new_ar[$p])){	
				
				if(!empty($arr_test)){
					array_push($results, numConv($arr_test));
					$arr_test=[];
				}
				array_push($results, $new_ar[$p]);

			}

		}
		return $results;

	}

		print_r(strFilter($new_a));

	function numConv($arr){
		$n = in_array(".", $arr) ? floatval(implode("",$arr)) : intval(implode("",$arr));
		return $n;
	}

	function calcLogic($a,$mode,$b){
		
		switch ($mode) {
		    case "+":
		        return $a + $b;
		        break;
		    case "-":
		        return $a - $b;
		        break;
		    case "x":
		        return $a * $b;
		        break;
		    case "/":
		        return $a / $b;
		        break;
		    case "^":
		        return pow($a , $b);
		        break;
		}

	}

	function orderPar($arrr){

		$par_ar = [];

			for($x = 0;$x < count($arrr); $x++){

				if($arrr[$x] == "("){

					$arrr[$x] = " ";

					for($i = $x+1;$i < count($arrr);$i++){

						if($arrr[$i] == ")"){
							$arrr[$i] = calcUp(runIt($par_ar));
							$arrr = cleanPar($arrr);
							return orderPar($arrr);

						}else{
							array_push($par_ar, $arrr[$i]);
							$arrr[$i] = " ";
							print_r($par_ar);
						}

					}

				}

			}
		$arrr = cleanPar($arrr);
		return $arrr;
	}

	function cleanPar($arrr){

		for($x = 0;$x<count($arrr);$x++){
			
			if($arrr[$x] == " "){
				unset($arrr[$x]);
			}
		}

		$arrr = array_values($arrr);
		return $arrr;
	}


	function mulDiv($arrr){

		$par_ar = [];
		
		for($x = 0;$x < count($arrr); $x++){
			if($arrr[$x] === "x" || $arrr[$x] === "/"){
				array_push($par_ar,$arrr[$x-1]);
				array_push($par_ar,$arrr[$x]);
				array_push($par_ar,$arrr[$x+1]);
				
				$arrr[$x] = calcUp($par_ar);

				unset($arrr[$x-1]);
				unset($arrr[$x+1]);

				$arrr = array_values($arrr);

				return mulDiv($arrr);

			}
		}

		return $arrr;
	}


	function expo($arrr){

		$par_ar = [];
		
		for($x = 0;$x < count($arrr); $x++){
			if($arrr[$x] === "^"){
				array_push($par_ar,$arrr[$x-1]);
				array_push($par_ar,$arrr[$x]);
				array_push($par_ar,$arrr[$x+1]);
				
				$arrr[$x] = calcUp($par_ar);

				unset($arrr[$x-1]);
				unset($arrr[$x+1]);

				$arrr = array_values($arrr);

				return expo($arrr);

			}
		}

		return $arrr;
	}



	function calcUp($arrr){

		if(count($arrr) == 1){
			$calced = is_float($arrr[0]) ? number_format($arrr[0],5,".",""): $arrr[0];
			return $calced;
		}else{

			for($x = 0 ;$x < count($arrr);$x++){
				
				if(is_string($arrr[$x])){
					
					$ans = calcLogic($arrr[$x-1],$arrr[$x],$arrr[$x+1]);
					
					$arrr[$x] = $ans;
					unset($arrr[$x-1]);
					unset($arrr[$x+1]);

					$arrr = array_values($arrr);
					
					return calcUp($arrr);
				}

			}
		}		
	}


	function runIt($arrr){
		$uuu = expo($arrr);
		$uuu = mulDiv($uuu);
		return $uuu;
	}

	$answer = calcUp(runIt(orderPar(strFilter($new_a)))); 


	header("Location: /?answer=$answer")

?>