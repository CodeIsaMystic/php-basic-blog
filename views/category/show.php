<?php
use App\Connection;
use App\Model\{Post, Category};
use App\Table\CategoryTable;
use App\Table\PostTable;
use App\PaginatedQuery;


$id = (int)$params['id'];
$slug = $params['slug'];

$pdo = Connection::getPDO();
$category = (new CategoryTable($pdo))->find($id);

if($category->getSlug() !== $slug) {
  $url = $router->url('category', ['slug' => $category-> getSlug(), 'id' => $id]);
  http_response_code(301);
  header('Location: ' . $url);
}

$title = "{$category->getName()}";

[$posts, $paginatedQuery] = (new PostTable($pdo))->findPaginatedForCategory($category->getID());

$link = $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]);

?>


<!--  HEADING CATEGORY  -->
<div class="container-fluid bg-light m-0 px-0 py-5">

  <h1 class="display-4 text-center pt-5 m-0"><?= htmlentities($title) ?></h1>
  <h5 class="text-center text-black-50 fw-light m-0 pb-5 pt-2">Just blogging from scratch</h5>
</div>

<!--  SUB-HEADING CATEGORY  -->
<div class="container-fluid m-0 px-0 py-5">

  <div class="row mx-0 px-0">
    <div class="col-md-8 p-0 mx-auto">
      <h2 class="text-secondary pt-5 m-0">Welcome to your Category...</h2>
      <hr>
      <p class="text-muted fw-light m-0 pb-5 pt-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente, dolor. Veniam, animi ad deleniti impedit eveniet esse, reiciendis architecto illo sunt libero fuga tempora quia quis asperiores officia at ut, officiis ipsa accusamus. Veritatis libero, porro ipsum fugit maiores ab! Eius eaque omnis ullam voluptates totam optio odit minima voluptatum.
      <br>
      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum quas deserunt odit possimus iure quam nam, impedit cupiditate, non minus ipsa vero placeat ratione voluptatem odio tempora suscipit, voluptas porro tenetur animi deleniti molestias dolore id. Fugiat at exercitationem eius repudiandae, omnis magnam quaerat fuga accusantium quibusdam nihil deserunt accusamus nemo non dolores perspiciatis? Necessitatibus laborum culpa doloremque eligendi quam qui enim non sed. Facilis, repudiandae dicta? Dignissimos dolorum ea architecto quidem. Doloribus, dicta atque.
      </p>
    </div>
  </div>

</div>


<div class="container-fluid">
  <!--  ROW POSTS/CARDS  -->
  <div class="row">
    <?php foreach($posts as $post): ?>
    <div class="col-md-7 p-0 mx-auto">
      <?php require dirname(__DIR__) . '/post/card.php' ?>
    </div>
    <?php endforeach ?>
  </div>

  <!--  PAGINATION  -->
  <div class="row mx-0 px-0 mb-5">
      <div class="col-md-7 p-0 mx-auto">
        <div class="d-flex justify-content-between my-4">
          <?= $paginatedQuery->previousLink($link) ?>
          <?= $paginatedQuery->nextLink($link) ?>
        </div>
      </div>
  </div>
</div>

