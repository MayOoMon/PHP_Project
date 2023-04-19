<?php 
view('header.view.php'); 
view('nav.view.php'); 

if(!isset($_SESSION['user'])){
    
    header('location: login');
    exit();

  }
  ?>

<h4 class="my-3 text-primary fw-bold mb-2 text-uppercase">Welcome Home </h3>

<?php view('footer.view.php'); ?>

