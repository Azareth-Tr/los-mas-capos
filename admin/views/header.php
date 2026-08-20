<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
</head>

<body>
    <?php

    $scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME']);
    $adminPos = strpos($scriptName, '/admin/');
    $baseUrl = $adminPos !== false ? substr($scriptName, 0, $adminPos) : '';

    include __DIR__ . "/sidebar.php";
    ?>
    