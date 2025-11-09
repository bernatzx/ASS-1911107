<?php
declare(strict_types=1);
require_once __DIR__ . "/../models/AdminModel.php";

class AdminHandler
{
  private AdminModel $admin;
  public function __construct()
  {
    $this->admin = new AdminModel();

    if (session_status() === PHP_SESSION_NONE) {
      session_start();
    }
  }

  public function login($username, $sandi)
  {
    $data = $this->admin->findByUname($username);
    if ($data && password_verify($sandi, $data["sandi"])) {
      $_SESSION["valid"] = true;
      $_SESSION["userId"] = $data["id"];
      $_SESSION["role"] = "admin";
      return ["success" => true];
    }
    return ["success" => false, "msg" => "Username atau sandi salah!"];
  }

  public function getAll()
  {
    $data = $this->admin->findAll();
    if ($data && count($data) > 0) {
      return ["success" => true, "data" => $data];
    }
    return ["success" => false, "msg" => "Belum ada data"];
  }

  public function me()
  {
    if (isset($_SESSION["valid"]) && $_SESSION["valid"] === true) {
      return ["valid" => true, "role" => $_SESSION["role"] ?? "guest"];
    }
    return ["valid" => false, "role" => "guest"];
  }
}