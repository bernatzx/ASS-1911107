<?php
declare(strict_types=1);
require_once __DIR__ . "/../db.php";

class PohonModel
{
  public function findByPohon(string $pohon)
  {
    global $db;
    $stm = $db->prepare("SELECT * FROM tb_pohon WHERE nama_pohon = :pohon LIMIT 1");
    $stm->bindParam(":pohon", $pohon);
    $stm->execute();
    return $stm->fetch();
  }

  public function findAll()
  {
    global $db;
    $stm = $db->prepare("SELECT * FROM tb_pohon");
    $stm->execute();
    return $stm->fetchAll();
  }
}