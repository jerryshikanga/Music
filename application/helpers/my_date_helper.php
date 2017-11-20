<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function getCurrentDateTime(){
	$date = new DateTime();
	$date = $date->setTimeZone(new DateTimeZone('Africa/Nairobi'));
	return $date->format('Y-m-d H:i:s');
}

function format_date($datetime)
{
    $date = date('jS F Y', (strtotime($datetime)));
    return $date;
}

function get_time_elapsed($datetime)
{
    $from = new DateTime($datetime);
    $to   = new DateTime('today');
    $years = ($from->diff($to)->y);
    if($years <= 0)
    {
        $months = ($from->diff($to)->m);
        if($months <= 0){
           return (($from->diff($to)->d).'  '."Days");
        }
        else{
           return $months.'  '."Months";
        }
    }
    else{
        return $years.'  '."Years";
    }
}

?>