<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

echo json_encode([
    'message' => 'Quotes API',
    'version' => '1.0',
    'endpoints' => [
        'quotes'     => '/api/quotes/',
        'authors'    => '/api/authors/',
        'categories' => '/api/categories/',
    ]
]);
