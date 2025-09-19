<?php
$appName = "SpectraDesk";
$version = "v1.0";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css?v=<?php echo file_exists('assets/css/style.css') ? filemtime('assets/css/style.css') : time(); ?>">
    <title>Document</title>
</head>

<body>
    <main>
        <h1>Welcome to <?= $appName ?>-<?= $version ?></h1>
        <p>Your smart workspace is here!</p>
        <button>Get Start</button>
    </main>
</body>

</html>