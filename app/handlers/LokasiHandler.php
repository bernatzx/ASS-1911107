<?php
declare(strict_types=1);
require_once __DIR__ . "/../models/LokasiModel.php";

class LokasiHandler
{
  private LokasiModel $lokasi;
  public function __construct()
  {
    $this->lokasi = new LokasiModel();

    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
  }

  public function insertData(array $data)
  {
    $exists = $this->lokasi->findByLokasi($data['nama_lokasi']);
    if ($exists) {
      return ['success' => false, 'msg' => 'Lokasi sudah terdaftar'];
    }
    $inserted = $this->lokasi->insert($data);
    if ($inserted) {
      return ['success' => true, 'msg' => 'Data berhasil ditambahkan'];
    }
    return ['success' => false, 'msg' => 'Gagal menambahkan data'];
  }

  public function getById(int $id)
  {
    $data = $this->lokasi->findById($id);
    if ($data) {
      return ['success' => true, 'data' => $data];
    }
    return ['success' => false, 'msg' => 'Data tidak ditemukan'];
  }

  public function updateData(int $id, array $data)
  {
    $existing = $this->lokasi->findById($id);
    if (!$existing) {
      return ['success' => false, 'msg' => 'Data tidak ditemukan'];
    }
    $updated = $this->lokasi->update($id, $data);
    if ($updated) {
      return ['success' => true, 'msg' => 'Data berhasil diubah'];
    }
    return ['success' => false, 'msg' => 'Gagal mengubah data'];
  }


  public function deleteData(int $id)
  {
    $exists = $this->lokasi->findById($id);
    if (!$exists) {
      return ['success' => false, 'msg' => 'Data tidak ditemukan'];
    }

    $deleted = $this->lokasi->delete($id);
    if ($deleted) {
      return ['success' => true, 'msg' => 'Data berhasil dihapus'];
    }
    return ['success' => false, 'msg' => 'Gagal menghapus data'];
  }

  public function getByLokasi($pohon): array
  {
    $data = $this->lokasi->findByLokasi($pohon);
    if ($data) {
      return ["success" => true, "data" => $data];
    }
    return ["success" => false, "msg" => "Data tidak ditemukan"];
  }

  public function getAll()
  {
    $data = $this->lokasi->findAll();
    if ($data && count($data) > 0) {
      return ["success" => true, "data" => $data];
    }
    return ["success" => false, "msg" => "Belum ada data"];
  }
}