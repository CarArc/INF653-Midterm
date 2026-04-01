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
require_once '../../models/Quote.php';

$database = new Database();
$db       = $database->connect();
$quote    = new Quote($db);

// ── Route by HTTP method ──
switch ($method) {
    case 'GET':
        if (isset($_GET['id'])) {
            // Single quote by id
            $quote->id = $_GET['id'];
            require 'read_single.php';
        } else {
            // All quotes, with optional ?author_id= and/or ?category_id= filters
            $quote->author_id   = isset($_GET['author_id'])   ? $_GET['author_id']   : null;
            $quote->category_id = isset($_GET['category_id']) ? $_GET['category_id'] : null;
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
