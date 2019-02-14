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