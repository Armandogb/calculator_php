<?php



	$main = $_GET['digits'];
	$test = str_replace(' ', '', $main);
	$new_a = str_split($test);



	function strFilter($new_ar){

		$results = [];
		$arr_test = [];
		$int_range = ["0","1","2","3","4","5","6","7","8","9","."];

		for($p = 0;$p < count($new_ar); $p++){
			
			if($new_ar[0] == "-"){
				array_push($arr_test, $new_ar[0]);
				$new_ar[0] = "";
			}
			elseif(in_array($new_ar[$p], $int_range)){
				
				array_push($arr_test, $new_ar[$p]);

				if($p == count($new_ar)-1){
					array_push($results, numConv($arr_test));
				}

			}
			elseif(is_string($new_ar[$p])){	
				array_push($results, numConv($arr_test));
				array_push($results, $new_ar[$p]);

					$arr_test=[];
			}

		}
		return $results;

	}

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

				if($arrr[$x] == ")"){

					$arrr[$x] = calcUp(runIt(cleanPar($par_ar)));
					$arrr = array_filter($arrr);
					$arrr = array_values($arrr);
					return orderPar($arrr);
				}
				else{
					array_push($par_ar, $arrr[$x]);
					$arrr[$x]=" ";
				}

			}
			
			return $arrr;

	}

	function cleanPar($arrr){

		$clean = [];

		for($x = 0;$x<count($arrr);$x++){
			
			if($arrr[$x] != "(" or $arrr[$x] != ")"){
				array_push($clean, $arrr[$x]);
			}
		};

		return $clean;
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

	
	$answer = calcUp(runIt(strFilter($new_a))); 

	header("Location: /?answer=$answer")

?>