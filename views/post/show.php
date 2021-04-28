<?php
use App\Connection;
use App\Table\PostTable;
use App\Table\CategoryTable;
use App\Model\{Post, Category};


$id = (int)$params['id'];
$slug = $params['slug'];

$pdo = Connection::getPDO();
$post = (new PostTable($pdo))->find($id);
(new CategoryTable($pdo))->hydratePosts([$post]);

if($post->getSlug() !== $slug) {
  $url = $router->url('post', ['slug' => $post-> getSlug(), 'id' => $id]);
  http_response_code(301);
  header('Location: ' . $url);
}

$title = "{$post->getName()}";

?>



<!--  HEADING ARTICLE PAGE  -->
<div class="container-fluid bg-light m-0 px-0 py-5">
  <div class="row mx-0 px-0">
    <div class="col-md-10 p-0 mx-auto">
      <h1 class="text-center pt-5 mx-0 my-5"><?= htmlentities($post->getName()) ?></h1>
    </div>
  </div>
</div>



<!--  CONTENT ARTICLE PAGE  --->
<div class="row mx-0 px-0 mb-5">
  <div class="col-md-7 p-0 mx-auto">

    <?php if($post->getImage()) : ?>
      <img src="<?= $post->getImageURL('large') ?>" alt="image hero" class="card-img-top mt-5">
    <?php endif ?>

    <div class="row px-2 py-5">
      <div class="col-5 mb-3">
            <small class="text-muted p-3"><?= $post->getCreatedAt()->format('d F Y') ?></small>
      </div>
      <div class="col-7 text-end mb-3">
        <?php foreach($post->getCategories() as $cat => $category): 
          $category_url = $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]); ?>
          <a  href="<?= $category_url ?>"  
              class="badge btn text-decoration-none bg-primary">
              <?= htmlentities($category->getName()) ?>
          </a>
        <?php endforeach ?>
      </div>
      <p class="mb-0 mt-5"><?= $post->getFormattedContent() ?></p>
    </div>

  </div>
</div>
