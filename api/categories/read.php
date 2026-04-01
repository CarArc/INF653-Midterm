<?php
// GET /api/categories/ — return all categories
$results = $category->read()->fetchAll(PDO::FETCH_ASSOC);

if (count($results) > 0) {
    $categories_arr = [];
    foreach ($results as $row) {
        $categories_arr[] = [
            'id'       => $row['id'],
            'category' => $row['category'],
        ];
    }
    http_response_code(200);
    echo json_encode($categories_arr);
} else {
    http_response_code(404);
    echo json_encode(['message' => 'No Categories Found']);
}
