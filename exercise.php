<?php
include("header.html");
include("menu_member.html");
include("connect.php");

$sql = $conn->prepare("SELECT * FROM exercise,exercise_category WHERE exercise.exer_cate_id = exercise_category.exer_cate_id");
$sql->execute();
?>
<div style="background-color: #C3AED6;">
    <section class="header-info">
        <div class="container-fluid bg-white">
            <div class="row">
                <div class="col-xl-2 col-sm-4 ms-auto">
                    <a href="exercise.php"><img src="img/body/exercise.svg" class="w-100 h-100 float-start" alt="Logo"></a>
                </div>
                <div class="col-xl-3 col-sm-7 me-auto align-self-center">
                    <h1 class="fw-bold pt-4">ออกกำลังกาย</h1>
                    <h3>ตัวอย่างท่าออกกำลังกาย</h3>
                </div>
                <div class="col-xl-4 col-sm-10 align-self-center ms-auto">
                    <img src="img/exercise/exercise.svg" alt="exercise" class="w-100 h-100 float-end">
                </div>
            </div>
        </div>
    </section>

    <section class="body container bg-white">
        <div class="table-responsive">
            <table class="table border mx-auto " style="font-size: 1.5vw;">
                <thead>
                    <tr>
                        <th class="col">Name</th>
                        <th class="col">Description</th>
                        <th class="col">Video</th>
                        <th class="col">Category</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($data = $sql->fetch()) {
                    ?>
                        <tr>
                            <th><?= $data['exercise_name'] ?></th>
                            <th><?= $data['exercise_desc'] ?></th>
                            <td>
                                <video width="75%" height="100%" controls>
                                    <source src="<?= $data['exercise_videopath'] ?>" type="video/mp4">
                                </video>
                            </td>
                            <td><?= $data['exer_cate_name'] ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</div>
<?php
$conn = null;
?>

<?php include('footer.html');
