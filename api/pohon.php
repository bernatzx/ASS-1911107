<?php
declare(strict_types=1);
require_once __DIR__ . '/../app/init.php';
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];

$pohon = new PohonHandler();
$input = $_POST;

// Handle upload gambar
if (!empty($_FILES['gambar']['name'])) {
  $targetDir = __DIR__ . '/../public/uploads/';
  if (!is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
  }

  $filename = time() . '_' . basename($_FILES['gambar']['name']);
  $targetFile = $targetDir . $filename;

  if (move_uploaded_file($_FILES['gambar']['tmp_name'], $targetFile)) {
    $input['gambar'] = $filename;
  } else {
    $input['gambar'] = null;
  }
} else {
  $input['gambar'] = null;
}
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
try {
  switch ($method) {
    case 'POST':
      echo json_encode($id ? $pohon->updateData($id, $input) : $pohon->insertData($input));
      break;
    case 'GET':
      echo json_encode($id ? $pohon->getById($id) : $pohon->getAll());
      break;
    case 'DELETE':
      echo json_encode($pohon->deleteData($id));
      break;
    default:
      http_response_code(405);
      echo json_encode(['success' => false, 'msg' => 'Method tidak diizinkan']);
      break;
  }
} catch (\Throwable $e) {
  error_log("API error: " . $e->getMessage());
  http_response_code(500);
  echo json_encode(['success' => false, 'msg' => 'Terjadi kesalahan server']);
}
