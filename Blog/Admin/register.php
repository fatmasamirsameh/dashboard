<?php 
  require './operations/connection.php';
  require './operations/functions.php';
   



  if($_SERVER['REQUEST_METHOD'] == "POST"){
    // CODE ... 


    $email    = Clean($_POST['email']);
    $password = Clean($_POST['password']);
    $firstName = Clean($_POST['firstName']);
    $lastName = Clean($_POST['lastName']);
    // $confirmPassword = Clean($_POST['confirmPassword ']);
    $mobile = Clean($_POST['mobile ']);
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






<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Page Title - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                                    <div class="card-body">
                                    <form   action="<?php echo   htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1"  name =" firstName" for="inputFirstName">First Name</label>
                                                        <input class="form-control py-4" id="inputFirstName" type="text" placeholder="Enter first name" />
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1"  name ="lastName" for="inputLastName">Last Name</label>
                                                        <input class="form-control py-4" id="inputLastName" type="text" placeholder="Enter last name" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row">
 
                                            <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1"  name ="mobile" for="inputLastName">mobile</label>
                                                        <input class="form-control py-4" id="inputLastName" type="text" placeholder="Enter your mobile" />
                                                    </div>
                                                </div>
    
                                               
                                            <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1"  name ="address" for="inputLastName">Address</label>
                                                        <input class="form-control py-4" id="inputLastName" type="text" placeholder="Enter Address" />
                                                    </div>
                                                </div>
                                               </div>
                                                <div class="form-row">
                                                <div class="form-group">
                                                <label class="small mb-1"name ="email" for="inputEmailAddress">Email</label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="email" aria-describedby="emailHelp" placeholder="Enter email address" />
                                            </div>
                                           
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1"name ="password" for="inputPassword">Password</label>
                                                        <input class="form-control py-4" id="inputPassword" type="password" placeholder="Enter password" />
                                                    </div>
                                                </div>
                                              
                                            </div>
                                            <div class="form-group mt-4 mb-0"><a class="btn btn-primary btn-block" href="login.html">Create Account</a></div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small"><a href="login.html">Have an account? Go to login</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2020</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
