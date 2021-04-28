<?php

use App\Connection;
use App\Table\PostTable;
use App\Table\CategoryTable;
use App\Validators\PostValidator;
use App\HTML\Form;
use App\Model\Post;
use App\Attachment\PostAttachment;
use App\ObjectHelper;
use App\Auth;


Auth::check();


$pdo = Connection::getPDO();
$post = new Post();
$post->setCreatedAt(date('Y-m-d H:i:s'));
$categoryTable = new CategoryTable($pdo);
$categories = $categoryTable->list();

$errors = [];
$fields = ['name', 'content', 'slug', 'created_at', 'image'];


if(!empty($_POST)) {
  $table = new PostTable($pdo);
  $data = array_merge($_POST, $_FILES);

  $v = new PostValidator( $data, $table, $post->getID(), $categories);
  ObjectHelper::hydrate($post, $data, $fields);

  if($v->validate()) {
    $pdo->beginTransaction();
    PostAttachment::upload($post);
    $table->createPost($post);
    $table->attachCategories($post->getID(), $_POST['categories_ids']);
    $pdo->commit();

    header("Location: " . $router->url('admin_posts', ['id' => $post->getID()]) . '?created=1');
    exit();

  } else {
    $errors = $v->errors();
  }
}

$form = new Form($post, $errors);
?>



<!--  HEADING ADMIN REGISTER PAGE  -->
<div class="container-fluid bg-light m-0 px-0 py-5">
  <h1 class="w-75 font-weight-bold display-2 text-center pt-5 m-0 mx-auto"> Dashboard: Create New
  Post </h1>
  <h5 class="text-center text-black-50 fw-light m-0 pb-5 pt-2">
    Edit a brand NEW post...
  </h5>
</div>

<!-- LINK BACK TO FRONT --->
<?php if(isset($_SESSION['auth'])): ?>
<div class="container mx-0 px-0 py-3">
  <a href="<?= $router->url('home') ?>" class="text-black-50 ps-4">
    Link to your Website
  </a>
</div>
<?php endif ?>

<div class="container-fluid my-5">
  <div class="row mb-5 mx-0 px-0">


    <!-- ALERT ERROR REGISTER --->
    <?php if(!empty($errors)): ?>
      <div class="col-md-8 px-2 mt-3 mx-auto alert alert-danger border-0 rounded-0">
        <p class="mb-0">The post has not been registered with success.</p>
      </div>
    <?php endif ?>

    <div class="col-md-8 px-0 mx-auto my-5">

      <!-- FORM REGISTER  --->
      <?php require('_form.php') ?>

    </div>

  </div>
</div>
