<?php
declare(strict_types=1);
require_once __DIR__ . "/../db.php";

class LokasiModel
{
  public function findByLokasi(string $lokasi)
  {
    global $db;
    $stm = $db->prepare("SELECT * FROM tb_lokasi WHERE nama_lokasi = :lokasi LIMIT 1");
    $stm->bindParam(":lokasi", $lokasi);
    $stm->execute();
    return $stm->fetch();
  }

  public function update(int $id, array $data)
  {
    global $db;

    $stm = $db->prepare("UPDATE tb_lokasi 
        SET id_jenis = :id_jenis,
            nama_lokasi = :nama_lokasi, 
            latitude = :lat, 
            longitude = :lng, 
            desa = :desa, 
            kota = :kota
        WHERE id = :id_lokasi
    ");
    $stm->bindParam(':id_jenis', $data['jenis_pohon']);
    $stm->bindParam(':nama_lokasi', $data['nama_lokasi']);
    $stm->bindParam(':lat', $data['latitude']);
    $stm->bindParam(':lng', $data['longitude']);
    $stm->bindParam(':desa', $data['desa']);
    $stm->bindParam(':kota', $data['kota']);
    $stm->bindParam(':id_lokasi', $id, PDO::PARAM_INT);
    return $stm->execute();
  }


  public function findById(int $id)
  {
    global $db;
    $stm = $db->prepare("SELECT
        l.id,
        l.nama_lokasi,
        l.latitude,
        l.longitude,
        l.desa,
        l.kota,
        j.id AS id_jenis,
        j.jenis_pohon,
        j.gambar
      FROM tb_lokasi l
      JOIN tb_jenis j ON l.id_jenis = j.id
      WHERE l.id = :id
    ");
    $stm->bindParam(':id', $id, PDO::PARAM_INT);
    $stm->execute();
    return $stm->fetch();
  }

  public function insert(array $data)
  {
    global $db;
    $stm = $db->prepare("INSERT INTO tb_lokasi (id_jenis, nama_lokasi, latitude, longitude, desa, kota) VALUES (:id_jenis, :nama_lokasi, :lat, :lng, :desa, :kota)");
    $stm->bindParam(':id_jenis', $data['jenis_pohon']);
    $stm->bindParam(':nama_lokasi', $data['nama_lokasi']);
    $stm->bindParam(':lat', $data['latitude']);
    $stm->bindParam(':lng', $data['longitude']);
    $stm->bindParam(':desa', $data['desa']);
    $stm->bindParam(':kota', $data['kota']);
    return $stm->execute();
  }

  public function delete(int $id)
  {
    global $db;
    $stm = $db->prepare("DELETE FROM tb_lokasi WHERE id = :id_lokasi");
    $stm->bindParam(':id_lokasi', $id, PDO::PARAM_INT);
    return $stm->execute();
  }


  public function findAll()
  {
    global $db;
    $stm = $db->prepare("SELECT
        l.id,
        l.nama_lokasi,
        l.latitude,
        l.longitude,
        l.desa,
        l.kota,
        j.id AS id_jenis,
        j.jenis_pohon,
        j.gambar
      FROM tb_lokasi l
      JOIN tb_jenis j ON l.id_jenis = j.id
    ");
    $stm->execute();
    return $stm->fetchAll();
  }
}