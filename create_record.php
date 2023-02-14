<?php
session_start();
include("header.html");
include("menu_member.php");
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
        $bmr = 66.4730 + (13.7516 * ($_POST['weight'])) + (5.0033 * ($_POST['height'])) - (6.7550 * ($_POST['age']));
    } else {
        $bmr = 655.0955 + (9.5634 * ($_POST['weight'])) + (1.8496 * ($_POST['height'])) - (4.6756 * ($_POST['age']));
    }
    $sql = $conn->prepare("INSERT INTO detail_user VALUES ('',now(),?,?,?,?,?)");
    $sql->bindParam(1, $_POST['weight']);
    $sql->bindParam(2, $_POST['height']);
    $sql->bindParam(3, $bmi);
    $sql->bindParam(4, $bmr);
    $sql->bindParam(5, $_SESSION['id']);
    $sql->execute();
} else if (isset($_POST['reset'])) {
    header('location: create_record.php');
}

$sql = $conn->prepare("SELECT * , DATE_FORMAT(FROM_DAYS(DATEDIFF(NOW(),user_birth)), '%Y') 
+ 0 AS age FROM user,detail_user WHERE user.user_id = detail_user.user_id AND  user.user_id LIKE ? ORDER BY detUser_date DESC LIMIT 1");
$sql->bindParam(1, $_SESSION['id']);
$sql->execute();
$user = $sql->fetch();

//Action เพิ่มลบรายการแคลอรี่
if (isset($_GET['action'])) {
    if ($_GET['action'] == 'add') {
        if ($_GET['menu'] == 'get') { //รายการแคลอรี่ที่ได้รับ
            $pid = $_GET['pid'];
            if (isset($_SESSION['food-list'])) {
                $max = count($_SESSION['food-list']);
                $_SESSION['food-list'][$max]['pid'] = $pid;
            } else {
                $_SESSION['food-list'] = array();
                $_SESSION['food-list'][0]['pid'] = $pid;
            }
        } else if ($_GET['menu'] == 'burn') {
            $pid = $_POST['met'];
            $new = array('duration' => $_POST['duration'], 'met' => $pid);
            if (isset($_SESSION['burn-list'])) {
                echo "fasdfasdfasdfasdfsdf";
                $max = count($_SESSION['burn-list']);
                $check = 0;
                for ($i = 0; $i < $max; $i++) {
                    if ($pid == $_SESSION['burn-list'][$i]['met']) {
                        $check = 1;
                        break;
                    }
                }
                if ($check == 1) return;
                $max = count($_SESSION['burn-list']);
                $_SESSION['burn-list'][$max] = $new;
            } else {
                $_SESSION['burn-list'] = array();
                $_SESSION['burn-list'][0] = $new;
            }
        }
    } else if ($_GET['action'] == 'del') {
        $pid = $_GET['pid'];
        $max = count($_SESSION['food-list']);  // ดึงจำนวนสินค้าในตะกร้าออกมา
        for ($i = 0; $i < $max; $i++) { // วนลูปค้นหาตามรหัสสินค้า
            if ($pid == $_SESSION['food-list'][$i]['pid']) { // ถ้ารหัสสินค้าตรงกัน
                unset($_SESSION['food-list'][$i]); // ลบสินค้านั้นออก
                break;
            }
        }
        $_SESSION['food-list'] = array_values($_SESSION['food-list']);
    }
}
?>

<section class="header-info">
    <div class="container">
        <div class="row">
            <div class="col-3">
                <a href="cal_record.php"><img src="img/body/plan.svg" class="w-100 h-100 float-start" alt="Logo"></a>
            </div>
            <div class="col">
                <h1 class="fw-bold pt-4">ตารางบันทึกแคลอรี่</h1>
                <h3>บันทึกแคลอรี่ที่ได้รับจากการกินอาหารและ</h3>
                <h3>แคลอรี่ที่เผาผลาญจากการออกกำลังกายในแต่ละวัน</h3>
            </div>
        </div>
    </div>
</section>

<div class="body" style="background-color: #8675A9;">
    <div class="container bg-light">
        <div class="row">
            <div class="col">
                <h1>Welcome: <?= $user['user_nameid'] ?></h1>
            </div>
            <div class="col">
                <?php
                if (!(isset($_POST['edit']))) {
                ?>
                    <form action="" method="post">
                        <h3>น้ำหนัก: <?= $user['detUser_weight'] ?>, ส่วนสูง: <?= $user['detUser_height'] ?></h3>
                        <h3>BMI: <?= $user['detUser_bmi'] ?>, BMR: <?= $user['detUser_bmr'] ?></h3>
                        <button class="btn btn-primary" type="action" name="edit">แก้ไข</button>
                    </form>
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
                        <input type="submit" class="btn btn-primary" name="save" value="SAVE">
                        <a class="btn btn-danger" href="create_record.php">Reset</a>
                    </form>
                <?php } ?>
            </div>
        </div>



        <div class="row"><!--ตารางอาหาร-->
            <h1>รายการแคลอรี่ที่ได้รับ</h1>
            <table class="table table-primary">
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
                    if (isset($_SESSION["food-list"])) {
                        
                        $sum = 0; // ใช้หาผลรวมราคาสินค้าในตะกร้า
                        $max = count($_SESSION['food-list']);
                        for ($i = 0; $i < $max; $i++) {  // วนลูปดึงสินค้าแต่ชิ้นออกมาแสดง
                            $pid = $_SESSION['food-list'][$i]["pid"];
                            $name = getFoodName($pid);
                            $cal = getCalorie($pid);
                            $sum += $cal
                        ?>
                            <tr>
                                <td><?= $i+1 ?></td>
                                <th><?= $name ?></th>
                                <td><?= $cal ?></td>
                                <td><a class="btn btn-danger" href="create_record.php?menu=get&pid=<?= $pid ?>&action=del">ลบ</a></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <th colspan="4">
                                แคลลอรี่ที่ได้รับทั้งหมด: <?= $sum ?>;
                            </th>
                        </tr>
                </tbody>

            </table>
        <?php } ?>
        <a class="btn btn-success" href="add_food.php" class="btn btn-primary">เพิ่มรายการอาหาร</a>
        </div>

        <div class="row"><!--ตารางออกกำลังกาย-->
            <h1>รายการแคลอรี่ที่เผาผลาญ</h1>
            <table class="table table-primary">
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
                    <?php if (!isset($_SESSION['burn-list'])) { ?>
                        <tr>
                            <th colspan="4">
                                ไม่มีสินค้าใดๆในตะกร้าสินค้า!
                            </th>
                        </tr>
                        <?php
                    } else {
                        $sumBurn = 0; // ใช้หาผลรวมราคาสินค้าในตะกร้า
                        $max = count($_SESSION['burn-list']);
                        for ($i = 0; $i < $max; $i++) {  // วนลูปดึงสินค้าแต่ชิ้นออกมาแสดง
                            $pid = $_SESSION['burn-list'][$i]['met'];
                            $name = getMetName($pid);
                            $value = getMetValue($pid);
                            $dur = $_SESSION['burn-list'][$i]['duration'];
                            $total = ($value * 3.5 * $user['detUser_weight'] / 200)*($dur);
                            echo $user['detUser_weight'];
                            echo $value;
                            $_SESSION['burn-list'][$i]['total'] = $total;
                            $sumBurn += $total;
                        ?>
                            <tr>
                                <td><?= $i+1 ?></td>
                                <th><?= $name ?></th>
                                <td><?= $dur ?> </td>
                                <td><?= $total ?></td>
                                <td><a class="btn btn-danger" href="create_record.php?menu=burn&pid=<?= $pid ?>&action=del">ลบ</a></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <th colspan="4">
                                แคลลอรี่ที่ได้รับทั้งหมด: <?= $sumBurn ?>;
                            </th>
                        </tr>
                    <?php } ?>

                    <form action="create_record.php?menu=burn&action=add" method="post">
                        <td>
                            <select class="form-select" name="met" required>
                                <option selected disabled value="">เลือกรายการออกกำลังกาย</option>
                                <?php while ($met = $sql_met->fetch()) { ?>
                                    <option value="<?= $met['met_id'] ?>"><?= $met['met_activity'] ?></option>
                                <?php } ?>
                            </select>
                            <?php while($met= $sql_met->fetch()){
                                echo $met['met_activity']   ;
                            }?>
                        </td>
                        <td>
                            <input class="form-control" type="text" name="duration" placeholder="เวลาที่ออกกำลังกาย..." required>
                        </td>
                        <td><button class="btn btn-success" type="submit">เพิ่มการออกกำลังกาย</button></td>
                    </form>
                    </tr>
                </tbody>
            </table>
<?php
if(isset($_POST['save-record'])){
    
    $sql_insert = $conn->prepare("INSERT INTO planner VALUES ('',now(),?,?,?,?);");
    $sql_insert->bindParam(1,$sum);
    $sql_insert->bindParam(2,$sumBurn);
    $sql_insert->bindParam(3,$tdee);
    $sql_insert->bindParam(4,$user['detUser_id']);
    $id = $conn->lastInsertId();
    if($sql_insert->execute()){

        $sql_insert = $conn->prepare("INSERT INTO detail_plan_food VALUES();");
    }
}
    
?>
            <button class="btn btn-success" type="submit" name="save-record">บันทึก</button>
        </div>
    </div>
</div>

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