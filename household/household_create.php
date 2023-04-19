<?php

  // require('database.php');

  if(!isset($_SESSION['user'])){
    
    header('location: /');
    exit();

  }else{

    $expense;

    $user_id = $_SESSION['user']['id'];
    $balance=0;
    $nameErr = "";

    if(isset($_POST['date']) && isset($_POST['description']) && isset($_POST['income']) && isset($_POST['expense']))
    {   
      $date = $_POST['date'];
      $description = $_POST['description'];
      $income = $_POST['income'];
      // $balance = $_POST['balance'];
      $expense = $_POST['expense'];

        // $query="Select * from dailyexpense Where user_id={$user_id}";
        // $result=mysqli_query($conn,$query);
        // while($rows=mysqli_fetch_assoc($result))
        // {
        //   $balance = $rows['balance'];
          
        // }
        $balance += $income - $expense;

        $query = sprintf("INSERT INTO dailyexpense (date,description,income,expense,today_balance,user_id) VALUES ('%s','%s',%d,%d,%d,%d)",
        mysqli_real_escape_string($conn, $date),
        mysqli_real_escape_string($conn, $description),
        mysqli_real_escape_string($conn, $income),
        mysqli_real_escape_string($conn, $expense),
        mysqli_real_escape_string($conn, $balance),
        mysqli_real_escape_string($conn, $user_id));
            
        $result = mysqli_query($conn,$query);

        if($result){
          header('location: household');

      }else{
        echo "Data insert not successful";
      }
    }
  }


?>

<?php view('header.view.php'); ?>
<?php view('nav.view.php'); ?>

<div class="login-form d-flex justify-content-center align-items-center mt-5">
  
  <form action="" method="POST">
  <h2 class="text-uppercase text-center mb-3 text-primary">Add House Hold</h2>

    <div class="form-outline mb-4">
      <label class="form-label" for="form2Example1">Date</label>
      <input type="date" name="date" id="form2Example1" class="form-control border border-primary" required/>     
    </div>
    <div class="form-outline mb-4">
      <label class="form-label" for="form2Example1">Description</label>
      <input type="text" name="description" id="form2Example1" class="form-control border border-primary" required/>    
    </div>
    <div class="form-outline mb-4">
      <label class="form-label" for="form2Example1">Income</label>
      <input type="number" name="income" id="form2Example1" class="form-control border border-primary" required/>    
    </div>
    <div class="form-outline mb-4">
      <label class="form-label" for="form2Example2">Expense</label>
      <input type="nummber" name="expense" id="form2Example2" class="form-control border border-primary" required/> 
    </div>

    <button type="submit" class="btn btn-primary btn-block w-50 mb-4 mx-auto">Add</button>

  </form>
  
</div>

<?php view('footer.view.php'); ?>
