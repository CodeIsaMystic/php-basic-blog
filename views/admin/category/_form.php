<form action="" method="POST">

  <?= $form->input('name', 'Title'); ?>
  <?= $form->input('slug', 'URL'); ?>

  <button class="btn btn-primary rounded-0 my-4">
    <?php if($item->getID() !== null): ?>
      Edit 
    <?php else: ?>
      Create
    <?php endif ?>
      your category
  </button>
  
</form>