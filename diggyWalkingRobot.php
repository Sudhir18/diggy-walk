<?php
	
	$directionConfig = array(
							'SOUTH' => array(
											 'R'=>array('WEST','X','-'),
											 'L'=>array('EAST','X','+')
											),

							'NORTH' => array(
											 'R'=>array('EAST','X','+'),
											 'L'=>array('WEST','X','-')
											),

							'EAST' => array(
											 'R'=>array('SOUTH','Y','-'),
											 'L'=>array('NORTH','Y','+')
											),
							'WEST' => array(
											 'R'=>array('NORTH','Y','+'),
											 'L'=>array('SOUTH','Y','-')
											),


						);

	


	function getCurrentPosition(&$currentX,&$currentY,&$currentD,$turn,$unit){
				global $directionConfig;
				$nextParam = $directionConfig[$currentD][$turn];
				if($nextParam[1] == 'X'){
					$currentX= getCurrentXY($currentX,$unit,$nextParam[2]);
				}else{
					$currentY= getCurrentXY($currentY,$unit,$nextParam[2]);
				}

				$currentD=$nextParam[0];	


	}

	function getCurrentXY($currentValue,$unit,$op){

		if($op == '+'){
			return $currentValue+$unit;
		}else{
			return $currentValue-$unit;
		}

	}


	
/*
	$inputString = '5 2 SOUTH RW2LW4R';
	$inputs = explode(" ", $inputString);


	$currentX=$inputs[0];
	$currentY=$inputs[1];
	$currentD=$inputs[2];
	$path=$inputs[3];

*/

	$currentX=$argv[1];
	$currentY=$argv[2];
	$currentD=$argv[3];
	$path=$argv[4];

	$pathUnit = str_split($path,3);

	if($pathUnit){

		foreach ($pathUnit as $key => $walk) {
			# code...

			if($walk[1]&&$walk[2]){

			getCurrentPosition($currentX,$currentY,$currentD,$walk[0],$walk[2]);		

			}else{
				$currentD = $directionConfig[$currentD][$walk[0]][0];
			}
		}
	}

//	echo "$currentX $currentY $currentD";
	print "{$currentX} {$currentY} {$currentD}";

?>