<?php 
 include '../operations/connection.php'; 
  include '../operations/functions.php';           
   include '../operations/checkLogin.php';
 
  
 
   include '../header.php';
            
 
    # select role .. 
    $sql = "select * from roles";
    $op  = mysqli_query($con,$sql);


   # Logic ...
   
   $errorMessages  = array();
   $message = ""; 
   if($_SERVER['REQUEST_METHOD'] == "POST"){
 


    $name     = Clean($_POST['name']);
    $email    = Clean($_POST['email']);
    $password = Clean($_POST['password']);
    $address  = Clean($_POST['address']);
    $phone    = Clean($_POST['phone']);
    $role     = $_POST['role'];
    //$gender   = $_POST['gender'];





   # METHOD 2 ... 

  if(empty($name)){
   
   $errorMessages['name'] = "Name Field Required";
      
   }else{
         if(strlen($name) < 3){
           $errorMessages['name']  = "Name must be >= 3";
         }elseif (!preg_match("/^[a-zA-Z\s*']+$/",$name)) { 
             # code...
             $errorMessages['name']  = "Only chars allowed";

         }    
   }



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





  if(empty($address)){
    $errorMessages['address'] = "address Field Required";
       
    }else{
          if(strlen($address) < 5){
            $errorMessages['address']  = "Address must be >= 5";
          }elseif (!preg_match("/^[a-zA-Z\s*']+$/",$address)) { 
              # code...
              $errorMessages['address']  = "Only chars allowed";
 
          }    
    }




    if(empty($phone)){
        $errorMessages['phone'] = "phone Field Required";
           
        }else{
              if(strlen($phone) < 10){
                $errorMessages['phone']  = "phone must be >= 10";
              }
              elseif (!preg_match("/^\d{11}$/",$phone)) { 
                  # code...
                  $errorMessages['phone']  = "Only Numbers allowed";
     
              }    
        }
    


   
        if(empty($role)){
            $errorMessages['role'] = "role Field Required";   
            }
        



     if(count($errorMessages) == 0){

      $password = sha1($password);
      $sql = "insert into admin ( `name`, `address`, `phone`, `role_id`, `password`, `email`) values ('$name','$address','$phone',$role,'$password','$email')";

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

<body class="sb-nav-fixed">


    <?php   
       include '../nav.php';
    ?>


    <div id="layoutSidenav">

        <?php   
       include '../sideNav.php';
    ?>



        <div id="layoutSidenav_content">
            <main>


                <div class="container-fluid">
                    <h1 class="mt-4">Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard  :  (Add Admin)</li>
                    </ol>



                    <?php
            
     if(isset($_SESSION['error_messsage']) ){

        foreach($_SESSION['error_messsage'] as $key => $value){
            echo '* '.$key.' : '.$value.'<br>';
        }
     }
  echo $message;

   ?>




                    <!-- form  -->


                    <div class="card-body">
                        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
                            
                        <div class="form-group">
                                <label class="small mb-1" for="inputEmailAddress">Name</label>
                                <input class="form-control py-4" name="name" id="inputEmailAddress" type="text"
                                    placeholder="Enter name " required />
                            </div>

                            <div class="form-group">
                                <label class="small mb-1" for="inputEmailAddress">Email</label>
                                <input class="form-control py-4" name="email" id="inputEmailAddress" type="email"
                                    placeholder="Enter email" required />
                            </div>

                            <div class="form-group">
                                <label class="small mb-1" for="inputEmailAddress">Password</label>
                                <input class="form-control py-4" name="password" id="inputEmailAddress" type="password"
                                    placeholder="Enter Password" required />
                            </div>


                            <div class="form-group">
                                <label class="small mb-1" for="inputEmailAddress">Address</label>
                                <input class="form-control py-4" name="address" id="inputEmailAddress" type="text"
                                    placeholder="Enter Address title" required />
                            </div>



                            <div class="form-group">
                                <label class="small mb-1" for="inputEmailAddress">Phone</label>
                                <input class="form-control py-4" name="phone" id="inputEmailAddress" type="text"
                                    placeholder="Enter Phone " required />
                            </div>




                            <!-- <label class="small mb-1" for="inputEmailAddress">Gender</label>

                            <div class="form-group">
                                <input name="gender"   type="radio"   value="male" />
                                 <label >male</label>
                                 <input  name="gender"  type="radio"  value= "female" />
                                 <label >Female</label>

                            </div> -->





                            <div class="form-group">
                                <label class="small mb-1" for="inputEmailAddress">Role</label>
                              <select  class="form-control py-4" name="role" required>
                            <?php   while($data = mysqli_fetch_assoc($op)){ ?> 
                                <option value="<?php echo $data['id'];?>"> <?php echo $data['title'];?></option>
                             <?php } ?>
                            </select>    
                            </div>


                            <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                <input type="submit" class="btn btn-primary" value="Save">
                            </div>
                        </form>
                    </div>


                </div>
        </div>



        </main>





        <?php 
            
            include '../footer.php';
            
            ?>