<?php 
$categories = [];
foreach($post->getCategories() as $category) {
  $url = $router->url('category', ['id' => $category->getID(), 'slug' => $category->getSlug()]);
  $categories[] = <<<HTML
  <a  href="{$url}" 
      class="badge btn text-decoration-none bg-primary">
    &nbsp;{$category->getName()}
  </a>
HTML;
}
?>



<!--  CARD  -->
<div class="card rounded-0 border-0 m-1 mt-3 mb-5">
  <?php if($post->getImage()) : ?>
    <img src="<?= $post->getImageURL('large') ?>" alt="image hero" class="card-img-top">
  <?php endif ?>
  <h5 class="card-title display-4 mt-5"><?= htmlentities($post->getName()) ?></h5>
  <div class="card-body px-2 py-1">
    <div class="pb-5 pt-3 px-0 m-0 mb-5">
      <small class="text-muted">
        <?= $post->getCreatedAt()->format('d F Y') ?>
        <?= implode('&nbsp;', $categories) ?>
      </small>
    </div>
    <p class="fw-light mb-0 mt-4"><?= $post->getExcerpt() ?></p>
    <p class="mb-0 mt-3">
      <a  href="<?= $router->url('post', ['id' => $post->getID(), 'slug' => $post->getSlug()]) ?>" 
          class="text-decoration-underline text-body fst-italic py-1">
        Read More
      </a>
    </p>
  </div>
</div>