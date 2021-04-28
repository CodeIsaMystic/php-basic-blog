<?php
use App\Connection;
use App\Table\PostTable;
use App\Auth;


Auth::check();


//$router->layout = "admin/layouts/default";
$title = "Dashboard admin";
$pdo = Connection::getPDO();
$link = $router->url('admin_posts');
[$items, $pagination] = (new PostTable($pdo))->findPaginated();

?>



<!--  HEADING ADMIN INDEX  -->
<div class="container-fluid bg-light m-0 px-0 py-5">
  <h1 class="display-2 text-center pt-5 m-0">Dashboard: Posts</h1>
  <h5 class="text-center text-black-50 fw-light m-0 pb-5 pt-2">Manage your posts...</h5>
</div>

  <!-- LINK BACK TO FRONT --->
<?php if(isset($_SESSION['auth'])): ?>
<div class="container mx-0 px-0 py-3">
  <a href="<?= $router->url('home') ?>" class="text-black-50 ps-4">
    Link to your Website
  </a>
</div>
<?php endif ?>

<div class="container-fluid mt-5">
  <div class="row mx-0 px-0">

    <!--  SUB-HEADING ADMIN INDEX  -->
    <div class="col-md-10 mx-auto">
      <h2 class="text-secondary text-center pt-5 m-0">Welcome to your posts table</h2>
      
      <p class="text-muted fw-light m-0 pb-5 pt-4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente, dolor. Veniam, animi ad deleniti impedit eveniet esse, reiciendis architecto illo sunt libero fuga tempora quia quis asperiores officia at ut, officiis ipsa accusamus. Veritatis libero, porro ipsum fugit maiores ab! Eius eaque omnis ullam voluptates totam optio odit minima voluptatum.</p>
    </div>

    <!-- ALERT SUCCESS CREATED --->
    <?php if(isset($_GET['created'])): ?>
      <div class="col-md-8 mt-3 px-2 mx-3 mx-md-auto alert alert-success border-0 rounded-0">
        <p class="mb-0">The post has been registered with success.</p>
      </div>
    <?php endif ?>
  
    <!-- ALERT CONFIRM DELETE ACTION  --->
    <?php if(isset($_GET['delete'])): ?>
    <div class="col-md-8 px-2 mx-3 mx-md-auto alert alert-success rounded-0">
      <p class="mb-0">The post has been deleted with success.</p>
    </div>
    <?php endif ?>

    <!--   TABLE POSTS LISTING  --->  
    <div class="col-md-8 px-3 px-md-0 mx-auto mt-5">
      <table class="table caption-top px-0 mx-0">
        <caption>List of Posts</caption>
        <thead>
          <th class="border-bottom-0 fs-5 d-none d-md-table-cell">ID</th>
          <th class="border-bottom-0 fs-5">Title</th>
          <th class="d-flex justify-content-end border-bottom-0">
              <a  class="text-decoration-none text-dark fs-4"
                  href="<?= $router->url('admin_post_new') ?>">
                <button class="d-table-cell bg-light border-0 pt-1 ps-1 ps-xl-3 pe-2 pe-xl-4 me-0 me-xl-4">
                  <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-plus mb-1" viewBox="0 0 16 16">
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                  </svg>
                  New
                </button>
              </a>
          </th>
        </thead>
        <tbody>
          <?php foreach($items as $item): ?>
          <tr>
            <td class="border-bottom-0 fw-bold d-none d-md-table-cell"><?= $item->getID() ?></td>
            <td>
              <a class="text-decoration-none text-dark"
                href="<?= $router->url('admin_post', ['id'=> $item->getID()]) ?>">
              <?= htmlentities($item->getName()) ?>
              </a>
            </td>
            <td class="d-flex justify-content-end border-bottom-0 me-0 me-xl-4">
              <a class="text-decoration-none btn btn-primary rounded-0"
                 href="<?= $router->url('admin_post', ['id'=> $item->getID()]) ?>">
              Edit
              </a>
              <form method="POST"class="d-inline-block"
                    action="<?= $router->url('admin_post_delete', ['id'=> $item->getID()]) ?>"
                    onSubmit="return confirm('Are You sure, you want to delete that post?')">
                <button typ="submit" class="text-decoration-none text-dark btn btn-light rounded-0">
                  Delete
                </button>
              </form>
            
            </td>
          </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>


<!--  PAGINATION  -->
<div class="row mx-0 px-3 px-md-0 mb-5">
    <div class="col-md-8 p-0 mx-auto">
      <div class="d-flex justify-content-between my-4">

          <?= $pagination->previousLink($link); ?>
          <?= $pagination->nextLink($link); ?>

      </div>
    </div>
</div>