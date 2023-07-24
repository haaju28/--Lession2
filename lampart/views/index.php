<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <title>LAMPART</title>
</head>

<body>
    <?php
        $url = $_GET['url'] ?? null;
        $url = explode('/',$url);
    ?>
    <header class="container mt-3">
        <nav class="d-flex justify-content-between">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link <?= $url[0]=='product' ? 'active' : '' ?>" aria-current="page" href="<?= URL ?>product/index">Products</a><br>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $url[0]=='category' ? 'active' : '' ?>" aria-current="page" href="<?= URL ?>category/index">Categories</a><br>
                </li>
            </ul>
            <a class="nav-link disabled">LAMPART</a>
        </nav>
    </header>

</body>

</html>