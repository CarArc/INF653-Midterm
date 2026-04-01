<?php
// DELETE /api/categories/ — delete a category
$data = json_decode(file_get_contents('php://input'));

$id = isset($_GET['id']) ? $_GET['id'] : (isset($data->id) ? $data->id : null);

if (!empty($id)) {
    $category->id = $id;

    if (!$category->read_single()) {
        http_response_code(200);
        echo json_encode(['message' => 'No Categories Found']);
        exit;
    }

    if ($category->delete()) {
        http_response_code(200);
        echo json_encode(['id' => $id]);
    } else {
        http_response_code(200);
        echo json_encode(['message' => 'Category Not Deleted']);
    }
} else {
    http_response_code(200);
    echo json_encode(['message' => 'Missing Required Parameters']);
}
