<?php
declare(strict_types=1);
require_once __DIR__ . "/../db.php";

class AdminModel
{
  public function findByUname(string $username)
  {
    global $db;
    $stm = $db->prepare("SELECT * FROM tb_admin WHERE username = :uname LIMIT 1");
    $stm->bindParam(":uname", $username);
    $stm->execute();
    return $stm->fetch();
  }

  public function findAll()
  {
    global $db;
    $stm = $db->prepare("SELECT * FROM tb_admin");
    $stm->execute();
    return $stm->fetchAll();
  }
}