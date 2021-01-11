<?php
// loading the setup
require __DIR__ . '/../app/autoload.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $config['title']; ?></title>
    <!-- favicon -->
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22256%22 height=%22256%22 viewBox=%220 0 100 100%22><rect width=%22100%22 height=%22100%22 rx=%2220%22 fill=%22%23f5a623%22></rect><path fill=%22%23fff%22 d=%22M43.10 72.65L43.10 72.65Q42.65 72.80 41.90 72.99Q41.15 73.17 40.25 73.17L40.25 73.17Q36.95 73.17 36.95 70.40L36.95 70.40L36.95 52.25L13.55 52.25L13.55 72.65Q13.10 72.80 12.35 72.99Q11.60 73.17 10.70 73.17L10.70 73.17Q7.40 73.17 7.40 70.40L7.40 70.40L7.40 27.35Q7.77 27.20 8.56 27.01Q9.35 26.82 10.25 26.82L10.25 26.82Q13.55 26.82 13.55 29.60L13.55 29.60L13.55 47.15L36.95 47.15L36.95 27.35Q37.33 27.20 38.11 27.01Q38.90 26.82 39.80 26.82L39.80 26.82Q43.10 26.82 43.10 29.60L43.10 29.60L43.10 72.65ZM59.75 73.17L59.75 73.17Q56.45 73.17 56.45 70.47L56.45 70.47L56.45 28.10Q57.80 26.75 60.50 26.75L60.50 26.75Q62.30 26.75 63.57 27.46Q64.85 28.17 65.90 30.05L65.90 30.05L80.22 54.05Q81.13 55.63 82.10 57.39Q83.07 59.15 83.97 60.91Q84.88 62.67 85.66 64.21Q86.45 65.75 86.97 66.80L86.97 66.80L87.28 66.72Q86.67 60.65 86.56 54.50Q86.45 48.35 86.45 42.50L86.45 42.50L86.45 27.35Q86.90 27.20 87.65 27.01Q88.40 26.82 89.30 26.82L89.30 26.82Q92.60 26.82 92.60 29.52L92.60 29.52L92.60 71.97Q91.92 72.58 90.88 72.91Q89.82 73.25 88.55 73.25L88.55 73.25Q86.75 73.25 85.47 72.54Q84.20 71.83 83.15 69.95L83.15 69.95L68.90 45.95Q68 44.45 66.99 42.65Q65.97 40.85 65.04 39.13Q64.10 37.40 63.31 35.82Q62.52 34.25 62 33.20L62 33.20L61.70 33.27Q62.07 36.88 62.30 41.49Q62.52 46.10 62.52 50.22L62.52 50.22L62.52 72.65Q62.15 72.80 61.36 72.99Q60.57 73.17 59.75 73.17Z%22></path></svg>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- normalize -->
    <link rel="stylesheet" href="/assets/styles/normalize.css">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- own css -->
    <link rel="stylesheet" href="/assets/styles/app.css">
</head>

<body>
    <?php require __DIR__ . '/navigation.php'; ?>

    <div class="container py-5">
