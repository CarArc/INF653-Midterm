<?php
// PUT /api/authors/ — update an author
$data = json_decode(file_get_contents('php://input'));

$id = isset($_GET['id']) ? $_GET['id'] : (isset($data->id) ? $data->id : null);

if (!empty($id) && !empty($data->author)) {
    $author->id     = $id;
    $author->author = $data->author;

    if ($author->update()) {
        http_response_code(200);
        echo json_encode([
            'id'     => $author->id,
            'author' => $author->author,
        ]);
    } else {
        http_response_code(200);
        echo json_encode(['message' => 'Author Not Updated']);
    }
} else {
    http_response_code(200);
    echo json_encode(['message' => 'Missing Required Parameters']);
}
