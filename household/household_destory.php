<?php 
// require 'database.php';

// $balance = 0;
$user_id = $_SESSION['user']['id'];
if(isset($_GET['id'])){
  $id = $_GET['id'];
  
  $query = "DELETE FROM dailyexpense WHERE id = $id";

  $result = mysqli_query($conn,$query);

  $query="Select * from dailyexpense Where user_id={$user_id}";

  $result=mysqli_query($conn,$query);

//   while($rows=mysqli_fetch_assoc($result))
//   {
//     $balance = $rows['balance'];
//     $income = $rows['income'];
//     $expense = $rows['expense'];
          
//   }

//   $balance += $income - $expense;

//   var_dump($balance);
//   die();

//   $query = sprintf("UPDATE dailyexpense SET balance = %d WHERE id = %d", 
//             mysqli_real_escape_string($conn,$balance),
//             mysqli_real_escape_string($conn,$_GET['id']));

//   $result=mysqli_query($conn,$query);
  // $var_dump($result);

  if($result){

    header('location: household');

  }else{
    echo "error";
  }
}

