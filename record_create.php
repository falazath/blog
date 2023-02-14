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

$sql = $conn->prepare("SELECT * , DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(),user_birth)), '%Y') 
+ 0 AS age FROM user,detail_user WHERE user.user_id = detail_user.user_id AND  user.user_id LIKE ? ORDER BY detUser_date DESC LIMIT 1");
$sql->bindParam(1, $_SESSION['id']);
$sql->execute();
$user = $sql->fetch();

//Action เพิ่มลบรายการแคลอรี่

?>

<section class="body bg-white">
    <div class="container bg-light">
        <div class="row pt-5 justify-content-center">

            <?php
            if ((!(isset($_POST['edit'])))) {
            ?>
                <div class="col-12 align-self-center">
                    <ul class="d-flex justify-content-center text-center fw-bold h5 p-3">
                        <li class="d-inline me-2">น้ำหนัก: <?= $user['detUser_weight'] ?></li>
                        <li class="d-inline me-2">ส่วนสูง: <?= $user['detUser_height'] ?></li>
                        <li class="d-inline me-2">BMI: <?= $user['detUser_bmi'] ?></li>
                        <li class="d-inline me-2">BMR: <?= $user['detUser_bmr'] ?></li>
                        <li class="d-inline me-2">TDEE: <?= $_SESSION['tdee'] ?></li>
                    </ul>
                </div>
                <div class="col-12">
                    <div class="col d-block mx-auto">
                        <form action="" method="post">
                            <button class="btn btn-primary d-block mx-auto" type="action" name="edit">แก้ไข</button>
                        </form>
                    </div>

                <?php } else { ?>
                    <form action="<?= $_SERVER['PHP_SELF'] ?> " method="post">
                        <div class="col">
                            <label for="weight" class="form-label">น้ำหนัก</label>
                            <input type="text" class="form-control" name="weight" placeholder="กรอกน้ำหนัก..." required>
                        </div>
                        <div class="col">
                            <label for="height" class="form-label">ส่วนสูง</label>
                            <input type="text" class="form-control" name="height" placeholder="กรอกส่วนสูง..." required>
                        </div>
                        <input type="hidden" name="sex" value="<?= $user['sex_id'] ?>">
                        <input type="hidden" name="age" value="<?= $user['age'] ?>">
                        <div class=" d-block mx-auto mt-2">
                            <input type="submit" class="btn btn-primary" name="save" value="SAVE">
                            <a class="btn btn-danger mx-auto" href="record_create.php">Reset</a>
                        </div>
                    </form>
                <?php } ?>
                </div>
        </div>

        <div class="row mt-5 mx-3"><!--ตารางอาหาร-->
            <h1 class="text-center fw-bold">รายการแคลอรี่ที่ได้รับ</h1>
            <table class="table table-white table-striped table-hover border">
                <thead>
                    <th>ลำดับ</th>
                    <th>รายการอาหาร</th>
                    <th>จำนวนแคลอรี่</th>
                    <th></th>
                </thead>

                <?php
                function getFoodName($pid)
                {
                    global $conn;
                    $result = $conn->query("SELECT food_name FROM food WHERE food_id = $pid");
                    $row = $result->fetch();
                    return $row["food_name"];
                }
                function getCalorie($pid)
                {
                    global $conn;
                    $result = $conn->query("SELECT food_calorie FROM food WHERE food_id = $pid");
                    $row = $result->fetch();
                    return $row["food_calorie"];
                }
                ?>

                <tbody>
                    <?php
                    if (!(isset($_SESSION["food-list"]))) {
                        echo "<br>";
                    ?>
                        <tr>
                            <th colspan="4">
                                <br>
                            </th>
                        </tr>
                        <?php
                    } else {
                        $sum = 0; // ใช้หาผลรวมราคาสินค้าในตะกร้า
                        $max = count($_SESSION['food-list']);
                        for ($i = 0; $i < $max; $i++) {  // วนลูปดึงสินค้าแต่ชิ้นออกมาแสดง
                            $pid = $_SESSION['food-list'][$i]["pid"];
                            $name = getFoodName($pid);
                            $cal = getCalorie($pid);
                            $sum += $cal
                        ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <th><?= $name ?></th>
                                <td><?= $cal ?></td>
                                <td><a class="btn btn-danger" href="record_action.php?menu=get&pid=<?= $pid ?>&action=del">ลบ</a></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <th class="table-active" colspan="4">
                                แคลลอรี่ที่ได้รับทั้งหมด: <?= $sum ?>;
                            </th>
                        </tr>
                </tbody>
            <?php
                        $_SESSION['getCal'] = $sum;
                    }
            ?>
            </table>
            <div class="col-3 mx-auto ">
                <a class="btn btn-success d-block mx-auto" href="food_list.php" class="btn btn-primary">เพิ่มรายการอาหาร</a>
            </div>

        </div>

        <div class="row mt-5 mx-3"><!--ตารางออกกำลังกาย-->
            <h1 class="text-center fw-bold">รายการแคลอรี่ที่เผาผลาญ</h1>
            <table class="table table-white border">
                <thead>
                    <th>ลำดับ</th>
                    <th>การออกกำลังกาย</th>
                    <th>เวลาที่ใช้(นาที)</th>
                    <th>จำนวนแคลอรี่ที่เผาผลาญ(แคลอรี่)</th>
                    <th></th>
                </thead>
                <?php
                function getMetName($pid)
                {
                    global $conn;
                    $result = $conn->query("SELECT met_activity FROM met WHERE met_id = $pid");
                    $row = $result->fetch();
                    return $row["met_activity"];
                }
                function getMetValue($pid)
                {
                    global $conn;
                    $result = $conn->query("SELECT met_value FROM met WHERE met_id = $pid");
                    $row = $result->fetch();
                    return $row["met_value"];
                }
                ?>
                <tbody>
                    <?php if (isset($_SESSION['burn-list'])) {
                        $sumBurn = 0; // ใช้หาผลรวมราคาสินค้าในตะกร้า
                        $max = count($_SESSION['burn-list']);
                        for ($i = 0; $i < $max; $i++) {  // วนลูปดึงสินค้าแต่ชิ้นออกมาแสดง
                            $pid = $_SESSION['burn-list'][$i]['met'];
                            $name = getMetName($pid);
                            $value = getMetValue($pid);
                            $dur = $_SESSION['burn-list'][$i]['duration'];
                            $total = ($value * 3.5 * $user['detUser_weight'] / 200) * ($dur);
                            $_SESSION['burn-list'][$i]['total'] = $total;
                            $sumBurn += $total;
                    ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <th><?= $name ?></th>
                                <td><?= $dur ?> </td>
                                <td><?= $total ?></td>
                                <td><a class="btn btn-danger" href="create_record.php?menu=burn&pid=<?= $pid ?>&action=del">ลบ</a></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <th colspan="5">
                                แคลลอรี่ที่ได้รับทั้งหมด: <?= $sumBurn ?>;
                            </th>
                        </tr>
                    <?php
                        $_SESSION['burnCal'] = $sumBurn;
                    }
                    ?>

                    <form action="record_action.php?menu=burn&action=add" method="post">
                        <td colspan="5">
                            <div class="input-group mb-1">
                                <select class="form-select" name="met" required>
                                    <option selected disabled value="">เลือกรายการออกกำลังกาย</option>
                                    <?php while ($met = $sql_met->fetch()) { ?>
                                        <option value="<?= $met['met_id'] ?>"><?= $met['met_activity'] ?></option>
                                    <?php } ?>
                                </select>
                                <?php while ($met = $sql_met->fetch()) {
                                    echo $met['met_activity'];
                                } ?>
                                <input class="form-control" type="text" name="duration" placeholder="เวลาที่ออกกำลังกาย..." required>
                                <button class="btn btn-success" type="submit">เพิ่มการออกกำลังกาย</button>
                            </div>
                        </td>
                    </form>
                    </tr>
                </tbody>
            </table>
            <div class="row justify-content-center mt-5">
            <div class="col-3">
                <a class="btn btn-danger d-block mx-auto" href="record_action.php?&action=clear">ยกเลิก</a>
            </div>
            <div class="col-3">
                <a class="btn btn-warning d-block mx-auto" href="record_action.php?pid=<?= $user['detUser_id'] ?>&action=save-record">บันทึก</a>
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