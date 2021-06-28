<?php 
  require './operations/connection.php';
  require './operations/functions.php';
   



  if($_SERVER['REQUEST_METHOD'] == "POST"){
    // CODE ... 


    $email    = Clean($_POST['email']);
    $password = Clean($_POST['password']);
    
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

        // login code ..... 
        $password = sha1($password); 
        $sql = "select * from user where email='$email' and password = '$password' " ;

        $op = mysqli_query($con,$sql);

        $count = mysqli_num_rows($op);

        if($count == 1){
            // login code .... 

          $data = mysqli_fetch_assoc($op);
          
          $_SESSION['id']   =  $data['id'] ;
          $_SESSION['name'] =  $data['name'] ;

         header("Location: index.php");

        }else{
            echo 'Error in Email || Password try again ';
        }

      }
      
      
      else{


        foreach($errorMessages as $key => $messages){

            echo '*'.$key.' :  '.$messages.'<br>';
        }




      }



  }



?>






<div class="wait overlay">
		<div class="loader"></div>
	</div>
	<div class="container-fluid">
				<!-- row -->
				

					<div class="login-marg">
						<!-- Billing Details -->
						
						
						<!-- /Billing Details -->
						
						
								<form onsubmit="return false" id="login" class="login100-form ">
									<div class="billing-details jumbotron">
                                    <div class="section-title">
                                        <h2 class="login100-form-title p-b-49" >Login Here</h2>
                                    </div>
                                   
                                    
                                    <div class="form-group">
                                       <label for="email">Email</label>
                                        <input class="input input-borders" type="email" name="email" placeholder="Email" id="password" required>
                                    </div>
                                    
                                    <div class="form-group">
                                       <label for="email">Password</label>
                                        <input class="input input-borders" type="password" name="password" placeholder="password" id="password" required>
                                    </div>
                                    
                                    <div class="text-pad" >
                                       <a href="#">
                                           forget password ?
                                       </a>
                                        
                                    </div>
                                    
                                        <input class="primary-btn btn-block"   type="submit"  Value="Login">
                                        
                                        <div class="panel-footer"><div class="alert alert-danger"><h4 id="e_msg"></h4></div></div>
                                    
                                    	
                                        
                                    

                                </div>
                                
								</form>
                           
				
					
					</div>

				
			</div>