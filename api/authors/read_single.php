<?php
// GET /api/authors/?id=X — return a single author
if ($author->read_single()) {
    $author_arr = [
        'id'     => $author->id,
        'author' => $author->author,
    ];
    http_response_code(200);
    echo json_encode($author_arr);
} else {
    http_response_code(404);
    echo json_encode(['message' => 'Author Not Found']);
}
