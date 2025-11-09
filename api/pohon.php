<?php
declare(strict_types=1);
require_once __DIR__ . '/../app/init.php';
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];

$pohon = new PohonHandler();
try {
  switch ($method) {
    case 'POST':
      // code...
      break;
    case 'GET':
      echo json_encode($pohon->getAll());
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
