<?php
require('database.php');

if (isset($_SESSION['user'])) {
  header('location: /');
  exit();
}


$errors = [];
$passErr = "";

$password ="";
$cpassword ="";

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
  $username = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $cpassword = $_POST['cpassword'];

  if(strlen($username) > 0 && strlen($email) > 0 && filter_var($email,FILTER_VALIDATE_EMAIL) && strlen($password) > 0 && strlen($cpassword) > 0)
  {
    if($password !== $cpassword){
      $passErr ="* Password not match!";
    }
    else{
    $query = sprintf("SELECT * FROM users WHERE email='%s'",mysqli_real_escape_string($conn,$email));
    $result = mysqli_query($conn,$query);

    if($result){
      $rows = mysqli_fetch_assoc($result);
      if(!empty($rows)){
        $errors['duplicate'] ="Email alrady exists."; 
  
      }else{
        $query = sprintf("INSERT INTO `users` (`username`, `email`, `password`) VALUES ('%s', '%s', '%s')",
        mysqli_real_escape_string($conn,$username),
        mysqli_real_escape_string($conn,$email),
        mysqli_real_escape_string($conn, password_hash($password, PASSWORD_BCRYPT)),
        )
      ;

        $result = mysqli_query($conn,$query);
        header('location: login');
        exit();
      }
    }
    else {
       //$errors['body'] = "Enter valid email and password.";
    }
  }
  } 
  else {
    $errors['body'] = "Errors when select the data.";
  }
}
?>

<?php view('header.view.php'); ?>
<?php view('nav.view.php'); ?>

<div class="login-form d-flex justify-content-center align-items-center mt-5">
  
  <form action="register" method="POST">
  <h2 class="text-uppercase text-center mb-3 text-primary">Create an account</h2>

    <div class="form-outline mb-4">
      <label class="form-label" for="form2Example1">Your Name</label>
      <input type="text" name="name" id="form2Example1" class="form-control border border-primary" />    
    </div>
    <div class="form-outline mb-4">
      <label class="form-label" for="form2Example1">Your Email</label>
      <input type="email" name="email" id="form2Example1" class="form-control border border-primary" />    
    </div>
    <div class="form-outline mb-4">
      <label class="form-label" for="form2Example1">Password</label>
      <input type="password" name="password" id="form2Example1" class="form-control border border-primary" />    
    </div>

    <div class="form-outline mb-4">
      <label class="form-label" for="form2Example2">Repeat your password</label>
      <input type="password" name="cpassword" id="form2Example2" class="form-control border border-primary" /> 
    </div>
    <span class="text-danger"><?= $passErr ?></span>

    <button type="submit" class="btn btn-primary btn-block mb-4">Register</button>
    <p class="text-center mt-5 mb-0">Have already an account? <a href="login" class="fw-bold text-primary"><u>Login here</u></a></p>
      
    <?php if(!empty($errors)) : ?>
      <div class="text-danger"><?= $errors['body'] ?></div>
    <?php endif;?>
  </form>
</div>

<?php view('footer.view.php'); ?>
