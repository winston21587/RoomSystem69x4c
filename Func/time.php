<?php

function convert($time){

$formattedTime = date('h:i A', strtotime($time));
return $formattedTime;

}