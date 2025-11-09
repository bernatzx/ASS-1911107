<?php
declare(strict_types=1);
require_once __DIR__ . "/../models/PohonModel.php";

class PohonHandler
{
  private PohonModel $pohon;
  public function __construct()
  {
    $this->pohon = new PohonModel();

    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
  }

  public function getByPohon($pohon): array
  {
    $data = $this->pohon->findByPohon($pohon);
    if ($data) {
      return ["success" => true, "data" => $data];
    }
    return ["success" => false, "msg" => "Data tidak ditemukan"];
  }

  public function getAll()
  {
    $data = $this->pohon->findAll();
    if ($data && count($data) > 0) {
      return ["success" => true, "data" => $data];
    }
    return ["success" => false, "msg" => "Belum ada data"];
  }
}