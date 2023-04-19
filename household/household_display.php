<?php 
// require('database.php'); 
// require('padination.php');

if (!$_SESSION["user"]) {
    header('location: /');  
}

?>

<?php view('header.view.php',["title" => "House Hold",]); ?>
<?php view('nav.view.php');?>
<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col ">
        <div class="card rounded-3">
          <div class="card-body p-4">
            <h4 class="text-center my-3 text-primary fw-bold mb-2 text-uppercase">House Hold</h4>
            <div class="col-12">
              <button type="submit" class="btn btn-primary"><a href="create" class="text-light">+ Add New Expense and Income</a></button>   
            </div>
            <table class="table mb-4">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Date</th>
                  <th scope="col">Description</th>
                  <th scope="col">Income</th>
                  <th scope="col">Expense</th>
                  <th scope="col">Today Balance</th>
                  <th scope="col">Total Balance</th>
                  <th scope="col">Actions</th>
                </tr>
              </thead>
              
              <tbody>
  
              <?php $count = 1 ?>
              
              <?php
                $balance=0;
                $id =0 ;
                
                $user_id = $_SESSION['user']['id'];

                // $rowLimit = 3;
                // $page = (isset($_GET["page"])) ? $_GET["page"] : 1;
                // $startPage = ($page - 1) * $rowLimit;

                // $query="SELECT * FROM dailyexpense WHERE user_id={$user_id} LIMIT $startPage,$rowLimit ";
                // $result=mysqli_query($conn,$query);


                // $totalid="SELECT count(id) AS total FROM dailyexpense WHERE user_id={$user_id} ";

                // $sql = mysqli_query($conn,$totalid);

                // while($rows=mysqli_fetch_assoc($sql))
                // { 
                //   $totalList=$rows['total'];
                  
                // }
               

                // $totalPages = ceil($totalList / $rowLimit);
                $query="SELECT * FROM dailyexpense WHERE user_id={$user_id}";
                $result=mysqli_query($conn,$query);
                
                if($result){
                  while($rows=mysqli_fetch_assoc($result))
                  { 
                    $id=$rows['id'];
                    $date=$rows['date'];
                    $description=$rows['description'];
                    $income=$rows['income'];
                    $expense=$rows['expense'];
                    $todaybal=$rows['today_balance'];

                    $balance += $income - $expense; //balance cal
                    // $query = sprintf("UPDATE dailyexpense SET balance = %d WHERE id = %d", 
                    //                   mysqli_real_escape_string($conn,$balance),
                    //                   mysqli_real_escape_string($conn,$_GET['id']));
                    // $result = mysqli_query($conn , $query);

                   ?>
                    
                   
                  <tr>
                    <td><?= $count++; ?></td>
                    <td><?= $date ?></td>
                    <td><?= htmlentities($description) ?></td>
                    <td class="text-primary"><?= number_format($income) ?></td>
                    <td class="text-danger"><?= number_format($expense) ?></td>
                    <td><?= number_format($todaybal) ?></td> <!-- add -->
                    <td><?= number_format($balance) ?></td>
                    <td>
                      <button type="submit" class="btn btn-primary"><a href="edit?id=<?= $id ?>" class="text-light">Edit</a></button>
                      <button type="submit" class="btn btn-danger"><a href="destory?id=<?= $id ?>" class="text-light">Delete</a></button>
                    </td>
                  </tr>
                  
                <?php }
                $query = sprintf("UPDATE dailyexpense SET total_balance = %d WHERE id = %d", 
                          mysqli_real_escape_string($conn,$balance),
                          mysqli_real_escape_string($conn,$id));
                $result = mysqli_query($conn , $query);
                }
                ?>     
              </tbody>

              
              </table>
              <!-- <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                  <li class="page-item <?php if ($page <= 1) : ?>
                    <?= "disabled" ?>
                    <?php endif; ?>">
                    <a class="page-link" href="?page=<?= $page - 1 ?>" aria-label="Previous">
                      <span aria-hidden="true">&laquo;</span>
                    </a>
                  </li>


                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                  <li class="page-item 
                    <?php
                      if ($page == $i) {
                        echo "active";
                      }
                    ?>
                    "><a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a></li>
                <?php endfor; ?>


                <li class="page-item 
                        <?php if ($page >= $totalPages) {
                          echo "disabled";
                        } ?>">
                  <a class="page-link" href="?page=<?= $page + 1 ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
                </ul>
              </nav> -->
          </div>  
        </div>  
      </div>
    </div>
  </div>
  
</section>

<?php view('footer.view.php');
