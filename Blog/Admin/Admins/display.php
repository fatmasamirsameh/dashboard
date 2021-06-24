<?php            
 include '../operations/checkLogin.php';
include '../operations/connection.php';
include '../header.php';


 $sql = "select admin.* , roles.title as roleTitle from admin join roles on admin.role_id = roles.id";
 $op  = mysqli_query($con,$sql);


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
                       
                        <?php if(isset($_SESSION['message'])){?>       
                        <ol class="breadcrumb mb-4">
                            <!-- <li class="breadcrumb-item active">Dashboard      </li> -->
                    
                            <li class="breadcrumb-item "> * <?php echo $_SESSION['message'];?>      </li>
                 
                        </ol>
                        <?php 
                    
                    unset($_SESSION['message']);
                    unset($_SESSION['error_messsage']);
                     }

                ?>
           
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Admin  Roles
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>

                                                <th>#id</th>
                                                <th>Name</th>
                                                <th>Address</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Action</th>
                            
                                            </tr>
                                        </thead>
                            
                                        <tbody>
                                        
                                        <?php 
                                           while($data = mysqli_fetch_assoc($op)){
                                        ?>

                                             <tr>
                                                <td><?php echo $data['id'];?></td>
                                                <td><?php echo $data['name'];?></td>
                                                <td><?php echo $data['address'];?></td>
                                                <td><?php echo $data['phone'];?></td>
                                                <td><?php echo $data['email'];?></td>
                                                <td><?php echo $data['roleTitle'];?></td>
            <td><!-- table body will be here -->
                <a href='delete.php?id=<?php echo $data['id']; ?>' class='btn btn-danger m-r-1em'>Delete</a>
                <a href='edit.php?id=<?php echo $data['id'];?>'    class='btn btn-primary m-r-1em'>Edit</a>  
            </td>  
                                               
                                            </tr>
                                      <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>









                        
              
                    </div>
                </main>
            
            
            <?php 
            
            include '../footer.php';
            
            ?>