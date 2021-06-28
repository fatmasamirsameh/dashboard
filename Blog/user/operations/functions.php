<?php  

 # clean code function ... 
 function Clean($input){
    
    $input = trim($input);
    $input = htmlspecialchars($input);   // < &lt; > &gt;
    $input = stripcslashes($input);

    return $input;
   }



?>