<?php
// GET /api/authors/ — return all authors
$results = $author->read()->fetchAll(PDO::FETCH_ASSOC);

if (count($results) > 0) {
    $authors_arr = [];
    foreach ($results as $row) {
        $authors_arr[] = [
            'id'     => $row['id'],
            'author' => $row['author'],
        ];
    }
    http_response_code(200);
    echo json_encode($authors_arr);
} else {
    http_response_code(404);
    echo json_encode(['message' => 'No Authors Found']);
}
