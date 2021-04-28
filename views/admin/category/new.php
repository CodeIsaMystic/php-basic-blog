<?php

use App\Connection;
use App\Table\CategoryTable;
use App\Validators\CategoryValidator;
use App\HTML\Form;
use App\ObjectHelper;
use App\Model\Category;
use App\Auth;


Auth::check();


$errors = [];
$item = new Category();


if(!empty($_POST)) {
  $pdo = Connection::getPDO();
  $table = new CategoryTable($pdo);
  $fields = ['name', 'slug'];

  $v = new CategoryValidator($_POST, $table);
  ObjectHelper::hydrate($item, $_POST, $fields);

  if($v->validate()) {
    $table->create([
      'name' => $item->getName(),
      'slug' => $item->getSlug()
    ]);
    header("Location: " . $router->url('admin_categories') . '?created=1');
    exit();
  } else {
    $errors = $v->errors();
  }
}

$form = new Form($item, $errors);
?>



<!--  HEADING ADMIN REGISTER PAGE  -->
<div class="container-fluid bg-light m-0 px-0 py-5">
  <h1 class="w-75 font-weight-bold display-2 text-center pt-5 m-0 mx-auto"> Dashboard: Create New
  Category </h1>
  <h5 class="text-center text-black-50 fw-light m-0 pb-5 pt-2">
    Edit a brand NEW category...
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
      <div class="col-md-6 px-2 mt-3 mx-auto alert alert-danger border-0 rounded-0">
        <p class="mb-0">The category has not been registered with success.</p>
      </div>
    <?php endif ?>

    <div class="col-md-6 px-0 mx-auto my-5">

      <!-- FORM REGISTER  --->
      <?php require('_form.php') ?>

    </div>

  </div>
</div>
