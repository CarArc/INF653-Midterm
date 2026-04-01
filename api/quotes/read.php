<?php
// GET /api/quotes/ — return all quotes (with optional ?author_id= / ?category_id= filters)
$results = $quote->read()->fetchAll(PDO::FETCH_ASSOC);

if (count($results) > 0) {
    $quotes_arr = [];
    foreach ($results as $row) {
        $quotes_arr[] = [
            'id'       => $row['id'],
            'quote'    => $row['quote'],
            'author'   => $row['author'],
            'category' => $row['category'],
        ];
    }
    http_response_code(200);
    echo json_encode($quotes_arr);
} else {
    http_response_code(200);
    echo json_encode(['message' => 'No Quotes Found']);
}
