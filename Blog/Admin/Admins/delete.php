<?php 
include '../operations/checkLogin.php';
include '../operations/connection.php';
$message = '';

 if($_SERVER['REQUEST_METHOD'] == "GET"){

  if(isset($_GET['id'])){

    $id = filter_var($_GET['id'],FILTER_SANITIZE_NUMBER_INT);

    if(filter_var($id,FILTER_VALIDATE_INT)){
        // CODE ....... 

        $sql = "delete from admins where id = ".$id;
        $op  = mysqli_query($con,$sql);

        if($op){
            $message = "Item deleted";
        }else{
            $message = "Error in Delete";
        }

    }else{
        $message = "InValid id value";
    }



  }else{
    $message = "Id Not Found";
  }
  
 }else{
     $message = "Bad Request Method";
 }



     $_SESSION['message'] = $message;
     header("Location: display.php");




?>