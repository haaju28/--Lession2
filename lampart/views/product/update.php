<?php
function getCategoryName($categoryId, $categories)
{
    foreach ($categories as $category) {
        if ($category['id'] == $categoryId) {
            return $category['name'];
        }
    }
    return "";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <title>Product</title>
</head>

<body>

    <main class="container mt-3">
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>

        <h3 class="mt-5 mb-3 text-center text-primary">Update product</h2>

            <form action="<?= URL ?>product/update/<?= $datas['products']['id'] ?>" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="name" class="form-label">Product name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $datas['products']['name'] ?>" required>
                </div>
                <div class="mb-3 form-group">
                    <label for="category" class="form-label">Category</label>
                    <select name="category" id="category" class="form-control">
                        <?php
                        foreach ($datas['categories'] as $data) {
                            $selected = ($data['id'] == $datas['products']['category_id']) ? 'selected' : '';
                        ?>
                            <option value="<?= $data['id'] ?>" <?= $selected ?>><?= $data['name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="image_url" class="form-label">Product image</label>
                    <div>
                        <img width="200px" height="200px" src="<?= URL ?>public/images/<?= $datas['products']['image_url'] ?>" alt="">
                    </div>
                    <input name="image_url" type="file" class="form-control-file" id="image_url" accept=".jpg,.png,.svg,.jpeg">
                </div>
                <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-primary mt-3">Submit</button>
            </form>


    </main>


    <footer>


    </footer>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/039cab3742.js" crossorigin="anonymous"></script>

</body>

</html>