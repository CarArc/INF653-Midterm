<?php
// GET /api/quotes/?id=X — return a single quote
if ($quote->read_single()) {
    $quote_arr = [
        'id'       => $quote->id,
        'quote'    => $quote->quote,
        'author'   => $quote->author_id,   // populated with name after read_single()
        'category' => $quote->category_id, // populated with name after read_single()
    ];
    http_response_code(200);
    echo json_encode($quote_arr);
} else {
    http_response_code(200);
    echo json_encode(['message' => 'No Quotes Found']);
}
