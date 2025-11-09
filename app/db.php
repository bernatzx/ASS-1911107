<?php
$dsn = "mysql:host=localhost;dbname=db_ass1911107;charset=utf8mb4";
$user = "root";
$pass = "";

try {
  $db = new PDO($dsn, $user, $pass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  ]);
} catch (PDOException $e) {
  http_response_code(500);
  header('Content-Type: application/json');
  echo json_encode([
    'success' => false,
    'msg' => 'Database connection failed',
    'error' => $e->getMessage()
  ]);
  exit;
}
