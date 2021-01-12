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
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 width=%22256%22 height=%22256%22 viewBox=%220 0 100 100%22><rect width=%22100%22 height=%22100%22 rx=%2220%22 fill=%22%23eba42f%22></rect><path fill=%22%23fff%22 d=%22M43.68 73.16L43.68 73.16Q42.80 73.88 41.44 74.36Q40.08 74.84 38.24 74.84L38.24 74.84Q36.00 74.84 34.36 74Q32.72 73.16 31.36 70.84L31.36 70.84L18.16 47.88Q17.28 46.36 16.36 44.68Q15.44 43 14.60 41.32Q13.76 39.64 13.00 38.08Q12.24 36.52 11.68 35.32L11.68 35.32L11.28 35.40Q11.68 39.56 11.84 44.32Q12.00 49.08 12.00 53.32L12.00 53.32L12.00 74.20Q11.44 74.36 10.36 74.56Q9.28 74.76 8.16 74.76L8.16 74.76Q5.76 74.76 4.68 73.88Q3.60 73 3.60 70.92L3.60 70.92L3.60 27.08Q4.40 26.20 5.88 25.68Q7.36 25.16 9.04 25.16L9.04 25.16Q11.28 25.16 12.96 25.96Q14.64 26.76 16.00 29.08L16.00 29.08L29.28 52.12Q30.16 53.64 31.04 55.32Q31.92 57 32.76 58.68Q33.60 60.36 34.36 61.92Q35.12 63.48 35.68 64.68L35.68 64.68L36.00 64.60Q35.36 58.52 35.28 52.56Q35.20 46.60 35.20 40.92L35.20 40.92L35.20 25.72Q35.84 25.56 36.88 25.36Q37.92 25.16 39.12 25.16L39.12 25.16Q41.52 25.16 42.60 26.04Q43.68 26.92 43.68 29L43.68 29L43.68 73.16ZM87.76 25.72L87.76 25.72Q88.32 25.56 89.44 25.36Q90.56 25.16 91.76 25.16L91.76 25.16Q94.08 25.16 95.24 26.04Q96.40 26.92 96.40 29.16L96.40 29.16L96.40 74.12Q95.76 74.36 94.68 74.56Q93.60 74.76 92.40 74.76L92.40 74.76Q89.92 74.76 88.84 73.84Q87.76 72.92 87.76 70.76L87.76 70.76L87.76 53.24L65.44 53.24L65.44 74.12Q64.80 74.36 63.76 74.56Q62.72 74.76 61.44 74.76L61.44 74.76Q58.96 74.76 57.88 73.84Q56.80 72.92 56.80 70.76L56.80 70.76L56.80 25.72Q57.44 25.56 58.52 25.36Q59.60 25.16 60.80 25.16L60.80 25.16Q63.12 25.16 64.28 26.04Q65.44 26.92 65.44 29.16L65.44 29.16L65.44 46.28L87.76 46.28L87.76 25.72Z%22></path></svg>" />
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
