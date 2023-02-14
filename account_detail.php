<?php
session_start();
include("header.html");
include("menu_member.html"); ?>
<section class="header-info">
  <div class="container-fluid bg-white">
    <div class="row align-items-center">
      <div class="col-xl-2 col-sm-4 ms-auto">
        <a href="manage_member.php"><img src="img/image 4.svg" class="w-100 h-100 float-start" alt="Logo"></a>
      </div>
      <div class="col-xl-3 col-sm-7 me-auto align-self-center">
        <h1 class="fw-bold pt-4">จัดการบัญชี</h1>
        <h3>บัญชีส่วนตัวและข้อมูลต่างๆ</h3>
      </div>
    </div>
  </div>
</section>
<section class="body">
  <div class="row">
    <div class="col-3 pt-5">
    <ul>
        <li><a class="fw-bold text-decoration-none" href="account_detail.php"><img class="pe-3" src="img/account.svg" alt="account"> รายละเอียดบัญชี</a></li>
        <img src="img/line/Line 1.svg" alt="Line">

        <li><a class="fw-bold text-decoration-none" href="change_pass.php"><img class="pe-3" src="img/password.svg" alt="password"> เปลี่ยนรหัสผ่าน</a></li>
        <img src="img/line/Line 1.svg" alt="Line">

        <li><a class="fw-bold text-decoration-none" href="logout.php"><img class="pe-3" src="img/logout.svg" alt="logout">ออกจากระบบ</a></li>
        <img src="img/line/Line 1.svg" alt="Line">

        <li><a href="https://lin.ee/6S2ek6H"><img src="img/line/line.png" class="add-line w-25 h-25" alt="AddLine"></a></li>
      </ul>
    </div>
    <div class="col" style="background: #C3AED6;">

      <!--รายละเอียดบัญชี-->

      <?php include("connect.php");
      $stmt = $conn->prepare("SELECT * FROM user,sex,detail_user WHERE user.sex_id = sex.sex_id AND user.user_id = detail_user.user_id AND user.user_id LIKE ? ORDER BY detail_user.detUser_date DESC LIMIT 1;");
      $stmt->bindParam(1, $_SESSION['id']);
      $stmt->execute();
      $row = $stmt->fetch();
      $time = date('d-m-Y', strtotime($row['user_birth']));
      ?>

      <div class="row bg-light m-5 rounded-5">
        <div class="row m-5">
          <div class="col-xl-3 col-sm-10">
            <h3 class="fw-bold">ชื่อ</h3>
            <h2><?= $row["user_nameid"] ?></h2>
          </div>
          <div class="col-xl-3 col-sm-10 mx-xl-5 mx-sm-0">
            <h3 class="fw-bold">เพศ</h3>
            <h2><?= $row["sex_name"] ?></h2>
          </div>
          <div class="col-xl-3 col-sm-10">
            <h3 class="fw-bold">วันเดือนปี เกิด</h3>
            <h2><?= $time ?></h2>
          </div>
        </div>

        <div class="row m-5">
          <div class="col-xl-3 col-sm-10">
            <h3 class="fw-bold">น้ำหนัก</h3>
            <h2><?= $row["detUser_weight"] ?></h2>
          </div>
          <div class="col-xl-3 col-sm-10">
            <h3 class="fw-bold">ส่วนสูง</h3>
            <h2><?= $row["detUser_height"] ?></h2>
          </div>
          <div class="col-xl-3 col-sm-10">
            <h3 class="fw-bold">BMI</h3>
            <h2><?= $row["detUser_bmi"] ?></h2>
          </div>
          <div class="col-xl-3 col-sm-10">
            <h3 class="fw-bold">BMR</h3>
            <h2><?= $row["detUser_bmr"] ?></h2>
          </div>
        </div>
        <?php $conn = null; ?>
        <div class="d-grid col-3 mx-auto mb-5">
          <a class=" p-2 btn btn-primary" href="edit_account.php" type="submit" name="edit">แก้ไขข้อมูลส่วนตัว</a>
        </div>
      </div>

    </div>
  </div>
</section>
<?php include("footer.html"); ?>