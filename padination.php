<?php
require('database.php'); 
$rowLimit = 2;
$page = (isset($_GET["page"])) ? $_GET["page"] : 1;
$startPage = ($page - 1) * $rowLimit;
$user_id = $_SESSION['user']['id'];

$lists="SELECT * FROM dailyexpense WHERE del_flg=0 AND user_id={$user_id} LIMIT 
$startPage,$rowLimit";
$result=mysqli_query($conn,$lists);

// $sql = $pdo->prepare("
// SELECT count(id) AS total FROM wallet WHERE del_flg=0;
// ");
// $sql->execute();
// $lists = $sql->fetchAll(PDO::FETCH_ASSOC);


$totallist="SELECT count(id) AS total FROM wallet WHERE del_flg=0";

$totalPages = ceil($totallist / $rowLimit);
//for pagination
// $sql = $pdo->prepare("
// SELECT count(id) AS total FROM wallet WHERE del_flg=0;
// ");

// $sql->execute();
// $totalList = $sql->fetchAll(PDO::FETCH_ASSOC)[0]['total'];

// $totalPages = ceil($totalList / $rowLimit);
?>


<nav aria-label="Page navigation example">
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
    </nav>