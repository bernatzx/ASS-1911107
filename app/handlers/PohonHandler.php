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

  public function insertData(array $data)
  {
    $temp = $data;
    unset($temp['gambar']);

    if (in_array("", $temp, true)) {
      return ['success' => false, 'msg' => "Semua field wajib diisi (kecuali gambar)."];
    }
    $exists = $this->pohon->findByPohon($data['nama_pohon']);
    if ($exists) {
      return ['success' => false, 'msg' => 'Pohon sudah terdaftar'];
    }
    $inserted = $this->pohon->insert($data);
    if ($inserted) {
      return ['success' => true, 'msg' => 'Data berhasil ditambahkan'];
    }
    return ['success' => false, 'msg' => 'Gagal menambahkan data'];
  }

  public function getById(int $id)
  {
    $data = $this->pohon->findById($id);
    if ($data) {
      return ['success' => true, 'data' => $data];
    }
    return ['success' => false, 'msg' => 'Data tidak ditemukan'];
  }

  public function updateData(int $id, array $data)
  {
    $temp = $data;
    unset($temp['gambar']);

    if (in_array("", $temp, true)) {
      return ['success' => false, 'msg' => "Semua field wajib diisi (kecuali gambar)."];
    }
    $updated = $this->pohon->update($id, $data);
    if ($updated) {
      return ['success' => true, 'msg' => 'Data berhasil diubah'];
    }
    return ['success' => false, 'msg' => 'Gagal mengubah data'];
  }

  public function deleteData(int $id)
  {
    $exists = $this->pohon->findById($id);
    if (!$exists) {
      return ['success' => false, 'msg' => 'Data tidak ditemukan'];
    }

    $deleted = $this->pohon->delete((int) $id, (int) $exists['id_lokasi']);
    if ($deleted) {
      return ['success' => true, 'msg' => 'Data berhasil dihapus'];
    }
    return ['success' => false, 'msg' => 'Gagal menghapus data'];
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