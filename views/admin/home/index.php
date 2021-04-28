<?php
use App\Auth;


Auth::check();

$title = "Dashboard home admin";
$link = $router->url('admin_home');

?>


<!--  HEADING ADMIN INDEX  -->
<div class="container-fluid bg-light m-0 px-0 py-5">
  <h1 class="display-2 text-center pt-5 m-0">Dashboard</h1>
  <h5 class="text-center text-black-50 fw-light m-0 pb-5 pt-2">Welcome to your dashboard</h5>
</div>


<!-- LINK BACK TO FRONT --->
<?php if(isset($_SESSION['auth'])): ?>
<div class="container mx-0 px-0 py-3">
  <a href="<?= $router->url('home') ?>" class="text-black-50 ps-4">
    Link to your Website
  </a>
</div>
<?php endif ?>