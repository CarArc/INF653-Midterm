<?php
// POST /api/categories/ — create a new category
$data = json_decode(file_get_contents('php://input'));

if (!empty($data->category)) {
    $category->category = $data->category;

    if ($category->create()) {
        http_response_code(201);
        echo json_encode([
            'id'       => $category->id,
            'category' => $category->category,
        ]);
    } else {
        http_response_code(200);
        echo json_encode(['message' => 'Category Not Created']);
    }
} else {
    http_response_code(200);
    echo json_encode(['message' => 'Missing Required Parameters']);
}
