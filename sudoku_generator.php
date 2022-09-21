<?php

$grid = array();
$grid[] = array(0,0,0,0,0,0,0,0,0);
$grid[] = array(0,0,0,0,0,0,0,0,0);
$grid[] = array(0,0,0,0,0,0,0,0,0);
$grid[] = array(0,0,0,0,0,0,0,0,0);
$grid[] = array(0,0,0,0,0,0,0,0,0);
$grid[] = array(0,0,0,0,0,0,0,0,0);
$grid[] = array(0,0,0,0,0,0,0,0,0);
$grid[] = array(0,0,0,0,0,0,0,0,0);
$grid[] = array(0,0,0,0,0,0,0,0,0);

function isFilled($grid){
  for($i = 0; $i < 9; $i++){
      for($j = 0; $j < 9; $j++){
          if($grid[$i][$j]==0)
          return false;
      }
  }
  return true;
}

#A backtracking/recursive function to check all possible combinations of numbers until a solution is found
function isSolveable(&$grid){
    global $counter;
    $row = 0;
    $col = 0;
    #Find next empty cell
    for($i = 0; $i < 81; $i++){
        $row = floor($i / 9);
        $col = $i % 9;
        if($grid[$row][$col] == 0){
            for($value = 1; $value <= 9; $value++){
                #Check that this value has not already be used on this row
                if(!in_array($value, $grid[$row])) {
                    #Check that this value has not already be used on this column
                    if(!in_array($value, array($grid[0][$col],$grid[1][$col],$grid[2][$col],$grid[3][$col],$grid[4][$col],$grid[5][$col],$grid[6][$col],$grid[7][$col],$grid[8][$col]))){
                        #Identify which of the 9 squares we are working on
                        $square = array();
                        if($row < 3){
                            if($col < 3){
                                for($l = 0; $l < 3; $l++){
                                    $square[] = array($grid[$l][0], $grid[$l][1], $grid[$l][2]);
                                }
                            }else if($col < 6){
                                for($l = 0; $l < 3; $l++){
                                    $square[] = array($grid[$l][3], $grid[$l][4], $grid[$l][5]);
                                }
                            }else{
                                for($l = 0; $l < 3; $l++){
                                    $square[] = array($grid[$l][6], $grid[$l][7], $grid[$l][8]);
                                }
                            }
                        }else if($row < 6){
                            if($col < 3){
                                for($l = 3; $l < 6; $l++){
                                    $square[] = array($grid[$l][0], $grid[$l][1], $grid[$l][2]);
                                }
                            }else if($col < 6){
                                for($l = 3; $l < 6; $l++){
                                    $square[] = array($grid[$l][3], $grid[$l][4], $grid[$l][5]);
                                }
                            }else{
                                for($l = 3; $l < 6; $l++){
                                    $square[] = array($grid[$l][6], $grid[$l][7], $grid[$l][8]);
                                }
                            }
                        }else{
                            if($col < 3){
                                for($l = 6; $l < 9; $l++){
                                    $square[] = array($grid[$l][0], $grid[$l][1], $grid[$l][2]);
                                }
                            }else if($col < 6){
                                for($l = 6; $l < 9; $l++){
                                    $square[] = array($grid[$l][3], $grid[$l][4], $grid[$l][5]);
                                }
                            }else{
                                for($l = 6; $l < 9; $l++){
                                    $square[] = array($grid[$l][6], $grid[$l][7], $grid[$l][8]);
                                }
                            }
                        }
                        #Check that this value has not already be used on this 3x3 square
                        if((!in_array($value, $square[0])) && (!in_array($value, $square[1])) && (!in_array($value, $square[2]))){
                            $grid[$row][$col]=$value;
                            if(isFilled($grid)){
                                $counter+=1;
                                break;
                            }else{
                                if(isSolveable($grid)){
                                    return true;
                                }
                            }
                        }
                    }
                }
            }
            break;
        }
    }
    $grid[$row][$col] = 0;
    return false;
}

