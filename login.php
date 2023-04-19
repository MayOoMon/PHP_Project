<?php
require('database.php');

if(isset($_SESSION['user'])){
  header('location: /');
  exit();
}
$errors =[];
$errormsg =[];
$result = 0;

if(isset($_POST['email']) && isset($_POST['password'])){
  $email = $_POST['email'];
  $password = $_POST['password'];

  if(strlen($email) > 0 && filter_var($email , FILTER_VALIDATE_EMAIL) && strlen($password) > 0 ){

    $query = sprintf("SELECT * FROM users WHERE email='%s'",
    mysqli_real_escape_string($conn,$email));

    $result = mysqli_query($conn,$query);
  }
  else{
    $errors['body'] = "Enter validate email and password.";
  }

  if(!$result){

    $errors['body'] = "Error when select the data.";
  }
  else{
    $rows = mysqli_fetch_assoc($result);

    if(!empty($rows)){
      
      if (password_verify($password, $rows['password'])) {

        login([
          'id' => $rows['id'],
          'email' => $email
  
        ]);

        header('location: household');
        exit();
      } 
      else{

        $errors['body'] = "Enter valid email and password.";
      }  
    }
    else{

      $errormsg['body'] = "error msg";
      // header('location: register');
    }
  }
}
?>

<?php view('header.view.php'); ?>
<?php view('nav.view.php'); ?>

<div class="login-form d-flex justify-content-center align-items-center mt-5">
  <form action="login<?= $url_query ?? ''?>" method="POST">
  <h2 class="fw-bold mb-2 text-uppercase text-center text-primary">Login</h2>
  <p class=" mb-5 text-center">Please enter your login and password!</p>
    <div class="form-outline mb-4">
      <label class="form-label" for="form2Example1">Email address</label>
      <input type="email" name="email" id="form2Example1" class="form-control border border-primary" />    
    </div>
    <div class="form-outline mb-4">
      <label class="form-label" for="form2Example2">Password</label>
      <input type="password" name="password" id="form2Example2" class="form-control border border-primary" /> 
    </div>

    <button type="submit" class="btn btn-primary btn-block mb-4">Sign in</button>

    <div class="text-center">
      <?php if(!empty($errormsg)) : ?>
        <div class="text-danger"><p>Not a member . Now <a href="register" class="fw-bold"><u>Register </u></a> Here</p></div>
      <?php else: ?>
      <p>Not a member ? <a href="register" class="text-primary fw-bold"><u>Register</u></a></p>
      <p>or sign up with:</p>
      <?php endif; ?>
      <button type="button" class="btn btn-secondary btn-floating mx-1">
        <i class="fab fa-facebook-f"></i>
      </button>
  
      <button type="button" class="btn btn-secondary btn-floating mx-1">
        <i class="fab fa-google"></i>
      </button>
  
      <button type="button" class="btn btn-secondary btn-floating mx-1">
        <i class="fab fa-twitter"></i>
      </button>
  
      <button type="button" class="btn btn-secondary btn-floating mx-1">
        <i class="fab fa-github"></i>
      </button>
    </div>
    <?php if(!empty($errors)) : ?>
      <div class="text-danger"><?= $errors['body'] ?></div>
    <?php endif;?>
  </form>
</div>

<?php view('footer.view.php');