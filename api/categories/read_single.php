<?php
// GET /api/categories/?id=X — return a single category
if ($category->read_single()) {
    $category_arr = [
        'id'       => $category->id,
        'category' => $category->category,
    ];
    http_response_code(200);
    echo json_encode($category_arr);
} else {
    http_response_code(404);
    echo json_encode(['message' => 'Category Not Found']);
}
