<form action="" method="POST" enctype="multipart/form-data">

  <div class="row mx-0 px-0">
    <div class="col-md-6">
      <?= $form->input('name', 'Title'); ?>
      <?= $form->input('slug', 'URL'); ?>
    </div>
    <div class="col-md-6">
      <?= $form->select('categories_ids', 'Categories', $categories); ?>
    </div>
  </div>



  <div class="row mx-0 px-0">
    <div class="col-md-8">
      <?= $form->file('image', 'Hero image'); ?>
    </div>
    <div class="col-md-4">
      <?php if($post->getImage()): ?>
        <img src="<?= $post->getImageURL('small') ?>" alt="image hero" class="w-100 pt-4">
      <?php endif ?>
    </div>
  </div>

  <?= $form->textarea('content', 'Post content'); ?>
  <?= $form->input('created_at', 'Posted date'); ?>

  <button class="btn btn-primary rounded-0 my-4">
    <?php if($post->getID() !== null): ?>
      Edit 
    <?php else: ?>
      Create
    <?php endif ?>
      your post
  </button>

</form>