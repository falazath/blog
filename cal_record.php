<?php
session_start();
include("header.html");
include("menu_member.html");
include("connect.php");

$sql_data = $conn->prepare("SELECT * FROM food,food_category WHERE food.food_cate_id = food_category.food_cate_id");
$sql_data->execute();

$sql_met = $conn->prepare("SELECT * FROM met");
$sql_met->execute();
//แก้ไขน้ำหนักส่วนสูง
if (isset($_POST['save'])) {
    $bmi = $_POST['weight'] / (($_POST['height'] / 100) * ($_POST['height'] / 100));
    echo $_POST['age'];
    if ($_POST['sex'] == 1) {
        $bmr = (10 * ($_POST['weight'])) + (6.25 * ($_POST['height'])) - (5 * ($_POST['age'])) + 5;
    } else {
        $bmr = (10 * ($_POST['weight'])) + (6.25 * ($_POST['height'])) - (5 * ($_POST['age'])) - 161;
    }
    $sql = $conn->prepare("INSERT INTO detail_user VALUES ('',now(),?,?,?,?,?)");
    $sql->bindParam(1, $_POST['weight']);
    $sql->bindParam(2, $_POST['height']);
    $sql->bindParam(3, $bmi);
    $sql->bindParam(4, $bmr);
    $sql->bindParam(5, $_SESSION['id']);
    $sql->execute();
}

$id = $_GET['planID'];
$sql = $conn->prepare("SELECT * , DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(),user_birth)), '%Y') 
+ 0 AS age FROM user,detail_user WHERE user.user_id = detail_user.user_id AND  user.user_id LIKE ? ORDER BY detUser_date DESC LIMIT 1");
$sql->bindParam(1, $_SESSION['id']);
$sql->execute();
$user = $sql->fetch();

$sql = $conn->prepare("SELECT * FROM planner WHERE plan_id = ".$_GET['planID']);
$sql->execute();
$plan = $sql->fetch();
//Action เพิ่มลบรายการแคลอรี่

?>

<section class="body" style="background-color: #C3AED6;">
    <div class="container bg-light">
        <div class="row pt-5 justify-content-center">
                <div class="col-12 align-self-center">
                    <ul class="d-flex justify-content-center text-center fw-bold h5 p-3">
                        <li class="d-inline me-2">น้ำหนัก: <?= $user['detUser_weight'] ?></li>
                        <li class="d-inline me-2">ส่วนสูง: <?= $user['detUser_height'] ?></li>
                        <li class="d-inline me-2">BMI: <?= $user['detUser_bmi'] ?></li>
                        <li class="d-inline me-2">BMR: <?= $user['detUser_bmr'] ?></li>
                        <li class="d-inline me-2">TDEE: <?= $plan['plan_tdee'] ?></li>
                    </ul>

        <div class="row mt-5 mx-3"><!--ตารางอาหาร-->
            <h1 class="text-center fw-bold">รายการแคลอรี่ที่ได้รับ</h1>
            <table class="table border" style="background-color: #C3AED6;">
                <thead>
                    <th>ลำดับ</th>
                    <th>รายการอาหาร</th>
                    <th>จำนวนแคลอรี่</th>
                </thead>
                <tbody>
                    <?php
                    $sql = $conn->prepare("SELECT * FROM detail_plan_food,food WHERE food.food_id = detail_plan_food.food_id AND plan_id = '$id' ");
                    $sql->execute();
                    for($i=0;$food = $sql->fetch();$i++){
                        ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <th><?= $food['food_name'] ?></th>
                                <td><?= $food['food_calorie'] ?></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <th class="table-active" colspan="4">
                                <p class="text-center h3 fw-bold text-white">แคลลอรี่ที่ได้รับทั้งหมด: <?= $plan['plan_getCal'] ?></p> 
                            </th>
                        </tr>
                </tbody>
            </table>

        </div>

        <div class="row mt-5 mx-3"><!--ตารางออกกำลังกาย-->
            <h1 class="text-center fw-bold">รายการแคลอรี่ที่เผาผลาญ</h1>
            <table class="table border" style="background-color: #C3AED6;">
                <thead>
                    <th>ลำดับ</th>
                    <th>การออกกำลังกาย</th>
                    <th>เวลาที่ใช้(นาที)</th>
                    <th>จำนวนแคลอรี่ที่เผาผลาญ(แคลอรี่)</th>
                </thead>
                <tbody>
                    <?php
$sql = $conn->prepare("SELECT * FROM detail_plan_ex,met WHERE met.met_id = detail_plan_ex.met_id AND plan_id = '$id' ");
$sql->execute();
for($i=0;$ex = $sql->fetch();$i++){
                    ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <th><?= $ex['met_activity'] ?></th>
                                <td><?= $ex['detPlan_ex_dur'] ?> </td>
                                <td><?= $ex['detPlan_ex_total'] ?></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <th colspan="5" class="table-active">
                                <p class="text-center h3 fw-bold text-white">แคลลอรี่ที่ได้รับทั้งหมด: <?= $plan['plan_burnCal'] ?></p>
                            </th>
                </tbody>
            </table>
            <div class="row justify-content-center mt-5">
            <div class="col-3">
                <a class="btn btn-primary d-block mx-auto" href="record_list.php">กลับสู่หน้าหลัก</a>
            </div>
            </div>
            
        </div>
    </div>
</section>



<script>
    $(document).ready(function() {
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>