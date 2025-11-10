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

  public function update(int $id, array $data)
  {
    global $db;

    $lokasi = $db->prepare("UPDATE tb_lokasi 
        SET nama_lokasi = :nama_lokasi, 
            latitude = :lat, 
            longitude = :lng, 
            desa = :desa, 
            kota = :kota
        WHERE id = :id_lokasi
    ");
    $lokasi->bindParam(':nama_lokasi', $data['nama_lokasi']);
    $lokasi->bindParam(':lat', $data['latitude']);
    $lokasi->bindParam(':lng', $data['longitude']);
    $lokasi->bindParam(':desa', $data['desa']);
    $lokasi->bindParam(':kota', $data['kota']);
    $lokasi->bindParam(':id_lokasi', $data['id_lokasi']);
    $lokasi->execute();

    // Update tabel pohon
    $pohon = $db->prepare("UPDATE tb_pohon 
        SET id_jenis = :id_jenis, 
            nama_pohon = :nama_pohon, 
            gambar = :gambar
        WHERE id = :id
    ");
    $pohon->bindParam(':id', $id, PDO::PARAM_INT);
    $pohon->bindParam(':id_jenis', $data['jenis_pohon']);
    $pohon->bindParam(':nama_pohon', $data['nama_pohon']);
    $pohon->bindParam(':gambar', $data['gambar']);

    return $pohon->execute();
  }


  public function findById(int $id)
  {
    global $db;
    $stm = $db->prepare("SELECT
        p.id,
        p.nama_pohon,
        p.gambar,
        j.id AS id_jenis,
        j.jenis_pohon,
        l.id AS id_lokasi,
        l.nama_lokasi,
        l.latitude,
        l.longitude,
        l.desa,
        l.kota
      FROM tb_pohon p
      JOIN tb_jenis j ON p.id_jenis = j.id
      JOIN tb_lokasi l ON p.id_lokasi = l.id
      WHERE p.id = :id
    ");
    $stm->bindParam(':id', $id, PDO::PARAM_INT);
    $stm->execute();
    return $stm->fetch();
  }

  public function insert(array $data)
  {
    global $db;
    $lokasi = $db->prepare("INSERT INTO tb_lokasi (nama_lokasi, latitude, longitude, desa, kota) VALUES (:nama_lokasi, :lat, :lng, :desa, :kota)");
    $lokasi->bindParam(':nama_lokasi', $data['nama_lokasi']);
    $lokasi->bindParam(':lat', $data['latitude']);
    $lokasi->bindParam(':lng', $data['longitude']);
    $lokasi->bindParam(':desa', $data['desa']);
    $lokasi->bindParam(':kota', $data['kota']);
    $lokasi->execute();

    $id_lokasi = $db->lastInsertId();

    $pohon = $db->prepare("INSERT INTO tb_pohon (id_lokasi, id_jenis, nama_pohon, gambar) VALUES (:id_lokasi, :id_jenis, :nama_pohon, :gambar)");
    $pohon->bindParam(':id_lokasi', $id_lokasi);
    $pohon->bindParam(':id_jenis', $data['jenis_pohon']);
    $pohon->bindParam(':nama_pohon', $data['nama_pohon']);
    $pohon->bindParam(':gambar', $data['gambar']);
    return $pohon->execute();
  }

  public function delete(int $idpohon, int $idlokasi)
  {
    global $db;
    $delPohon = $db->prepare("DELETE FROM tb_pohon WHERE id = :id");
    $delPohon->bindParam(':id', $idpohon, PDO::PARAM_INT);
    $delPohon->execute();

    $delLokasi = $db->prepare("DELETE FROM tb_lokasi WHERE id = :id_lokasi");
    $delLokasi->bindParam(':id_lokasi', $idlokasi, PDO::PARAM_INT);
    return $delLokasi->execute();
  }


  public function findAll()
  {
    global $db;
    $stm = $db->prepare("SELECT
        p.id,
        p.nama_pohon,
        p.gambar,
        j.id AS id_jenis,
        j.jenis_pohon,
        l.id AS id_lokasi,
        l.nama_lokasi,
        l.latitude,
        l.longitude,
        l.desa,
        l.kota
      FROM tb_pohon p
      JOIN tb_jenis j ON p.id_jenis = j.id
      JOIN tb_lokasi l ON p.id_lokasi = l.id
    ");
    $stm->execute();
    return $stm->fetchAll();
  }
}