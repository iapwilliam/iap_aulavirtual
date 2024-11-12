<?php 
if($_POST){
    $response = $course->dt_diplomas($_POST); 
    print_r(json_encode($response)); 
    exit;
}