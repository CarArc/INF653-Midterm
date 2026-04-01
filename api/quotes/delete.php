<?php
// DELETE /api/quotes/?id=X — delete a quote
$data = json_decode(file_get_contents('php://input'));

// Accept id from query string or body
$id = isset($_GET['id']) ? $_GET['id'] : (isset($data->id) ? $data->id : null);

if (!empty($id)) {
    $quote->id = $id;

    // Check the quote exists first
    if (!$quote->read_single()) {
        http_response_code(404);
        echo json_encode(['message' => 'No Quotes Found']);
        exit;
    }

    if ($quote->delete()) {
        http_response_code(200);
        echo json_encode(['id' => $id]);   // spec requires returning the id
    } else {
        http_response_code(500);
        echo json_encode(['message' => 'Quote Not Deleted']);
    }
} else {
    http_response_code(400);
    echo json_encode(['message' => 'Missing Required Parameters']);
}
