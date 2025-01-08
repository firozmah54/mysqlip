<?php 
/**
 * DELETE table data
 */
$connection = new mysqli('localhost','root','','books');
$sql="DELETE FROM users WHERE id='10'";
$connection->query($sql);


/**
 * DELETE table data alternative method prepared() statement
 */

$connection = new mysqli('localhost', 'root', '', 'books');
$sql ="DELETE FROM users WHERE id='9'";

$statement=$connection->prepare($sql);
$statement->execute();

/**
 * Data update for table 
 */

$connection = new mysqli('localhost', 'root', '', 'books');
$sql="UPDATE users SET email= 'firoz@gmail.com' WHERE id='9'";

$connection->query($sql);

?>


<!doctype html>
<html lang="en">
<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="wnameth=device-wnameth, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous"
    />
</head>




<body>
<?php 
   if(isset($_POST['add'])){
     $name = $_POST['name'];
    $email = $_POST['email'];
    $cell = $_POST['cell'];
    $username = $_POST['username'];

    if($name== ''|| $email== '' || $cell== '' || $username== ''){
        $msg= "<p class='alert alert-danger fade show alert-dismissible'>All fields are required
        
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></p>";
    }else{
        $connection=new mysqli('localhost', 'root', '', 'books');

     $sql="INSERT INTO users(name, email, cell, username) VALUES('$name', '$email', '$cell', '$username')";
    $query_ql=$connection->query($sql);

    if($query_ql){
        echo "Data Inserted";
   }else{
        echo "Data Not Inserted";
   }

   $msg= "<p class='alert alert-success fade show alert-dismissible'>data successfully inserted
        
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></p>";
    }

    
}
?>
    <main class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card shadow">
                    <div class="card-header">
                        <h1 class="text-center">Registration Form</h1>
                       <div>
                       <?php if(isset($msg)){
                        echo $msg;
                        } ?>
                       </div>
                    </div>
                    <div class="card-body">
                    <form action="" method="POST">
                            <!-- Name Field -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter your name" >
                            </div>
                            
                            <!-- Email Field -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter your email" >
                            </div>
                            
                            <!-- Cell Field -->
                            <div class="mb-3">
                                <label for="cell" class="form-label">Cell</label>
                                <input type="text" class="form-control" name="cell" placeholder="Enter your cell number" >
                            </div>
                            
                            <!-- Username Field -->
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" placeholder="Enter your username" >
                            </div>
                            
                            <input type="submit" name="add" class="btn btn-primary" value="Submit">
                            <!-- Submit Button -->
                            
                    </form>
                </div>
            </div>
         </div>
    </div>


</main>
    
    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"
    ></script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"
    ></script>
</body>
</html>
