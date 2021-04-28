<?php
namespace App\Table\Exception;



class NotFoundException extends \Exception {

  public function __construct(string $table, $id) 
  {
    $this->message = "No Matching Registered ID on number: #$id within the Table: $table";
  }
}