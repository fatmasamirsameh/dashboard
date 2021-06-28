<?php 
   require './operations/connection.php';
 
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    // CODE ... 
    function Clean($input){
    
        $input = trim($input);
        $input = htmlspecialchars($input);   // < &lt; > &gt;
        $input = stripcslashes($input);
    
        return $input;
       }


    $email    = Clean($_POST['email']);
    $password = Clean($_POST['password']);
    $firstName = Clean($_POST['firstName']);
    $lastName = Clean($_POST['lastName']);
    // $confirmPassword = Clean($_POST['confirmPassword ']);
    $mobile = Clean($_POST['mobile']);
    $address = Clean($_POST['address']);
    
    $errorMessages = [];



      // Validate email 
      if(empty($email)){
        $errorMessages['email'] = "Email Field Required";
     }else{
      
      // filter_var($email,FILTER_VALIDATE_EMAIL))) == flase || 0 
      if(!(filter_var($email,FILTER_VALIDATE_EMAIL))){    
          $errorMessages['email']  = "Invalid Email";
      }
  
     }
  
  
     // Validate Password . 
     if(empty($password)){
         $errorMessages['password'] = "Password Field Required";
     }else{
  
         if(strlen($password) < 6){
          $errorMessages['password'] = "Password Must Be >= 6 "; 
         }
  
     }


      
       if(count($errorMessages) == 0){

        $password = sha1($password);
     $sql = "insert into user ( `first_name`, `last_name`, `email`, `mobile`, `password`, `address`) values ('$firstName','$lastName','$email','$mobile','$password','$address')";

  
        $op = mysqli_query($con,$sql);
  
        if($op){
            $message = "Inserted";
        }else{
            $message = "Try Again";
        }
   
          $_SESSION['message'] = $message;
        // header("Location: display.php");
       }else{
          $_SESSION['error_messsage'] = $errorMessages;
          // header("Location: add.php");
  
  
       }
  
  
  
  
  
     }
  



?>




<div class="wait overlay">
        <div class="loader"></div>
    </div>
    <style>
    .input-borders{
        border-radius:30px;
    }
    </style>
				<!-- row -->
				
                <div class="container-fluid">
					
						
						
						<!-- /Billing Details -->
						
								<form id="signup_form" onsubmit="return false" class="login100-form">
									<div class="billing-details jumbotron">
                                    <div class="section-title">
                                        <h2 class="login100-form-title p-b-49" >Register Here</h2>
                                    </div>
                                    <div class="form-group ">
                                    
                                        <input class="input form-control input-borders" type="text" name="firstName" id="f_name" placeholder="First Name">
                                    </div>
                                    <div class="form-group">
                                    
                                        <input class="input form-control input-borders" type="text" name="lastName" id="l_name" placeholder="Last Name">
                                    </div>
                                    <div class="form-group">
                                        <input class="input form-control input-borders" type="email" name="email"  placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <input class="input form-control input-borders" type="password" name="password" id="password" placeholder="password">
                                    </div>
                                  
                                    <div class="form-group">
                                        <input class="input form-control input-borders" type="text" name="mobile" id="mobile" placeholder="mobile">
                                    </div>
                                    <div class="form-group">
                                        <input class="input form-control input-borders" type="text" name="address" id="address1" placeholder="Address">
                                    </div>
                                  
                                    
                                    <div style="form-group">
                                       <input class="primary-btn btn-block"  value="Sign Up" type="submit" name="signup_button">
                                    </div>
                                    <div class="text-pad">
                                    <a href="" data-toggle="modal" data-target="#Modal_login">Already have an Account ? then login</a>
                                       
                                    </div>
                                    
                                
								</form>
                                <div class="login-marg">
						<!-- Billing Details -->
						<div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8" id="signup_msg">
                                    

                                </div>
                                <!--Alert from signup form-->
                            </div>
                            <div class="col-md-2"></div>
                        </div>

						
					</div>
                    </div> 

					
				
				<!-- /row -->

			

