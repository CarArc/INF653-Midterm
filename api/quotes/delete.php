<?php
// DELETE /api/quotes/ — delete a quote
$data = json_decode(file_get_contents('php://input'));

$id = isset($_GET['id']) ? $_GET['id'] : (isset($data->id) ? $data->id : null);

if (!empty($id)) {
    $quote->id = $id;

    if (!$quote->read_single()) {
        http_response_code(200);
        echo json_encode(['message' => 'No Quotes Found']);
        exit;
    }

    if ($quote->delete()) {
        http_response_code(200);
        echo json_encode(['id' => $id]);
    } else {
        http_response_code(200);
        echo json_encode(['message' => 'Quote Not Deleted']);
    }
} else {
    http_response_code(200);
    echo json_encode(['message' => 'Missing Required Parameters']);
}
