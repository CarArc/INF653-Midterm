<?php
// PUT /api/quotes/?id=X — update a quote
// Body: { "quote": "...", "author_id": 1, "category_id": 2 }
$data = json_decode(file_get_contents('php://input'));

// Accept id from query string or body
$id = isset($_GET['id']) ? $_GET['id'] : (isset($data->id) ? $data->id : null);

if (!empty($id) && !empty($data->quote) && !empty($data->author_id) && !empty($data->category_id)) {
    // Validate that author_id exists
    require_once '../../models/Author.php';
    $authorCheck     = new Author($db);
    $authorCheck->id = $data->author_id;
    if (!$authorCheck->read_single()) {
        http_response_code(404);
        echo json_encode(['message' => 'author_id Not Found']);
        exit;
    }

    // Validate that category_id exists
    require_once '../../models/Category.php';
    $categoryCheck     = new Category($db);
    $categoryCheck->id = $data->category_id;
    if (!$categoryCheck->read_single()) {
        http_response_code(404);
        echo json_encode(['message' => 'category_id Not Found']);
        exit;
    }

    $quote->id          = $id;
    $quote->quote       = $data->quote;
    $quote->author_id   = $data->author_id;
    $quote->category_id = $data->category_id;

    if ($quote->update()) {
        http_response_code(200);
        echo json_encode([
            'id'          => $quote->id,
            'quote'       => $quote->quote,
            'author_id'   => $quote->author_id,
            'category_id' => $quote->category_id,
        ]);
    } else {
        http_response_code(404);
        echo json_encode(['message' => 'No Quotes Found']);
    }
} elseif (!empty($id) && (empty($data->quote) || empty($data->author_id) || empty($data->category_id))) {
    http_response_code(400);
    echo json_encode(['message' => 'Missing Required Parameters']);
} else {
    http_response_code(400);
    echo json_encode(['message' => 'Missing Required Parameters']);
}
