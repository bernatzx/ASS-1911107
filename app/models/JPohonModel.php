<?php
declare(strict_types=1);
require_once __DIR__ . "/../db.php";

class JPohonModel
{
  public function insert(array $data)
  {
    global $db;
    $stm = $db->prepare("INSERT INTO tb_jenis (jenis_pohon, gambar) VALUE (:jenis, :gambar)");
    $stm->bindParam(':jenis', $data['jenis_pohon']);
    $stm->bindParam(':gambar', $data['gambar']);
    return $stm->execute();
  }

  public function update(int $id, array $data)
  {
    global $db;
    $stm = $db->prepare("UPDATE tb_jenis SET jenis_pohon = :jenis, gambar = :gambar WHERE id = :id");
    $stm->bindParam(':jenis', $data['jenis_pohon']);
    $stm->bindParam(':gambar', $data['gambar']);
    $stm->bindParam(':id', $id, PDO::PARAM_INT);
    return $stm->execute();
  }

  public function delete(int $id)
  {
    global $db;
    $stm = $db->prepare("DELETE FROM tb_jenis WHERE id = :id");
    $stm->bindParam(':id', $id, PDO::PARAM_INT);
    return $stm->execute();
  }

  public function findById(int $id)
  {
    global $db;
    $stm = $db->prepare("SELECT * FROM tb_jenis WHERE id = :id LIMIT 1");
    $stm->bindParam(':id', $id, PDO::PARAM_INT);
    $stm->execute();
    return $stm->fetch();
  }

  public function findByJenis(string $jenis)
  {
    global $db;
    $stm = $db->prepare("SELECT * FROM tb_jenis WHERE jenis_pohon = :jenis LIMIT 1");
    $stm->bindParam(":jenis", $jenis);
    $stm->execute();
    return $stm->fetch();
  }

  public function findAll()
  {
    global $db;
    $stm = $db->prepare("SELECT * FROM tb_jenis");
    $stm->execute();
    return $stm->fetchAll();
  }
}