<nav class="navbar navbar-expand-lg navbar-dark bg-primary" >
  <div class="container-fluid ps-5 pe-5">
    <a class="navbar-brand text-white" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse text-success" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-white">
        <li class="nav-item">
          <a class="nav-link active text-white" aria-current="page" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="<?= urlIs('/household') ? "text-black" : "text-white" ?> nav-link active" aria-current="page" href="household">House Hold</a>
        </li>
      </ul>
      
      <?php if($_SESSION['user']['email'] ?? false): ?>
        <div class="nav-bar me-3 text-black"><?= $_SESSION['user']['email'] ?></div>
        <div class="nav-bar"><a href="logout" class="text-white btn btn-dark"><u>Logout</u></a></div>
      

        
      <?php else: ?>
        <div class="nav-bar me-5"><a href="register" class="text-white">Register</a></div>
        <div class="nav-bar"><a href="login" class="text-white">Login</a></div>
        
      <?php endif; ?>
      
    </div>
  </div>
</nav>
<div class="container">
