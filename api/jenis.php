<?php
declare(strict_types=1);

require_once __DIR__ . '/../app/init.php';
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];

$jenis = new JPohonHandler();
$input = json_decode(file_get_contents('php://input'), true);
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;

try {
  switch ($method) {
    case 'POST':
      echo json_encode($jenis->insertData($input));
      break;
    case 'GET':
      echo json_encode($id ? $jenis->getById($id) : $jenis->getAll());
      break;
    case 'PUT':
      echo json_encode($jenis->updateData($id, $input));
      break;
    case 'DELETE':
      echo json_encode($jenis->deleteData($id));
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
