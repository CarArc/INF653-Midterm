<?php
// POST /api/authors/ — create a new author
$data = json_decode(file_get_contents('php://input'));

if (!empty($data->author)) {
    $author->author = $data->author;

    if ($author->create()) {
        http_response_code(201);
        echo json_encode([
            'id'     => $author->id,
            'author' => $author->author,
        ]);
    } else {
        http_response_code(200);
        echo json_encode(['message' => 'Author Not Created']);
    }
} else {
    http_response_code(200);
    echo json_encode(['message' => 'Missing Required Parameters']);
}
