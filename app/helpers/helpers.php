<?php 
/**
 * Helpers functions 
 */


function timeDiff($start, $end) {      
    // Convert $start and $end into EN format (ISO 8601)   
    $start  = date('H:i:s',$start);  
    $end    = date('H:i:s',$end);   
    
    $d_start    = new DateTime($start); 
    $d_end      = new DateTime($end); 
    
    //$diff      = $d_start->diff($d_end);     
    $diff      = date_diff($d_start, $d_end);        
     
    // return all data 
    $date = [
        'hour'     => $diff->format('%h'), 
        'min'      => $diff->format('%i'), 
        'sec'      => $diff->format('%s')
    ];
    
    $times = $date['hour'].":".$date['min'].":".$date['sec'];  

    return $times;  
} 

function validate_mobile($mobile)  
{
    return preg_match('/^[0-9]{11}+$/', $mobile); 
}

function validate_email($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function timeAdd($first, $second)
{
    $firstTime = explode(':', $first);
    $t1 = $firstTime[0] * 3600 + $firstTime[1] * 60 + $firstTime[2];

    $secondTime = explode(':', $second); 
    $t2 = $secondTime[0] * 3600 + $secondTime[1] * 60 + $secondTime[2];

    $t3 = $t1 + $t2;

    $h = floor($t3/3600);
    $m = floor(( $t3 % 3600) / 60); 
    $s = $t3 - $h * 3600 - $m * 60;

    return $h.':'.$m.':'.$s; 
}

function grossSalary($workingHours, $ot, $payrate, $otPayRate)   
{
    // $tax = $gross = NULL; 
    // gross salary 
    $salary = $workingHours * $payrate;
    $overtime = $ot * $otPayRate;
    $gross = $salary + $overtime;  
   
    // tax for bangladesh 
    if ($gross < 250000) {  
        $tax = $gross; // 0% 
    } elseif ($gross > 250000 && $gross < 400000 ) { 
        $tax = $gross * .10; // 10%
    } elseif ($gross > 400000 && $gross < 500000 ) {
        $tax = $gross * .15; // 15%
    } elseif ($gross > 500000 && $gross < 600000 ) { 
        $tax = $gross * .20; // 20%
    } else {
        $tax = $gross * .30; // 30%
    }  

    return $gross;     
}

function netSalary($workingHours, $payrate, $otPayRate) 
{
    $tax = $gross = ''; 
    // gross salary 
    //  if 6 day * 8 hours = 48 / if 5 day * 8 hours = 40  
    if ($workingHours > 48) {
        $gross = $payrate * 48; // grosss 
        $ot = ($workingHours - 40) * $otPayRate; // overtimes   
        $gross = $gross + $ot; 
    } else {
        $gross = $payrate * $workingHours; // if haven't ot  
    } 

    // tax for bangladesh 
    if ($gross < 250000) {
        $tax = $gross; // 0% 
    } elseif ($gross > 250000 && $gross < 400000 ) { 
        $tax = $gross * .10; // 10%
    } elseif ($gross > 400000 && $gross < 500000 ) {
        $tax = $gross * .15; // 15%
    } elseif ($gross > 500000 && $gross < 600000 ) { 
        $tax = $gross * .20; // 20%
    } else {
        $tax = $gross * .30; // 30%
    }

    $net = $gross - $tax;

    return $net;     
 
}

// time to decimal 
function decimal($time)    
{
    $hms = explode(":", $time);
    return ($hms[0] + ($hms[1]/60) + ($hms[2]/3600));
} 