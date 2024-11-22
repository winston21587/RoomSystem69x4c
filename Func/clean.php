<?php

function clean($input){
    $input = htmlspecialchars($input);
    $input = strip_tags($input);

    return $input;
}