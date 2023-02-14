<?php

include("header.html");
include("menu_member.html");
include("connect.php");

$sql = $conn->prepare("SELECT * FROM food,food_category WHERE food.food_cate_id = food_category.food_cate_id");
$sql->execute();
?>

<div style="background-color: #C3AED6;">
    <section class="header-info">
        <div class="container-fluid bg-white">
            <div class="row">
                <div class="col-xl-2 col-sm-3 col-xs-2 ms-auto">
                    <a href="food_calorie.php"><img src="img/body/food.svg" class="w-100 h-100 float-start" alt="Logo"></a>
                </div>
                <div class="col-xl-3 col-sm-4 me-auto align-self-center">
                    <h1 class="fw-bold pt-4">ตารางแคลอรี่</h1>
                    <h3>แสดงแคลอรี่อาหาร</h3>
                </div>
                <div class="col-xl-4 col-sm-5 align-self-center ms-auto">
                    <img src="img/food/food.svg" alt="food" class="w-100 h-100 float-end">
                </div>
            </div>
        </div>
    </section>

    <section class="body container">
        <div class="row my-4">
            <input class="form-control" id="myInput" type="text" placeholder="Search..">
        </div>
        <div class="table-responsive-sm">
            <table class="table table-light border">
                <thead>
                    <tr>
                        <th class="col">Picture</th>
                        <th class="col">Name</th>
                        <th class="col">Calorie</th>
                        <th class="col">Category</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    <?php
                    while ($data = $sql->fetch()) {
                    ?>
                        <tr>
                            <th scope="row">
                                <img src="img/<?= $data['food_photopath'] ?>" class="w-50 h-50 d-block">
                            </th>
                            <th><?= $data['food_name'] ?></th>
                            <td><?= $data['food_calorie'] ?></td>
                            <td><?= $data['food_cate_name'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>


    </section>
</div>
<script>
    $(document).ready(function() {
        $(" #myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
<?php include("footer.html") ?>