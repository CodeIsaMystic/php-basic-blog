<?php


use App\Model\User;
use App\HTML\Form;
use App\Connection;
use App\Table\UserTable;
use App\Table\Exception\NotFoundException;



$user = new User();
$errors = [];

if(!empty($_POST)) {
  $user->setUsername($_POST['username']);
  $errors['password'] = 'Your Login Username or Password is invalid';

  if(!empty($_POST['username']) && !empty($_POST['password'])) {
    $table = new UserTable(Connection::getPDO());
  
    try {
      $u = $table->findByUsername($_POST['username']);

      if(password_verify($_POST['password'], $u->getPassword()) === true) {
        session_start();
        $_SESSION['auth'] = $u->getID();
        header('Location: ' . $router->url('admin_home'));
        exit();
      }
    } catch (NotFoundException $e) {
    }
  }
}


$form = new Form($user, $errors);
?>


<!--  HEADING ADMIN LOGIN PAGE  -->
<div class="container-fluid bg-light m-0 px-0 py-5">

  <h1 class="w-75 font-weight-bold display-2 text-center pt-5 m-0 mx-auto">
   Login
  </h1>
  <h5 class="text-center text-black-50 fw-light m-0 pb-5 pt-2">
    Enter your username and password to connect...
  </h5>
</div>


<!-- ALERT ERROR LOGIN --->
<?php if(isset($_GET['forbidden'])): ?>
  <div class="col-md-8 px-2 mt-3 mx-auto alert alert-danger border-0 rounded-0">
    <p class="mb-0">Sorry, you can not access to Admin. You need to connect.</p>
  </div>
<?php endif ?>

<div class="row mb-5 mx-0 px-0">
  <div class="col-md-8 px-3 px-md-0 mx-auto my-5">
    <!-- FORM LOGIN  --->
    <form action="<?= $router->url('login') ?>" method="POST">

      <?= $form->input('username', 'Username'); ?>
      <?= $form->input('password', 'Password'); ?>
    
      <button type="submit" class="btn btn-primary rounded-0 my-4">
          Login
      </button>
      
    </form>

  </div>
</div>