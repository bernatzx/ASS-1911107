<?php
declare(strict_types=1);
ini_set('display_errors', '1');
error_reporting(E_ALL);
require_once __DIR__ . '/../app/init.php';
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];

$lokasi = new LokasiHandler();
$input = json_decode(file_get_contents('php://input'), true);
$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
try {
  switch ($method) {
    case 'POST':
      echo json_encode($id ? $lokasi->updateData($id, $input) : $lokasi->insertData($input));
      break;
    case 'GET':
      echo json_encode($id ? $lokasi->getById($id) : $lokasi->getAll());
      break;
    case 'DELETE':
      echo json_encode($lokasi->deleteData($id));
      break;
    default:
      http_response_code(405);
      echo json_encode(['success' => false, 'msg' => 'Method tidak diizinkan']);
      break;
  }
} catch (\Throwable $e) {
  error_log("API error: " . $e->getMessage());
  http_response_code(500);
  echo json_encode([
    'success' => false,
    'msg' => 'Terjadi kesalahan server',
    'debug' => $e->getMessage() // tambahkan baris ini untuk melihat error aslinya
  ]);
  // error_log("API error: " . $e->getMessage());
  // http_response_code(500);
  // echo json_encode(['success' => false, 'msg' => 'Terjadi kesalahan server']);
}