function generatePuzzle(){
    global $grid;
    global $counter;
    $numberList = array(1,2,3,4,5,6,7,8,9);
    #Find next empty cell
    for($i = 0; $i < 81; $i++){
        $row = floor($i / 9);
        $col = $i % 9;
        if($grid[$row][$col] == 0){
            shuffle($numberList);
            for($x = 0; $x < 9; $x++){
                $value = $numberList[$x];
                #Check that this value has not already be used on this row
                if(!in_array($value, $grid[$row])) {
                    #Check that this value has not already be used on this column
                    if(!in_array($value, array($grid[0][$col],$grid[1][$col],$grid[2][$col],$grid[3][$col],$grid[4][$col],$grid[5][$col],$grid[6][$col],$grid[7][$col],$grid[8][$col]))){
                        #Identify which of the 9 squares we are working on
                        $square = array();
                        if($row < 3){
                            if($col < 3){
                                for($l = 0; $l < 3; $l++){
                                    $square[] = array($grid[$l][0], $grid[$l][1], $grid[$l][2]);
                                }
                            }else if($col < 6){
                                for($l = 0; $l < 3; $l++){
                                    $square[] = array($grid[$l][3], $grid[$l][4], $grid[$l][5]);
                                }
                            }else{
                                for($l = 0; $l < 3; $l++){
                                    $square[] = array($grid[$l][6], $grid[$l][7], $grid[$l][8]);
                                }
                            }
                        }else if($row < 6){
                            if($col < 3){
                                for($l = 3; $l < 6; $l++){
                                    $square[] = array($grid[$l][0], $grid[$l][1], $grid[$l][2]);
                                }
                            }else if($col < 6){
                                for($l = 3; $l < 6; $l++){
                                    $square[] = array($grid[$l][3], $grid[$l][4], $grid[$l][5]);
                                }
                            }else{
                                for($l = 3; $l < 6; $l++){
                                    $square[] = array($grid[$l][6], $grid[$l][7], $grid[$l][8]);
                                }
                            }
                        }else{
                            if($col < 3){
                                for($l = 6; $l < 9; $l++){
                                    $square[] = array($grid[$l][0], $grid[$l][1], $grid[$l][2]);
                                }
                            }else if($col < 6){
                                for($l = 6; $l < 9; $l++){
                                    $square[] = array($grid[$l][3], $grid[$l][4], $grid[$l][5]);
                                }
                            }else{
                                for($l = 6; $l < 9; $l++){
                                    $square[] = array($grid[$l][6], $grid[$l][7], $grid[$l][8]);
                                }
                            }
                        }
                        #Check that this value has not already be used on this 3x3 square
                        if((!in_array($value, $square[0])) && (!in_array($value, $square[1])) && (!in_array($value, $square[2]))){
                            $grid[$row][$col]=$value;
                            if(isFilled($grid)){
                                 return true;
                            }else{
                                if(generatePuzzle()){
                                    return true;
                                }
                            }
                        }
                    }
                }
            }
            break;
        }
    }
    $grid[$row][$col] = 0;
    return false;
}
    
#Generate a Fully Solved Grid
generatePuzzle();
$solution = $grid;
#Start Removing Numbers one by one
#A higher number of attempts will end up removing more numbers from the grid

$attempts = $_POST['difficulty']*$_POST['difficulty']*($_POST['difficulty']/2);
//$attempts = 1;
$counter = 1;

while($attempts>0){
    #Select a random cell that is not already empty
    do{
        $row = rand(0,8);
        $col = rand(0,8);
    }while($grid[$row][$col]==0);
    
    $backup = $grid[$row][$col];
    $grid[$row][$col]=0;
    
    #Take a full copy of the grid
    $copyGrid = $grid;

    $counter=0;  
    
    isSolveable($copyGrid);
    
    #If the number of solution is different from 1 which is no solution or more than 1 solution then we need to cancel the change by putting the value we took away back in the grid
    if($counter!=1){
        $grid[$row][$col]=$backup;
        $attempts -= 1;
    }
}
$response = array();
$response['solution'] = $solution;
$response['clues'] = array();
for($i = 0; $i < 9; $i++){
    for($j = 0; $j < 9; $j++){
        if($grid[$i][$j] != 0){
            $response['clues'][] = array("x" => $j, "y" => $i, "value" => $grid[$i][$j]);
        }
    }
}
echo json_encode($response);
?>