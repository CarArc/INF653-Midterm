<?php
// POST /api/quotes/ — create a new quote
$data = json_decode(file_get_contents('php://input'));

if (!empty($data->quote) && !empty($data->author_id) && !empty($data->category_id)) {
    // Validate that author_id exists
    require_once '../../models/Author.php';
    $authorCheck     = new Author($db);
    $authorCheck->id = $data->author_id;
    if (!$authorCheck->read_single()) {
        http_response_code(200);
        echo json_encode(['message' => 'author_id Not Found']);
        exit;
    }

    // Validate that category_id exists
    require_once '../../models/Category.php';
    $categoryCheck     = new Category($db);
    $categoryCheck->id = $data->category_id;
    if (!$categoryCheck->read_single()) {
        http_response_code(200);
        echo json_encode(['message' => 'category_id Not Found']);
        exit;
    }

    $quote->quote       = $data->quote;
    $quote->author_id   = $data->author_id;
    $quote->category_id = $data->category_id;

    if ($quote->create()) {
        http_response_code(201);
        echo json_encode([
            'id'          => $quote->id,
            'quote'       => $quote->quote,
            'author_id'   => $quote->author_id,
            'category_id' => $quote->category_id,
        ]);
    } else {
        http_response_code(200);
        echo json_encode(['message' => 'Quote Not Created']);
    }
} else {
    http_response_code(200);
    echo json_encode(['message' => 'Missing Required Parameters']);
}
