<?php
// PUT /api/categories/?id=X — update a category
$data = json_decode(file_get_contents('php://input'));

// Accept id from query string or body
$id = isset($_GET['id']) ? $_GET['id'] : (isset($data->id) ? $data->id : null);

if (!empty($id) && !empty($data->category)) {
    $category->id       = $id;
    $category->category = $data->category;

    if ($category->update()) {
        http_response_code(200);
        echo json_encode([
            'id'       => $category->id,
            'category' => $category->category,
        ]);
    } else {
        http_response_code(500);
        echo json_encode(['message' => 'Category Not Updated']);
    }
} else {
    http_response_code(400);
    echo json_encode(['message' => 'Missing Required Parameters']);
}
