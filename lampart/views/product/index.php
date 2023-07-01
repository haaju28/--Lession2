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

        <?php
        $url = $_GET['url'];
        $url = explode('/', $url);
        ?>

        <form class="d-flex" role="search" method="post" action="<?= URL ?>product/search">
            <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
        </form>

        <div class="d-flex justify-content-between mt-3">
            <span>Search found <?= $datas['totalResults'] ?> results</span>


            <div class="me-3">
                <button type="button" class="btn" data-toggle="modal" data-target="#addModal">
                    <i class="fa-solid fa-circle-plus fa-xl"></i>
                </button>
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center" scope="col">#</th>
                    <th class="text-center" scope="col">Product name</th>
                    <th class="text-center" scope="col">Category</th>
                    <th class="text-center" scope="col">Image</th>
                    <th class="text-center" scope="col">Operations</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($datas['products'][0] as $data) { ?>
                    <tr>
                        <td class="text-center align-middle"><?= $data['id'] ?></th>
                        <td class="text-center align-middle"><?= $data['name'] ?></td>
                        <td class="text-center align-middle"><?= getCategoryName($data['category_id'], $datas['categories']) ?></td>
                        <td class="text-center align-middle">
                            <div class="d-flex justify-content-center align-items-center">
                                <img height="200px" width="200px" src="<?= URL ?>public/images/<?= $data['image_url'] ?>" class="img-thumbnail" alt="...">
                            </div>
                        </td>
                        <td class="text-center align-middle">
                            <a href="<?= URL ?>product/edit/<?= $data['id'] ?>"><i class="text-primary fa-solid fa-pen-to-square fa-xl"></i></a>
                            <a onclick="return confirm('Are you sure?')" href="<?= URL ?>product/delete/<?= $data['id'] ?>"><i class="fa-solid fa-circle-minus fa-xl"></i></a>
                            <a href="<?= URL ?>product/copy/<?= $data['id'] ?>"><i class="fa-regular fa-copy fa-xl"></i></a>
                            <a href="<?= URL ?>product/detail/<?= $data['id'] ?>"><i class="fa-regular fa-eye fa-xl"></i></a>
                        </td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>


        <div class="d-flex justify-content-center">
            <nav aria-label="Page navigation example">
                <ul class="pagination">

                    <?php
                    if (isset($url[2]) && $url[2] > 1) {
                    ?>
                        <li class="page-item"><a class="page-link" href="<?= URL ?>product/index/<?= $url[2] - 1 ?>">Previous</a></li>
                    <?php
                    } else {
                    ?>
                        <li class="page-item"><a class="page-link">Previous</a></li>
                    <?php
                    }
                    ?>

                    <?php

                    for ($counter = 1; $counter <= count($datas['products'][1]); $counter++) {
                    ?>
                        <li class="page-item <?= $url[2] == $counter ? 'active' : '' ?>"><a class="page-link" href="<?= URL ?>product/index/<?= $counter ?>"><?= $counter ?></a></li>
                    <?php
                    }

                    ?>

                    <?php
                    if (!isset($url[2])) {
                    ?>
                        <li class="page-item"><a class="page-link" href="<?= URL ?>product/index/2">Next</a></li>
                        <?php
                    } else {
                        if ($url[2] >= count($datas['products'][1])) {
                        ?>
                            <li class="page-item"><a class="page-link">Next</a></li>
                        <?php
                        } else {
                        ?>
                            <li class="page-item"><a class="page-link" href="<?= URL ?>product/index/<?= $url[2] + 1 ?>">Next</a></li>
                    <?php
                        }
                    }
                    ?>


                </ul>
            </nav>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add new product</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fa fa-times-circle-o" aria-hidden="true"></i></span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="<?= URL ?>/product/add" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="name" class="form-label">Product name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3 form-group">
                                <label for="category" class="form-label">Category</label>
                                <select name="category" id="category" class="form-control">
                                    <?php
                                    foreach ($datas['categories'] as $data) { ?>
                                        <option value="<?= $data['id'] ?>"><?= $data['name'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="image_url" class="form-label">Product image</label>
                                <input name="image_url" type="file" class="form-control-file" id="image_url" accept=".jpg,.png,.svg,.jpeg">
                            </div>
                            <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-primary mt-3">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


    </main>


    <footer>


    </footer>


    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/039cab3742.js" crossorigin="anonymous"></script>
</body>

</html>