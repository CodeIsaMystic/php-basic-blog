<?php 
use App\Connection;

require dirname(__DIR__) . '/vendor/autoload.php';



$faker = Faker\Factory::create();
$pdo = Connection::getPDO();

$pdo->exec('SET FOREIGN_KEY_CHECKS = 0');
$pdo->exec('TRUNCATE TABLE post_category');
$pdo->exec('TRUNCATE TABLE post');
$pdo->exec('TRUNCATE TABLE category');
$pdo->exec('TRUNCATE TABLE user');
$pdo->exec('SET FOREIGN_KEY_CHECKS = 1');

$posts = [];
$categories = [];



for($i = 0; $i < 50; $i++) {
  $pdo->exec("
    INSERT INTO post 
    SET name='{$faker->sentence()}', 
        slug='{$faker->slug}', 
        created_at='{$faker->date} {$faker->time}', 
        content='{$faker->paragraphs(rand(3,15), true)}'
  ");
  $posts[] = $pdo->lastInsertId();
}

for($i = 0; $i < 5; $i++) {
  $pdo->exec("
    INSERT INTO category 
    SET name='{$faker->sentence(3)}', 
        slug='{$faker->slug}'
  ");
  $categories[] = $pdo->lastInsertId();
}

foreach($posts as $post) {
  $randomCategories = $faker->randomElements($categories, rand(0, count($categories)));
  foreach($randomCategories as $category) {
    $pdo->exec("
      INSERT INTO post_category 
      SET post_id=$post, 
          category_id=$category
    ");
  }
}

$password = password_hash('admin', PASSWORD_BCRYPT);
$pdo->exec("INSERT INTO user SET username='admin', password='$password'");

/*for($i = 0; $i < 50; $i++) {
  $pdo->exec("
  INSERT INTO post 
  SET name='Article #$i', 
      slug='article-$i', 
      created_at='2021-04-10 15:00:00', 
      content='Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis error facilis reprehenderit exercitationem explicabo doloremque, sit, similique rerum deserunt porro illo? Veritatis illo ipsam asperiores?'
  ");}*/
