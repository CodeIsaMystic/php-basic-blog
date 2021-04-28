<?php 

use App\Auth;


Auth::check();

?>

<!-- LINK BACK TO FRONT --->
<?php if(isset($_SESSION['auth'])): ?>
<div class="container mx-0 px-0 py-3">
  <a href="<?= $router->url('admin_home') ?>" class="text-black-50 ps-3">
    Link to your Dashboard
  </a>
</div>
<?php endif ?>