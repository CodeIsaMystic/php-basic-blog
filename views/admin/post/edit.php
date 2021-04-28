<?php

use App\Connection;
use App\Table\PostTable;
use App\Table\CategoryTable;
use App\Validators\PostValidator;
use App\HTML\Form;
use App\Attachment\PostAttachment;
use App\ObjectHelper;
use App\Auth;


Auth::check();

$pdo = Connection::getPDO();
$postTable = new PostTable($pdo);
$categoryTable = new CategoryTable($pdo);
$categories = $categoryTable->list();
$post = $postTable->find($params['id']);
$categoryTable->hydratePosts([$post]);

$success = false;
$errors = [];
$fields = ['name', 'content', 'slug', 'created_at', 'image'];


if(!empty($_POST)) {
  $data = array_merge($_POST, $_FILES);

  $v = new PostValidator($data, $postTable, $post->getID(), $categories);
  ObjectHelper::hydrate($post, $data, $fields);

  if($v->validate()) {
    $pdo->beginTransaction();

    PostAttachment::upload($post);

    $postTable->updatePost($post);
    $postTable->attachCategories($post->getID(), $_POST['categories_ids']);
    $pdo->commit();
    $categoryTable->hydratePosts([$post]);

    header("Location: " . $router->url('admin_posts', ['id' => $post->getID()]) . '?created=1');
    $success = true;
    exit();

  } else {
    $errors = $v->errors();
  }
}

$form = new Form($post, $errors);
?>




<!--  HEADING ADMIN EDIT PAGE  -->
<div class="container-fluid bg-light m-0 px-0 py-5">
  <h1 class="w-75 font-weight-bold display-2 text-center pt-5 m-0 mx-auto">Edit Your 
  Post </h1>
  <h2 class="w-50 display-4 text-center m-0 mx-auto"><?= htmlentities($post->getName()) ?></h2>
  <h5 class="text-center text-black-50 fw-light m-0 pb-5 pt-2">
    Post id: #<?= $params['id'] ?>...
  </h5>
</div>

<div class="row mx-0 px-0">

  <!-- ALERT SUCCESS EDIT --->
  <?php if($success): ?>
    <div class="col-md-8 mt-3 px-2 mx-auto alert alert-success border-0 rounded-0">
      <p class="mb-0">The post has been edited with success.</p>
    </div>
  <?php endif ?>



  <!-- ALERT ERROR EDIT --->
  <?php if(!empty($errors)): ?>
    <div class="col-md-8 px-2 mt-3 mx-auto alert alert-danger border-0 rounded-0">
      <p class="mb-0">The post has not been edited with success.</p>
    </div>
  <?php endif ?>

  <div class="col-md-8 px-0 mx-auto my-5">
    <!-- FORM EDIT  --->
    <?php require('_form.php'); ?>

  </div>
</div>

