<?php

$balance=0;
// require('database.php');
if(!isset($_SESSION['user'])){
    
  header('location: /');
  exit();

}else{
$errors = [];
$oldbal;
$newbal;
$user_id = $_SESSION['user']['id'];
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $id = $_GET["id"];
  $date = $_POST['date'];
  $description = $_POST['description'];
  $income = $_POST['income'];
  $expense = $_POST['expense'];

  $query="Select * from dailyexpense Where user_id={$user_id} AND id<$id";
  $result = mysqli_query($conn , $query);
  while($rows=mysqli_fetch_assoc($result))
  {
    $oldbal = $rows['balance'];
  }


  $balance = $oldbal+$income - $expense;

  $query = sprintf("UPDATE dailyexpense SET date='%s',description = '%s' , income = %d ,expense = %d ,today_balance = %d  WHERE id = %d", 
  mysqli_real_escape_string($conn, $date),
  mysqli_real_escape_string($conn, $description),
  mysqli_real_escape_string($conn,$income),
  mysqli_real_escape_string($conn,$expense),
  mysqli_real_escape_string($conn,$balance),
  mysqli_real_escape_string($conn,$_GET['id']));

  $result = mysqli_query($conn , $query);


  // $query="Select * from dailyexpense Where user_id={$user_id} AND id > $id";
  // $result = mysqli_query($conn , $query);
  // while($rows=mysqli_fetch_assoc($result))
  // {
  //   $balance = $rows['balance'];
  //   $income =$rows['income'];
  //   $expense = $rows['expense'];
  //   $newbal = $balance + $income - $expense;

  //   $query = sprintf("UPDATE dailyexpense balance = %d WHERE id = %d", 
  //   mysqli_real_escape_string($conn, $balance),
  //   mysqli_real_escape_string($conn,$_GET['id']));
  //   $result = mysqli_query($conn , $query);
  

  // }

  // $balance = $oldbal+$income - $expense;


  if(!$result)
  {
    echo "Error occurred. ";

  }else{
    $message = "Update Successful";
    
    header('location: household'); 
  }
}
}

$user_id = $_SESSION['user']['id'];
if(isset($_GET['id'])){
  $id = $_GET['id'];
  $query = sprintf("SELECT * FROM dailyexpense WHERE id = %d AND user_id = {$user_id}",
  mysqli_real_escape_string($conn,$_GET['id']));

  $result = mysqli_query($conn,$query);
  $rows = mysqli_fetch_assoc($result);
}


?>

<?php view('header.view.php'); ?>
<?php view('nav.view.php'); ?>

<div class="login-form d-flex justify-content-center align-items-center mt-5">

<?= $message ?? '' ?>
<?php if($rows) : ?>
  
  <form action="edit?id=<?= $id ?>" method="POST">
  <h2 class="text-uppercase text-center mb-3 text-primary">Update Your House hold</h2>
    <div class="form-outline mb-4">
      <label class="form-label" for="form2Example1">Date</label>
      <input type="date" name="date" id="form2Example1" class="form-control border border-primary" value = "<?= $rows['date'] ?>" required/>  
    </div>
    <div class="form-outline mb-4">
      <label class="form-label" for="form2Example1">Description</label>
      <input type="text" name="description" id="form2Example1" class="form-control border border-primary" value = "<?= $rows['description'] ?>" required/>  
    </div>
    <div class="form-outline mb-4">
      <label class="form-label" for="form2Example1">Income</label>
      <input type="number" name="income" id="form2Example1" class="form-control border border-primary" value = "<?= $rows['income'] ?>" required/>   
    </div>
    <div class="form-outline mb-4">
      <label class="form-label" for="form2Example2">Expense</label>
      <input type="number" name="expense" id="form2Example2" class="form-control border border-primary" value = "<?= $rows['expense'] ?>" required/> 
    </div>

    <button type="submit" class="btn btn-primary btn-block mb-4 w-50 mx-auto text-white">Update</button>

  </form>

<?php else : ?>
  Not Found
<?php endif; ?>
</div>

<?php view('footer.view.php'); ?>
