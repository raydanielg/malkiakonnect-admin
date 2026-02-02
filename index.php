<?php
// This file exists only as a convenience entrypoint when the web server document root
// is pointed at the project root. In production, you should point the document root
// to the /public directory.

$publicIndex = __DIR__ . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'index.php';

if (is_file($publicIndex)) {
    $uri = (string) ($_SERVER['REQUEST_URI'] ?? '/');

    if (preg_match('#^/public(?:/|$)#', $uri) !== 1) {
        http_response_code(302);
        header('Location: /public' . ($uri === '/' ? '/' : $uri));
        exit;
    }

    require $publicIndex;
    exit;
}

http_response_code(500);
header('Content-Type: text/plain; charset=UTF-8');
echo "public/index.php haijapatikana. Hakikisha project iko complete na folder ya public ipo.";
