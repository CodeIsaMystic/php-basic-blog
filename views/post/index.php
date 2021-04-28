<?php 
use App\Connection;
use App\Table\PostTable;


$title = "Blog"; 
$pdo = Connection::getPDO();


$table = new PostTable($pdo);
[$posts, $pagination] = $table->findPaginated();

$link = $router->url('home');
?>


<!--  HEADING POSTS INDEX  -->
<div class="container-fluid bg-light m-0 px-0 py-5">
  <h1 class="display-2 text-center pt-5 m-0">Start</h1>
  <h5 class="text-center text-black-50 fw-light m-0 pb-5 pt-2">Just blogging from scratch ...</h5>
</div>



<!--  SUB-HEADING POSTS INDEX  -->
<div class="container-fluid m-0 px-0 py-5">

  <div class="row mx-0 px-0">
    <div class="col-md-8 px-3 px-md-0 mx-md-auto">
      <h2 class="text-secondary pt-5 m-0">Welcome to your <?= htmlentities($title) ?></h2>
      <p class="text-muted fw-light m-0 pb-5 pt-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente, dolor. Veniam, animi ad deleniti impedit eveniet esse, reiciendis architecto illo sunt libero fuga tempora quia quis asperiores officia at ut, officiis ipsa accusamus. Veritatis libero, porro ipsum fugit maiores ab! Eius eaque omnis ullam voluptates totam optio odit minima voluptatum.</p>
    </div>
  </div>

</div>


<!--  ROW POSTS/CARDS  -->
<div class="row mx-0 px-0">
  <?php foreach($posts as $post): ?>
  <div class="col-md-7 p-0 mx-auto">
    <?php require 'card.php' ?>
  </div>
  <?php endforeach ?>
</div>

<!--  PAGINATION  -->
<div class="row mx-0 px-0 mb-5">
    <div class="col-md-7 p-0 mx-auto">
      <div class="d-flex justify-content-between my-4">

          <?= $pagination->previousLink($link); ?>
          <?= $pagination->nextLink($link); ?>

      </div>
    </div>
</div>
