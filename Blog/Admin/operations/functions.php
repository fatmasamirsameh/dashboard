<?php  
session_start();

 # clean code function ... 
 function Clean($input){
    
    $input = trim($input);
    $input = htmlspecialchars($input);   // < &lt; > &gt;
    $input = stripcslashes($input);

    return $input;
   }





function url($url){
    return   "http://".$_SERVER['HTTP_HOST']."/Task15/blog/Admin/".$url;
}







?>