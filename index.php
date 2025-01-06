<?php
// Check if the requested URL is for a page like /about
$request_uri = $_SERVER['REQUEST_URI'];

if (preg_match('/^\/([a-zA-Z0-9-_]+)$/', $request_uri, $matches)) {
    $page = $matches[1] . '.html';  // Append .html extension
    if (file_exists($page)) {
        include($page);  // Serve the .html page
        exit;
    }
}

// If not a matching page, serve the default content (index page)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Welcome to the Home Page</h1>
    <nav>
        <a href="/about">About</a> |
        <a href="/contact">Contact</a>
    </nav>
</body>
</html>
