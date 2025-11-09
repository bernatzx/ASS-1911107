<?php
declare(strict_types=1);
require_once __DIR__ . '/../app/init.php';
header('Content-Type: application/json');
$method = $_SERVER['REQUEST_METHOD'];

$auth = new AdminHandler();

try {
    switch ($method) {
        case 'POST':
            $input = json_decode(file_get_contents('php://input'), true);
            $action = $input['action'] ?? '';

            switch ($action) {
                case 'login':
                    $username = $input['username'] ?? '';
                    $sandi = $input['sandi'] ?? '';
                    echo json_encode($auth->login($username, $sandi));
                    break;

                case 'logout':
                    echo json_encode($auth->logout());
                    break;

                case 'me':
                    echo json_encode($auth->me());
                    break;

                default:
                    http_response_code(400);
                    echo json_encode(['success' => false, 'msg' => 'Aksi tidak diizinkan']);
                    break;
            }
            break;
        case 'GET':
            echo json_encode($auth->getAll());
            break;
        default:
            http_response_code(405);
            echo json_encode(['success' => false, 'msg' => 'Method tidak diizinkan']);
            break;
    }
} catch (\Throwable $e) {
    error_log("Auth API error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['success' => false, 'msg' => 'Terjadi kesalahan server']);
}
