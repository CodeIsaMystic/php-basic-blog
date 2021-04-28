<?php 
namespace App;

use \PDO;



class Connection {

  public static function getPDO(): PDO 
  {
    return new PDO('mysql:dbname=db_basic_blog;host=127.0.0.1', 'root', '', [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
  }
}