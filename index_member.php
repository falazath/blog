<?php
session_start();
include("header.html");
include("menu_member.html");
include("connect.php");

$sql = $conn->prepare("SELECT * FROM user WHERE user_id = " . $_SESSION['id']);
$sql->execute();
$user = $sql->fetch();

?>

<div style="background-color: #C3AED6;">
    <section class="header container-fluid py-5 bg-white">
        <div class="row">
            <div class="col">
                <h1 class="fw-bold d-inline-block text-sm-center text-lg-left me-3" style="font-size: 6vw;color:#583392;">
                    Welcome
                </h1>
                <h1 class="fw-bolder d-inline-block" style="font-size: 7vw;color:#F08DB0;"><?= $user['user_nameid'] ?></h1>
            </div>
        </div>
    </section>
    <section class="container-fluid">
        <!--Row 1-->
        <div class="row align-items-center justify-content-center">
            <div class="col-md-3 mt-md-2 col-lg ms-lg-5 mt-lg-5 rounded-5 shadow card align-self-start order-1">
                <a href="record_list.php" class="m-5"><img src="img/body/plan.svg" class="h-100 w-100 d-block"></a>
                <div class="card-body">
                    <p class="card-title fw-bold text-center" style="font-size: 3vw;">ตารางบันทึกแคลอรี่</p>
                    <p class="card-text text-center" style="font-size: 1.5vw;">
                        บันทึกการออกกำลังกายและอาหารที่รับประทาน เพื่อคำนวณค่าแคลอรี่ที่ได้รับและแคลอรี่ที่เผาผลาญได้ในแต่ละวัน</p>
                    <div class="d-grid mx-auto col-lg-4">
                        <a href="record_list.php" class="btn btn-info fw-bold">ไปเลย !!</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mt-md-2 col-lg mx-lg-5 mt-lg-5 rounded-5 shadow card align-self-start order-2">
                <a href="exercise.php" class="m-5"><img src="img/body/exercise.svg" class="h-100 w-100 d-block"></a>
                <div class="card-body">
                    <p class="card-title fw-bold text-center" style="font-size: 3vw;">ท่าออกกำลังกาย</p>
                    <p class="card-text text-center" style="font-size: 1.5vw;">
                        แนะนำท่าออกกำลังกาย สำหรับบริหารร่างกายในส่วนต่าง ๆ</p>
                    <div class="d-grid mx-auto col-lg-4">
                        <a href="exercise.php" class="btn btn-info fw-bold">ไปเลย !!</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mt-md-2 col-lg me-lg-5 mt-lg-5 rounded-5 shadow card align-self-start order-3">
                <a href="food_calorie.php" class="m-5"><img src="img/body/food.svg" class="h-100 w-100 d-block"></a>
                <div class="card-body">
                    <p class="card-title fw-bold text-center" style="font-size: 3vw;">ตารางแคลอรี่อาหาร</p>
                    <p class="card-text text-center" style="font-size: 1.5vw;">
                        ตารางข้อมูลอาหารที่จะบอกถึงแคลอรี่ของอาหารแต่ละชนิดที่เรารับประทานในแต่ละวัน</p>
                    <div class="d-grid mx-auto col-lg-4">
                        <a href="food_calorie.php" class="btn btn-info fw-bold">ไปเลย !!</a>
                    </div>
                </div>
            </div>

        </div>
        
        <!--Row 2-->
        <div class="row align-items-center justify-content-center">
            <div class="col-md-3 mt-md-2 col-lg ms-lg-5 mt-lg-5 rounded-5 shadow card align-self-start order-1">
                <a href="manage_member.php" class="m-5"><img src="img/body/manage.svg" class="h-100 w-100 d-block"></a>
                <div class="card-body">
                    <p class="card-title fw-bold text-center" style="font-size: 3vw;">ตั้งค่าบัญชีผู้ใช้</p>
                    <p class="card-text text-center" style="font-size: 1.5vw;">
                        ตรวจสอบและแก้ไขข้อมูลส่วนตัว และเปลี่ยนแปลงรหัสผ่าน</p>
                    <div class="d-grid mx-auto col-lg-4">
                        <a href="manage_member.php" class="btn btn-info fw-bold">ไปเลย !!</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mt-md-2 col-lg mx-lg-5 mt-lg-5 rounded-5 shadow card align-self-start order-2">
                <a href="./map/map.php" class="m-5"><img src="img/body/map.png" class="h-100 w-100 d-block"></a>
                <div class="card-body">
                    <p class="card-title fw-bold text-center" style="font-size: 3vw;">สถานที่</p>
                    <p class="card-text text-center" style="font-size: 1.5vw;">
                        แผนที่แนะนำร้านอาหารและสถานที่ออกกำลังกาย รวมถึงข้อมูลของสถานที่ต่าง ๆ    
                    </p>
                    <div class="d-grid mx-auto col-lg-4">
                        <a href="./map/map.php" class="btn btn-info fw-bold">ไปเลย !!</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mt-md-2 col-lg me-lg-5 mt-lg-5 rounded-5 shadow card align-self-start order-3">
                <a href="webboard.php" class="m-5"><img src="img/body/webboard.svg" class="h-100 w-100 d-block"></a>
                <div class="card-body">
                    <p class="card-title fw-bold text-center" style="font-size: 3vw;">กระทู้โต้ตอบ</p>
                    <p class="card-text text-center" style="font-size: 1.5vw;">
                        แลกเปลี่ยนความคิดด้านการออกกำลังกายและการรับประทานอาหาร    
                    </p>
                    <div class="d-grid mx-auto col-lg-4">
                        <a href="webboard.php" class="btn btn-info fw-bold">ไปเลย !!</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include("footer.html"); ?>