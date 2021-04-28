<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

  <title><?= isset($title) ? htmlentities($title) : 'Admin Dashboard' ?></title>

</head>
<body class="d-flex flex-column h-100">


  <nav class="navbar navbar-expand-lg navbar-dark bg-dark d-flex justify-content-between">
    <!--  CONTAINER   --->
    <div class="container-fluid">

      <!--  BRAND   --->
      <a href="<?= $router->url('home') ?>" class="navbar-brand fw-light fs-4 px-2 ms-4">My Site Blog</a>
    
      <!--  TOGGLER  --->
      <button class="navbar-toggler rounded-0 border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!--  COLLAPSE  --->
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav d-flex flex-row flex-wrap mt-3 mt-sm-0 ms-sm-auto">
          <li class="nav-item pt-1 ms-3">
            <a href="<?= $router->url('admin_home') ?>" class="nav-link fw-light fs-6 pt-3 px-2 px-md-3 mb-1">
              Dashboard
            </a>
          </li>
          <li class="nav-item pt-1">
            <a href="<?= $router->url('admin_posts') ?>" class="nav-link fw-light fs-6 pt-3 px-2 px-md-3 mb-1">
              Posts
            </a>
          </li>
          <li class="nav-item pt-1">
            <a href="<?= $router->url('admin_categories') ?>" class="nav-link fw-light fs-6 pt-3 px-2 px-md-3 mb-1">
              Categories
            </a>
          </li>
          <li class="nav-item d-flex align-items-center pt-1">
            <?php if(isset($_SESSION['auth'])): ?>
              <small class="text-white fs-6 fw-light px-2 mt-1">Admin Connected</small>
            <?php endif ?>
          </li>
          <li class="nav-item pt-1">
            <form class="d-inline" action="<?= $router->url('logout') ?>" method="post">
              <button type="submit" class="nav-link bg-dark border-0 text-decoration-none fw-light fs-5 px-2 mt-1 me-4">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0v-2z"/>
                  <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                </svg>
                <small>
                Logout
                </small>
              </button>
            </form>
          </li>
        
        </ul>
      </div>

    </div>
  </nav>


  <div class="container-fluid p-0 m-0">
    <?= $content ?>
  </div>

  <footer class="footer bg-light py-4 mt-auto">
    <div class="container">
      <?php if (defined('DEBUG_TIME')): ?>
        <small class="pb-2">Generated page in <?= round(1000 * (microtime(true) - DEBUG_TIME)) ?> ms. </small>
      <?php endif ?>
    </div>

  </footer>
  

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
  
</body>
</html>