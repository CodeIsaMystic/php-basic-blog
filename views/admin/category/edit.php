<?php

use App\Connection;
use App\Table\CategoryTable;
use App\Validators\CategoryValidator;
use App\HTML\Form;
use App\ObjectHelper;
use App\Auth;


Auth::check();

$pdo = Connection::getPDO();
$table = new CategoryTable($pdo);
$item = $table->find($params['id']);

$success = false;
$errors = [];
$fields = ['name', 'slug'];


if(!empty($_POST)) {
  $v = new CategoryValidator($_POST, $table, $item->getID());
  ObjectHelper::hydrate($item, $_POST, $fields);

  if($v->validate()) {
    $table->update([
      'name' => $item->getName(),
      'slug' => $item->getSlug()
    ], $item->getID());

    header("Location: " . $router->url('admin_categories') . '?created=1');
    $success = true;
    exit();
  } else {
    $errors = $v->errors();
  }
}

$form = new Form($item, $errors);
?>




<!--  HEADING ADMIN EDIT PAGE  -->
<div class="container-fluid bg-light m-0 px-0 py-5">
  <h1 class="w-75 font-weight-bold display-2 text-center pt-5 m-0 mx-auto">Edit Your 
  Category </h1>
  <h2 class="w-50 display-4 text-center m-0 mx-auto"><?= htmlentities($item->getName()) ?></h2>
</div>

<div class="row mx-0 px-0">

  <!-- ALERT SUCCESS EDIT --->
  <?php if($success): ?>
    <div class="col-md-7 mt-3 px-2 mx-auto alert alert-success border-0 rounded-0">
      <p class="mb-0">The category has been edited with success.</p>
    </div>
  <?php endif ?>



  <!-- ALERT ERROR EDIT --->
  <?php if(!empty($errors)): ?>
    <div class="col-md-7 px-2 mt-3 mx-auto alert alert-danger border-0 rounded-0">
      <p class="mb-0">The category has not been edited with success.</p>
    </div>
  <?php endif ?>

  <div class="col-md-7 px-0 mx-auto my-5">
    <!-- FORM EDIT  --->
    <?php require('_form.php'); ?>

  </div>
</div>

