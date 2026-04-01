<?php
// ── CORS & Content-Type headers (required for automated tests) ──
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'OPTIONS') {
    header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
    header('Access-Control-Allow-Headers: Origin, Accept, Content-Type, X-Requested-With');
    exit();
}

// ── Bootstrap ──
require_once '../../config/Database.php';
require_once '../../models/Author.php';

$database = new Database();
$db       = $database->connect();
$author   = new Author($db);

// ── Route by HTTP method ──
switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            $author->id = $_GET['id'];
            require 'read_single.php';
        } else {
            require 'read.php';
        }
        break;

    case 'POST':
        require 'create.php';
        break;

    case 'PUT':
        require 'update.php';
        break;

    case 'DELETE':
        require 'delete.php';
        break;

    default:
        http_response_code(405);
        echo json_encode(['message' => 'Method Not Allowed']);
        break;
}
