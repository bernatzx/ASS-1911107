<?php
declare(strict_types=1);
require_once __DIR__ . "/../models/JPohonModel.php";

class JPohonHandler
{
  private JPohonModel $jenis;
  public function __construct()
  {
    $this->jenis = new JPohonModel();

    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
  }

  public function insertData(array $data)
  {
    if (empty(trim($data['jenis_pohon'] ?? ''))) {
      return ['success' => false, 'msg' => "Jenis wajib diisisssss."];
    }
    $exists = $this->jenis->findByJenis($data['jenis_pohon']);
    if ($exists) {
      return ['success' => false, 'msg' => 'Jenis sudah terdaftar'];
    }
    $inserted = $this->jenis->insert($data);
    if ($inserted) {
      return ['success' => true, 'msg' => 'Data berhasil ditambahkan'];
    }
    return ['success' => false, 'msg' => 'Gagal menambahkan data'];
  }

  public function updateData(int $id, array $data)
  {
    if (empty(trim($data['jenis_pohon'] ?? ''))) {
      return ['success' => false, 'msg' => "Semua field wajib diisi."];
    }
    $updated = $this->jenis->update($id, $data);
    if ($updated) {
      return ['success' => true, 'msg' => 'Data berhasil diubah'];
    }
    return ['success' => false, 'msg' => 'Gagal mengubah data'];
  }

  public function deleteData(int $id)
  {
    $exists = $this->jenis->findById($id);
    if (!$exists) {
      return ['success' => false, 'msg' => 'Data tidak ditemukan'];
    }

    $deleted = $this->jenis->delete($id);
    if ($deleted) {
      return ['success' => true, 'msg' => 'Data berhasil dihapus'];
    }
    return ['success' => false, 'msg' => 'Gagal menghapus data'];
  }

  public function getById(int $id)
  {
    $data = $this->jenis->findById($id);
    if ($data) {
      return ['success' => true, 'data' => $data];
    }
    return ['success' => false, 'msg' => 'Data tidak ditemukan'];
  }

  public function getAll()
  {
    $data = $this->jenis->findAll();
    if ($data && count($data) > 0) {
      return ["success" => true, "data" => $data];
    }
    return ["success" => false, "msg" => "Belum ada data"];
  }
}