<?php
// DELETE /api/authors/ — delete an author
$data = json_decode(file_get_contents('php://input'));

$id = isset($_GET['id']) ? $_GET['id'] : (isset($data->id) ? $data->id : null);

if (!empty($id)) {
    $author->id = $id;

    if (!$author->read_single()) {
        http_response_code(200);
        echo json_encode(['message' => 'No Authors Found']);
        exit;
    }

    if ($author->delete()) {
        http_response_code(200);
        echo json_encode(['id' => $id]);
    } else {
        http_response_code(200);
        echo json_encode(['message' => 'Author Not Deleted']);
    }
} else {
    http_response_code(200);
    echo json_encode(['message' => 'Missing Required Parameters']);
}
